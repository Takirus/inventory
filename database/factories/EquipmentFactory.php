<?php
namespace Database\Factories;

use App\Models\Equipment;
use App\Models\User;
use App\Models\TypeEquipment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EquipmentFactory extends Factory
{

    public function definition(): array
    {
        return [
            'serial_code' => strtoupper(Str::random(10)),
            'manufacturer' => $this->faker->company,
            'model' => $this->faker->word . ' ' . $this->faker->bothify('###'),
        ];
    }

    public function withUser(User $user): static
    {
        return $this->for($user,'user');
    }

    public function withType(TypeEquipment $type): static
    {
        return $this->for($type,'typeEquipment');
    }
    
}