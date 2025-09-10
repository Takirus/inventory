<?php

namespace Database\Seeders;

use App\Models\TypeEquipmentFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeEquipmentFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $typeFiles = [
                'Документация',
                'Инструкция по использованию',
                'Паспорт устройства',
                'Гарантийный талон',
                'Акт ввода в эксплуатацию',
                'Схема подключения'
        ];
        
        foreach ($typeFiles as $type) {
            TypeEquipmentFile::factory()->create([
                'name' => $type,
                'description' => fake()->sentence(),
            ]);
                
        }    
    }      
}