<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Software;
use App\Models\Login;
use App\Models\User;
use App\Models\TypeEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $IDs_Users = User::pluck('id')->toArray();
        $IDs_Equipments = Equipment::pluck('id')->toArray();
        $IDs_Software = Software::pluck('id')->toArray();
    
        foreach ($IDs_Users as $userId) {
            $user = User::find($userId);
    
            $countSoftware = rand(1, 3);
            $countEquipments = rand(1, 3);
    
            // Храним созданные пары, чтобы избежать повторов
            $createdPairs = [];
    
            for ($i = 0; $i < $countSoftware; $i++) {
                $software = Software::find(fake()->randomElement($IDs_Software));
    
                for ($e = 0; $e < $countEquipments; $e++) {
                    $equipment = Equipment::find(fake()->randomElement($IDs_Equipments));
    
                    $pairKey = $equipment->id . '-' . $software->id;
    
                    // Если уже есть такая связка — пропускаем
                    if (isset($createdPairs[$pairKey])) {
                        continue;
                    }
    
                    $createdPairs[$pairKey] = true;
    
                    Login::factory()
                        ->withUser($user)
                        ->withSoftware($software)
                        ->withEquipment($equipment)
                        ->create();
                }
            }
        }
    }
}
