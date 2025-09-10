<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Equipment;
use App\Models\User;
use App\Models\Software;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Login>
 */
class LoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'login' => $this->faker->userName,
            'password' => $this->faker->password,
            'comment' => Str::random(10),
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

    public function withUser(User $user): static
    {
        return $this->for($user,'user');
    }
}
