<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuingLicense extends Model
{
    use HasFactory;


    protected $fillable = [
        'fullName',
        'nationalID',
        'passportOrID',
        'phoneNumber',
        'projectName',
        'positionInProject',
        'projectAddress',
        'municipality_id',
        'region_id',
        'license_type_id',
        'nearestLandmark',
        'licenseDate',
        'licenseNumber',
        'licenseDuration',
        'licenseFee',
        'discount',
        'chamberOfCommerceNumber',
        'taxNumber',
        'economicNumber',
    ];

    protected $casts = [
        'id' => 'integer',
        'licenseDate' => 'date',
        'license_type_id' => \App\Enum\licenseType::class, // تعيين enum على الحقل
    ];
}
