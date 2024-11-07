<?php

namespace App\Enum;

enum LicenseType: string
{
    case Company = 'شركات';
    case IndividualActivity = 'نشاط فردي';

    public function label(): string
    {
        return match ($this) {
            self::Company => 'شركات',
            self::IndividualActivity => 'نشاط فردي',
        };
    }
}
