<?php

namespace App\Http\Controllers\Admin\Requests;

use App\Mail\RequestNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\RequestStatus;
use App\Models\RequestStatusHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $users = User::all();
        $equipments = Equipment::all();

        $statuses = RequestStatus::all();

        if($request->has('user_id') && $request->user_id)
        {
            $equipments_user = Equipment::where('user_id',$request->user_id)->get();
            $selectUserId = $request->input('user_id');
        } else {
            $equipments_user = [];
            $selectUserId = null;
        }

        return view('admin.requests.create',
        [
            'users' => $users,
            'selectUserId' => $selectUserId,
            'equipments_user' => $equipments_user,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'equipment_id' => 'required|integer|exists:equipment,id',
        ]);

        //Получение id для статуса с именем "Новая" и передача его по умолчанию для каждой созданной заявки
        $query = RequestStatus::where('name', 'Новая')->first();
        $currentStatusIdNew = $query->id;

        $requestUser = ModelsRequest::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
            'equipment_id' => $data['equipment_id'],
            'current_status_id' => $currentStatusIdNew
        ]);

        RequestStatusHistory::where('request_id', $requestUser->id)
        ->whereNull(['closed_at'])
        ->update(['closed_at' => now()]);

        RequestStatusHistory::create([
        'request_id' => $requestUser->id,
        'status_id' => $currentStatusIdNew,
        'changed_by_user_id' => Auth::id(),
        'changed_at' => now(),
        ]);

        $userEmail = $requestUser->user->email;

        //TODO Добавить QUEUE
        Mail::to($userEmail)->send(new RequestNotification($requestUser, 'create', 'admin'));

        return redirect()->route('admin.requests.index')->with('success','Заявка успешно создана!');
    }
}
