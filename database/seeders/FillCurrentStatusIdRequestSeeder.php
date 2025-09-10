<?php

namespace Database\Seeders;

use App\Models\Request;
use App\Models\RequestStatusHistory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FillCurrentStatusIdRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request::whereNull('current_status_id')->each(function ($request) {
            $latestStatus = RequestStatusHistory::where('request_id', $request->id)
                ->orderByDesc('changed_at')
                ->first();
    
            if ($latestStatus) {
                $request->current_status_id = $latestStatus->status_id;
                $request->save();
            }
        });
    }
}
