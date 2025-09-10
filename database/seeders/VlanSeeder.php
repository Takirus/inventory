<?php

namespace Database\Seeders;

use App\Models\Vlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vlan::factory()->count(20)->create();
    }
}
