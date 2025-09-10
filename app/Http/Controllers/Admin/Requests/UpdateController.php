<?php

namespace App\Http\Controllers\Admin\Requests;

use App\Mail\RequestNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\RequestStatus;
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
        $request = ModelsRequest::findOrFail($req);
        $equipments_user = Equipment::where('user_id', $request->user_id)->get();
        $all_statuses = RequestStatus::all();

        return view('admin.requests.edit',
        [
            'request' => $request,
            'equipments_user' => $equipments_user,
            'all_statuses' => $all_statuses,
        ]);
    }

    public function update(Request $request, ModelsRequest $req)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'equipment_id' => 'required|integer|exists:equipment,id',
            'status_id' => 'required|integer|exists:request_statuses,id'
        ]);

        $req->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'equipment_id' => $data['equipment_id'],
            'current_status_id' => $data['status_id'],
        ]);

        RequestStatusHistory::where('request_id', $req->id)
            ->whereNull(['closed_at'])
            ->update(['closed_at' => now()]);

        RequestStatusHistory::create([
            'request_id' => $req->id,
            'status_id' => $data['status_id'],
            'changed_by_user_id' => Auth::id(),
            'changed_at' => now(),
        ]);


        $userEmail = $req->user->email;
        //TODO Добавить QUEUE
        Mail::to($userEmail)->send(new RequestNotification($req, 'update', 'employee'));

        return redirect()->route('admin.requests.index')->with('success','Заявка успешно обновлена!');

    }
}
