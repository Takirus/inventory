<?php

namespace Database\Seeders;

use Database\Factories\DepartmentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = [
            'ОРИСБП',
            'ОГМУ',
            'ОАЗИС',
            'ОРЭП',
            'Бухгалтерия',
            'Импортозамещение'
        ];
    
        foreach ($name as $nameDepartments) 
        {
            Department::factory()->create([
            'name' => $nameDepartments,
            'city_phone_number' => fake()->numberBetween(100000,999999),
        ]);
            
        }     
    }
}
