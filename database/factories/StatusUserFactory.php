<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
Use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusUser>
 */
class StatusUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_id' => Status::where('entity','user')->InRandomOrder()->first()->id,
            'user_id' => User::InRandomOrder()->first()->id,
            'date_from' => $this->faker->dateTimeBetween('-5 years','now'),
            'date_to' => $this->faker->dateTimeBetween('now','+5 years'),
            'comment' => $this->faker->sentence(),
        ];
    }
}
