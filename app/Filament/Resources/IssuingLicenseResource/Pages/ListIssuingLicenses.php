<?php

namespace App\Filament\Resources\IssuingLicenseResource\Pages;

use App\Filament\Resources\IssuingLicenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIssuingLicenses extends ListRecords
{
    protected static string $resource = IssuingLicenseResource::class;

    protected static ?string $title = 'إصدار التراخيص';




    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('إصدار ترخيص جديد'),
        ];
    }

}
