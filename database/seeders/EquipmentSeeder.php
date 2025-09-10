<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;
use App\Models\User;
use App\Models\TypeEquipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $IDs_Users = User::pluck('id')->toArray();
        $IDs_Types = TypeEquipment::pluck('id')->toArray();

        foreach($IDs_Users as $userId)
        {
            $user = User::find($userId);
            
            $countTypes = rand(1,3);
            for($i = 0; $i <= $countTypes; $i++)
            {
                $t = fake()->randomElement($IDs_Types);
                $type = TypeEquipment::find($t);

                Equipment::factory()
                ->withUser($user)
                ->withType($type)
                ->create();
            }
        }    
    }
}