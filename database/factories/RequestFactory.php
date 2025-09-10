<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\RequestStatus;
use App\Models\RequestStatusHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'current_status_id' => RequestStatusHistory::InRandomOrder()->first()?->id,
            'user_id' => User::where('role','employee')->InRandomOrder()->first()?->id,
            'equipment_id' => Equipment::InRandomOrder()->first()?->id,
        ];
    }

}
