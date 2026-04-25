<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class NavigationSetting extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $view = 'filament.pages.navigation-setting';
    protected static ?string $navigationGroup = 'Sistem';

    public ?array $data = [];

    public function mount(): void
    {
        // Ambil data lama dari DB saat halaman dibuka
        $setting = Setting::where('key', 'navigation')->first();
        $this->form->fill($setting ? $setting->value : []);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Navigation')
                    ->tabs([
                        // --- TAB HEADER ---
                        Tabs\Tab::make('Header Menu')
                            ->schema([
                                Repeater::make('header')
                                    ->schema([
                                        TextInput::make('label')->required(),
                                        TextInput::make('url')->required(),
                                    ])->columns(2)->reorderable()
                            ]),

                        // --- TAB FOOTER ---
                        Tabs\Tab::make('Footer Sections')
                            ->schema([
                                Repeater::make('footer')
                                    ->schema([
                                        TextInput::make('title')->label('Judul Kolom (Misal: Secret Garden)')->required(),
                                        Repeater::make('links')
                                            ->schema([
                                                TextInput::make('label')->required(),
                                                TextInput::make('url')->required(),
                                            ])->columns(2)
                                    ])
                            ]),
                    ])
            ])->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        Setting::updateOrCreate(
            ['key' => 'navigation'],
            ['value' => $data]
        );

        Notification::make()->title('Pengaturan berhasil disimpan!')->success()->send();
    }
}