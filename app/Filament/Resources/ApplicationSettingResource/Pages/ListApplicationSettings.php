<?php

namespace App\Filament\Resources\ApplicationSettingResource\Pages;

use App\Filament\Resources\ApplicationSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicationSettings extends ListRecords
{
    protected static string $resource = ApplicationSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
