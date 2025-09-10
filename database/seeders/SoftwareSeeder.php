<?php

namespace Database\Seeders;

use App\Models\Software;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $softs = [
                'Kaspersky Security Center',
                'Доменная учётная запись',
                'Почта Thunderbird',
                'Р7-Офис',
                'Libre-Офис',
                'Ассистент',
                'Golden-Dict'
        ];
        
        foreach ($softs as $softs_name) {
            Software::factory()->create([
                'name' => $softs_name,
                'vendor' => fake()->company(),
                'license_device_limit' => random_int(1,100),
            ]);   
        } 
    }
}
