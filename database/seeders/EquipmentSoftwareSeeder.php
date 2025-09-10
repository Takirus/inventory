<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\EquipmentSoftware;
use App\Models\Software;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $IDs_Equipment = Equipment::pluck('id')->toArray();
        $IDs_Software = Software::pluck('id')->toArray();

        foreach($IDs_Equipment as $equipmentId)
        {
            $equipment = Equipment::find($equipmentId);
            
            $countSoft = rand(1,7);
            $uniqSoftIds = fake()->randomElements($IDs_Software,$countSoft);

            foreach ($uniqSoftIds as $softwareId) {
                $software = Software::find($softwareId);
    
                EquipmentSoftware::factory()
                    ->withEquipment($equipment)
                    ->withSoftware($software)
                    ->create();
            }
        }    
    }
}
