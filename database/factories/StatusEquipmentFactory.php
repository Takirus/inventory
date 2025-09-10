<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusEquipment>
 */
class StatusEquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_id' => Status::where('entity','equipment')->InRandomOrder()->first()->id,
            'equipment_id' => Equipment::InRandomOrder()->first()->id,
            'date_from' => $this->faker->dateTimeBetween('-5 years','now'),
            'date_to' => $this->faker->dateTimeBetween('now','+5 years'),
            'comment' => $this->faker->sentence(),
        ];
    }
}
