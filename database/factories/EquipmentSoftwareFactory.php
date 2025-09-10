<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Software;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentSoftware>
 */
class EquipmentSoftwareFactory extends Factory
{
    public function definition(): array
    {
        return [
            'license_key' => strtoupper(Str::random(15)),
            'version' => $this->faker->numerify('#.##.###') . '-' . $this->faker->randomElement(['stable','minor','major','beta']),
            'expiry_date' => fake()->dateTimeBetween('now','+2 years'),
        ];
    }

    public function withEquipment(Equipment $equipment): static
    {
        return $this->for($equipment,'equipment');
    }

    public function withSoftware(Software $software): static
    {
        return $this->for($software,'software');
    }
}
