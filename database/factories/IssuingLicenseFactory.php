<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\IssuingLicense;

class IssuingLicenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IssuingLicense::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'fullName' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'nationalID' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'passportOrID' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'phoneNumber' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'projectName' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'positionInProject' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'projectAddress' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'municipality_id' => $this->faker->word(),
            'region_id' => $this->faker->word(),
            'license_type_id' => $this->faker->word(),
            'nearestLandmark' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'licenseDate' => $this->faker->date(),
            'licenseNumber' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'licenseDuration' => $this->faker->numberBetween(-10000, 10000),
            'licenseFee' => $this->faker->numberBetween(-10000, 10000),
            'discount' => $this->faker->numberBetween(-10000, 10000),
            'chamberOfCommerceNumber' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'taxNumber' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'economicNumber' => $this->faker->regexify('[A-Za-z0-9]{20}'),
        ];
    }
}
