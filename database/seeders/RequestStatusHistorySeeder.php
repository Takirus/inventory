<?php

namespace Database\Seeders;

use App\Models\RequestStatusHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestStatusHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestStatusHistory::factory()->count(10)->create();
    }
}
