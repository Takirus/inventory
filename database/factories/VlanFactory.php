<?php

namespace Database\Factories;

use App\Helpers\IpHelperGenerate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vlan>
 */
class VlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'subnet' => IpHelperGenerate::generateSubnetVlan($this->faker),
        ];
    }
}
