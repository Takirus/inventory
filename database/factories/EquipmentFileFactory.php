<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\TypeEquipmentFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentFile>
 */
class EquipmentFileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'path_to_file' => '/content*/*files'. '/file' . $this->faker->bothify('####') . '.png',
        ];
    }

    public function withEquipment(Equipment $equipment): static
    {
        return $this->for($equipment,'equipment');
    }

    public function withType(TypeEquipmentFile $type): static
    {
        return $this->for($type,'type');
    }
}
