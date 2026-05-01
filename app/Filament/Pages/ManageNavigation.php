<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\{Repeater, TextInput, Section};
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class ManageNavigation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Pages';
    protected static string $view = 'filament.pages.manage-navigation';

    public ?array $data = [];

    public function mount(): void {
        $setting = Setting::where('key', 'navigation')->first();
        $this->form->fill($setting?->value ?? []);
    }

    public function form(Form $form): Form {
        return $form->schema([
            // HEADER
            Section::make('Header Menu')->collapsible()->schema([
                Repeater::make('header')
                    ->schema([
                        TextInput::make('label')->required(),
                        TextInput::make('url')->required(),
                    ])->columns(2)->reorderable(),
            ]),

            // FOOTER DINAMIS (Bisa buat banyak kolom)
            Section::make('Footer Configuration')->collapsible()->schema([
                Repeater::make('footer_columns')
                    ->label('Footer Columns')
                    ->schema([
                        TextInput::make('column_title')->required()->placeholder('Contoh: Marketplace'),
                        Repeater::make('links')
                            ->schema([
                                TextInput::make('label')->required(),
                                TextInput::make('url')->required(),
                                TextInput::make('icon')->placeholder('fab fa-instagram'),
                            ])->columns(3)
                    ])->reorderable(),
            ]),
        ])->statePath('data');
    }

    public function save(): void {
        Setting::updateOrCreate(['key' => 'navigation'], ['value' => $this->form->getState()]);
        Notification::make()->title('Navigation Saved!')->success()->send();
    }
}