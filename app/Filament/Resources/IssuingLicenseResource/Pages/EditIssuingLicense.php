<?php

namespace App\Filament\Resources\IssuingLicenseResource\Pages;

use App\Filament\Resources\IssuingLicenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIssuingLicense extends EditRecord
{
    protected static string $resource = IssuingLicenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
