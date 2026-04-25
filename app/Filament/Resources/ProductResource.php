<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    public static function getNavigationLabel(): string
    {
        return Menu::where('resource', static::class)->value('label') ?? __('filament-shield::filament-shield.nav.role.label');
    }
    
    public static function getNavigationGroup(): ?string {
        return Menu::where('resource', static::class)->value('group');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Produk')
                    ->tabs([
                        // TAB 1: INFORMASI UMUM
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Select::make('product_category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name')
                                    ->live()
                                    ->preload()
                                    ->required(),
                                Forms\Components\TextInput::make('name')->required(),
                                Forms\Components\RichEditor::make('description')->columnSpanFull(),
                                
                                // FIELD DINAMIS (METADATA)
                                Forms\Components\Section::make('Atribut Spesifik Kategori')
                                    ->schema(function (Forms\Get $get) {
                                        $categoryId = $get('product_category_id');
                                        if (! $categoryId) return [
                                            Forms\Components\Placeholder::make('info')
                                                ->label('')
                                                ->content('Pilih kategori untuk melihat atribut spesifik.')
                                        ];

                                        $category = ProductCategory::find($categoryId);
                                        if (! $category || ! $category->custom_fields) return [];

                                        $fields = [];
                                        foreach ($category->custom_fields as $field) {
                                            $fields[] = Forms\Components\TextInput::make("metadata.{$field['name']}")
                                                ->label(str_replace('_', ' ', ucfirst($field['name'])));
                                        }
                                        return $fields;
                                    })->columns(2)->visible(fn ($get) => $get('product_category_id') != null),
                            ]),

                        // TAB 2: VARIAN & STOK
                        Forms\Components\Tabs\Tab::make('Varian & Stok')
                            ->icon('heroicon-o-squares-2x2')
                            ->schema([
                                Forms\Components\Repeater::make('variants')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('name')->label('Nama Varian (Misal: 100ml / Day Cream)')->required(),
                                                Forms\Components\TextInput::make('sku')->label('SKU / Barcode')->unique(ignoreRecord: true)->required(),
                                                Forms\Components\Textarea::make('description')->label('Deskripsi Varian')->rows(2)->columnSpanFull(),
                                                Forms\Components\TextInput::make('price')->numeric()->prefix('Rp')->required(),
                                                Forms\Components\TextInput::make('stock')->numeric()->default(0),
                                                
                                                Forms\Components\Repeater::make('images')
                                                    ->relationship()
                                                    ->schema([
                                                        Forms\Components\FileUpload::make('image_path')
                                                            ->label('Foto Varian')
                                                            ->image()
                                                            ->directory('products/variants')
                                                            ->required(),
                                                    ])->grid(3)->columnSpanFull()->label('Galeri Foto Varian')
                                            ])
                                    ])->collapsible()->itemLabel(fn ($state) => $state['name'] ?? 'Varian Baru')
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->badge()->color('primary'),
                Tables\Columns\TextColumn::make('variants_count')->counts('variants')->label('Varian'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Status'),
            ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}