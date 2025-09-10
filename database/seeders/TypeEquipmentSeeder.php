<?php

namespace Database\Seeders;

use App\Models\TypeEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $types = [
                'Монитор',
                'Системный блок',
                'Принтер',
                'Сканер',
                'Свитч',
                'Маршрутизатор'
        ];
        
    foreach ($types as $typeName) {
        TypeEquipment::factory()->create([
            'name' => $typeName,
            'description' => fake()->sentence(),
        ]);
            
    }    

}

}