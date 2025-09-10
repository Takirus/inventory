<?php

namespace App\Helpers;

use App\Models\Vlan;
use Faker\Generator;

class IpHelperGenerate {

    public static function generateSubnetVlan(Generator $faker): string
    {
        $a = 192;
        $b = 168;
        $c = $faker->numberBetween(1,999);

        $mask = $faker->randomElement(['22','23','24','25','30','32']);

        $ip_address = "$a.$b.$c.0/$mask";

        return $ip_address;
    }

    public static function generateIpfromSubnet(string $subnet, Generator $faker): string
    {
        [$base, $mask] = explode('/',$subnet);
        $parts_base = explode('.',$base);
        $parts_base[3] = $faker->numberBetween(1,999);
        return implode('.',$parts_base);
    }

}