<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use App\Models\Menu;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

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
            TextInput::make('title')->required(),
            TextInput::make('slug')->required(),
            
            Builder::make('content')
                ->blocks([
                    // Blok 1: Hero Text (Title besar di tengah)
                    Builder\Block::make('hero_text')
                        ->schema([
                            TextInput::make('sub_title'),
                            TextInput::make('main_title'),
                        ]),
                    
                    // Blok 2: Image & Text (Bisa pilih posisi gambar)
                    Builder\Block::make('image_content')
                        ->schema([
                            Select::make('layout')
                                ->options([
                                    'image_left' => 'Gambar di Kiri',
                                    'image_right' => 'Gambar di Kanan',
                                ]),
                            FileUpload::make('image')->image()->directory('pages'),
                            TextInput::make('title'),
                            RichEditor::make('body'),
                        ]),
                ])->columnSpanFull()
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
