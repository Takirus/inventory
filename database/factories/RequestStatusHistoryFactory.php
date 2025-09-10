<?php

namespace Database\Factories;

use App\Models\Request;
use App\Models\RequestStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestStatusHistory>
 */
class RequestStatusHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'request_id' => Request::InRandomOrder()->first()?->id,
            'status_id' => RequestStatus::InRandomOrder()->first()?->id,
            'changed_by_user_id' => User::where('role','admin')->InRandomOrder()->first()?->id,
            'changed_at' => $this->faker->dateTimeBetween('-10 days', 'now'),
            'closed_at' => $this->faker->optional()->dateTimeBetween('now', '+10 days'),
        ];
    }
}
