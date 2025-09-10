<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Выборка сотрудников с текущем статусом "Активен"
        $activeEmployees = DB::table('users')
        ->join('status_user', 'users.id', '=', 'status_user.user_id')
        ->join('status', 'status_user.status_id', '=', 'status.id')
        ->where('status.name','=','Активен')
        ->whereNull('status_user.date_to')
        ->select('users.*')
        ->get();

        // Выборка оборудования с текущем статусом "Не используется"
        $freeEquipments = DB::table('equipment')
        ->join('status_equipment', 'equipment.id', '=', 'status_equipment.equipment_id')
        ->join('status', 'status_equipment.status_id', '=', 'status.id')
        ->where('status.name','=','Не используется')
        ->whereNull('status_equipment.date_to')
        ->select('equipment.*')
        ->get();

        // Выборка оборудования с текущем статусом "В использовании"
        $activeEquipments = DB::table('equipment')
        ->join('status_equipment', 'equipment.id', '=', 'status_equipment.equipment_id')
        ->join('status', 'status_equipment.status_id', '=', 'status.id')
        ->where('status.name','=','В использовании')
        ->whereNull('status_equipment.date_to')
        ->select('equipment.*')
        ->get();

        // Выборка заявок с текущем статусом "Новая","Отложена","Требуется дополнительная информация"
        $activeRequests = DB::table('requests')
        ->join('users', 'users.id', '=', 'requests.user_id')
        ->join('request_statuses', 'requests.current_status_id', '=', 'request_statuses.id')
        ->where('request_statuses.name','=','В работе')
        ->orWhere('request_statuses.name','=','Новая')
        ->orWhere('request_statuses.name','=','Отложена')
        ->orWhere('request_statuses.name','=','Требуется дополнительная информация')
        ->select('requests.*')
        ->get();

        $countEmployees = 0;
        $countFreeEquipment = 0;
        $countActiveEquipment = 0;
        $countActiveRequests = 0;

        foreach ($activeEmployees as $activeEmployee) {
            $countEmployees += 1;
        }

        foreach ($freeEquipments as $freeEquipment) {
            $countFreeEquipment += 1;
        }    

        foreach ($activeEquipments as $activeEquipment) {
            $countActiveEquipment += 1;
        } 

        foreach ($activeRequests as $activeRequest) {
            $countActiveRequests += 1;
        } 

        //Данные для ЛК сотрудника
        $equipments = Equipment::where('user_id', $user->id)->get();
        $requests = ModelsRequest::where('user_id', $user->id)->get();

          
        if($user->role === 'admin') {
            return view('pers_account.admin', compact('user', 
            'countEmployees', 
            'countFreeEquipment',
            'countActiveEquipment',
            'countActiveRequests',
        ));
        }
        elseif($user->role === 'employee'){

            return view('pers_account.user', compact('user',
        'equipments',
        'requests'));
        }

    }
}
