<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    public static function getNavigationLabel(): string
    {
        return Menu::where('resource', static::class)->value('label') ?? 'Menu Management';
    }

    public static function getNavigationGroup(): ?string
    {
        return Menu::where('resource', static::class)->value('group');
    }

    public static function getNavigationIcon(): ?string
    {
        return Menu::where('resource', static::class)->value('icon') ?? 'heroicon-o-rectangle-stack';
    }

    public static function getNavigationSort(): ?int
    {
        return Menu::where('resource', static::class)->value('sort');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return (bool) Menu::where('resource', static::class)->value('is_visible') ?? true;
    }
    // -------------------------------

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('resource')
                            ->label('Namespace Resource')
                            ->disabled() 
                            ->dehydrated()
                            ->required(),
                        Forms\Components\TextInput::make('label')
                            ->label('Nama Menu')
                            ->placeholder('Contoh: Manajemen Karyawan')
                            ->required(),

                        Forms\Components\TextInput::make('group')
                            ->label('Nama Grup')
                            ->placeholder('Contoh: Settings'),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Ikon (Heroicons)')
                                    ->placeholder('heroicon-o-cog-6-tooth')
                                    ->helperText('Cari di heroicons.com'),

                                Forms\Components\TextInput::make('sort')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Forms\Components\Toggle::make('is_visible')
                            ->label('Munculkan di Sidebar')
                            ->default(true),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort')
                    ->label('No')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('label')
                    ->label('Nama Menu')
                    ->searchable(),

                Tables\Columns\TextColumn::make('group')
                    ->label('Grup')
                    ->badge()
                    ->color('info'),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Status')
                    ->boolean(),
            ])
            ->defaultSort('sort', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}