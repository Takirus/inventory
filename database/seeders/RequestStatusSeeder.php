<?php

namespace Database\Seeders;

use App\Models\RequestStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'В работе',
            'Новая',
            'Ожидание оборудования',
            'Завершена',
            'Отклонена',
            'Отложена',
            'Требуется дополнительная информация'
        ];

        $colors = [
            'primary',
            'secondary',
            'info',
            'success',
            'danger',
            'dark',
            'warning'
        ];

    
            for($i =0; $i <= 6; $i++)
            {
                $status = $statuses[$i];
                $color = $colors[$i];
                
                RequestStatus::factory()->create([
                    'name' => $status,
                    'color' => $color,
                ]);
            }      
    }
}
