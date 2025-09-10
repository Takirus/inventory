<?php

namespace Database\Factories;

use App\Helpers\IpHelperGenerate;
use App\Models\Equipment;
use App\Models\Vlan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\VlanFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IpAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $vlan = Vlan::InRandomOrder()->first() ?? Vlan::factory()->create();
        $equipments = Equipment::InRandomOrder()->first() ?? Equipment::factory()->create();
        


        return [
            'ip_address' => IpHelperGenerate::generateIpfromSubnet($vlan->subnet, $this->faker),
            'vlan_id' => $vlan->id,
            'equipment_id' => $equipments->id,
        ];
    }
}
