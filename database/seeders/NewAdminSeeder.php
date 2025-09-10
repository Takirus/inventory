<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NewAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@site.ru'],
            [
                'name' => 'Степан В.',
                'position' => 'Главный лентяй',
                'inside_code' => '213',
                'password' => Hash::make('123.123aA'),
                'role' => 'admin',
            ]
        );
    }
}
