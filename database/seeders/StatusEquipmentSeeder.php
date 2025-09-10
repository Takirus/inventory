<?php

namespace Database\Seeders;

use App\Models\StatusEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusEquipment::factory()->count(20)->create();
    }
}
