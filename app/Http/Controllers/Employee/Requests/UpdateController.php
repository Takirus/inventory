<?php

namespace App\Http\Controllers\Employee\Requests;

use App\Mail\RequestNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\RequestStatusHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UpdateController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($req)
    {
        $userId = Auth::id();
        $request = ModelsRequest::findOrFail($req);
        $equipments = Equipment::where('user_id', $userId)->get();

        return view('employee.requests.edit',
        [
            'request' => $request,
            'equipments' => $equipments,
        ]);
    }

    public function update(Request $request, ModelsRequest $req)
    {
        $user = Auth::user();
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'equipment_id' => 'required|integer|exists:equipment,id',
        ]);

        $req->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'equipment_id' => $data['equipment_id'],
        ]);

        //TODO Добавить QUEUE
        Mail::to($user->email)->send(new RequestNotification($req, 'update', 'employee'));
        Mail::to('amosow.steopa@yandex.ru')->send(new RequestNotification($req, 'update', 'admin'));

        return redirect()->route('account.index')->with('success','Заявка успешно обновлена!');

    }
}
