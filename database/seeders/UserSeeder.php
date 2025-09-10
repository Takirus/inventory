<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

        public function run(): void
        {
                User::factory()
                ->count(20)
                ->create(); 

               /* User::create([
                        'name' => 'Admin',
                        'position' => 'Смотрящий',
                        'department_id' => Department::InRandomOrder()->first()->id,
                        'email' => 'admin@gmail.com',
                        'inside_code' => fake()->randomNumber(3),
                        'password' => Hash::make('123.123aA'),
                ]);
                */
        }
}
