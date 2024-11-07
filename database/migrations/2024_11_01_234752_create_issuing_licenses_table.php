<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('issuing_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('fullName', 255);
            $table->string('nationalID', 20);
            $table->string('passportOrID', 20);
            $table->string('phoneNumber', 15);
            $table->string('projectName', 255);
            $table->string('positionInProject', 50);
            $table->string('projectAddress', 255);
            $table->string('municipality_id');
            $table->string('region_id');
            $table->string('license_type_id');
            $table->string('nearestLandmark', 100);
            $table->date('licenseDate');
            $table->string('licenseNumber', 15);
            $table->integer('licenseDuration');
            $table->integer('licenseFee');
            $table->integer('discount');
            $table->string('chamberOfCommerceNumber', 20);
            $table->string('taxNumber', 20);
            $table->string('economicNumber', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issuing_licenses');
    }
};
