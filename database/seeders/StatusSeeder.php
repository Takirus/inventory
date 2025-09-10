<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Активен',
            'Уволен',
            'В отпуске',
            'На больничном',
            'В использовании',
            'В ремонте',
            'Списано',
            'Не используется',
        ];

        $colors = [
            'success',
            'danger',
            'warning',
            'dark',
            'success',
            'danger',
            'warning',
            'dark',
        ];

    
            for($i =0; $i < 8; $i++)
            {
                $status = $statuses[$i];
                $color = $colors[$i];
                
                if($i < 4)
                Status::factory()->create([
                    'name' => $status,
                    'color' => $color,
                    'entity' => 'user',
                    'description' => fake()->sentence(),
                ]);

                else
                Status::factory()->create([
                    'name' => $status,
                    'color' => $color,
                    'entity' => 'equipment',
                    'description' => fake()->sentence(),
                ]);
            }      
    }
}
