<?php

namespace App\Filament\Resources\ApplicationSettingResource\Pages;

use App\Filament\Resources\ApplicationSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationSetting extends EditRecord
{
    protected static string $resource = ApplicationSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
