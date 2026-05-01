<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationSettingResource\Pages;
use App\Filament\Resources\ApplicationSettingResource\RelationManagers;
use App\Models\Aplikasi;
use Filament\Forms;
use App\Models\Menu;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;

class ApplicationSettingResource extends Resource
{
    protected static ?string $model = Aplikasi::class;

    public static function getNavigationLabel(): string
    {
        return Menu::where('resource', static::class)->value('label') ?? __('filament-shield::filament-shield.nav.role.label');
    }
    
    public static function getNavigationGroup(): ?string {
        return Menu::where('resource', static::class)->value('group');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('logo')
                ->image()
                ->directory('aplikasi')
                ->imagePreviewHeight('100'),

            FileUpload::make('favicon')
                ->image()
                ->directory('aplikasi')
                ->imagePreviewHeight('50'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplicationSettings::route('/'),
            'create' => Pages\CreateApplicationSetting::route('/create'),
            'edit' => Pages\EditApplicationSetting::route('/{record}/edit'),
        ];
    }
}
