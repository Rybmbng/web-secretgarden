<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Models\ProductCategory;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    public static function getNavigationLabel(): string {
        return Menu::where('resource', static::class)->value('label') ?? 'Kategori Produk';
    }
    public static function getNavigationGroup(): ?string {
        return Menu::where('resource', static::class)->value('group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kategori')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')->disabled()->dehydrated()->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Custom Atribut')
                    ->description('Tentukan field tambahan untuk produk di kategori ini (Contoh: Fragrance, Skin Type)')
                    ->schema([
                        Forms\Components\Repeater::make('custom_fields')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Atribut')
                                    ->required()
                                    ->placeholder('Misal: fragrance_type'),
                                Forms\Components\Select::make('type')
                                    ->options([
                                        'text' => 'Text Input',
                                        'number' => 'Angka',
                                        'select' => 'Pilihan (Dropdown)',
                                    ])->default('text'),
                            ])->columns(2)->grid(2)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('products_count')->counts('products')->label('Total Produk'),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }
}