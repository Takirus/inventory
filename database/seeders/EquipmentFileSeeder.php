<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\EquipmentFile;
use App\Models\TypeEquipmentFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $IDs_Equipments = Equipment::pluck('id')->toArray();
        $IDs_Types = TypeEquipmentFile::pluck('id')->toArray();

        foreach($IDs_Equipments as $equipmentId)
        {
            $equipment = Equipment::find($equipmentId);
            
            $countTypes = rand(1,4);
            for($i = 0; $i <= $countTypes; $i++)
            {
                $t = fake()->randomElement($IDs_Types);
                $type = TypeEquipmentFile::find($t);

                EquipmentFile::factory()
                ->withEquipment($equipment)
                ->withType($type)
                ->create();
            }
        } 
    }
}
