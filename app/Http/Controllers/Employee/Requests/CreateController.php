<?php

namespace App\Http\Controllers\Employee\Requests;

use App\Mail\RequestNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\RequestStatus;
use App\Models\RequestStatusHistory;
use App\Models\TypeEquipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::id();
        $equipments = Equipment::where('user_id', $user)->get();
        return view('employee.requests.create',
        [
            'user' => $user,
            'equipments' => $equipments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'equipment_id' => 'required|integer|exists:equipment,id',
        ]);

        //Получение id для статуса с именем "Новая" и передача его по умолчанию для каждой созданной заявки
        $query = RequestStatus::where('name', 'Новая')->first();
        $currentStatusIdNew = $query->id;

        $request = ModelsRequest::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $userId,
            'equipment_id' => $data['equipment_id'],
            'current_status_id' => $currentStatusIdNew,
        ]);

        RequestStatusHistory::where('request_id', $request->id)
            ->whereNull(['closed_at'])
            ->update(['closed_at' => now()]);

        RequestStatusHistory::create([
            'request_id' => $request->id,
            'status_id' => $currentStatusIdNew,
            'changed_by_user_id' => Auth::id(),
            'changed_at' => now(),
        ]);


        //TODO Добавить QUEUE
        Mail::to($user->email)
            ->send(new RequestNotification($request, 'create', 'employee'));
        Mail::to('amosow.steopa@yandex.ru')
            ->send(new RequestNotification($request, 'create', 'admin'));

        return redirect()->route('account.index')->with('success','Заявка успешно создана!');

    }
}
