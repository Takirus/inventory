<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\RequestStatusHistory;
use App\Models\User;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($req)
    {
        $request = ModelsRequest::findOrFail($req);
        $equipment = Equipment::where('id', $request->equipment_id)->get()->first();
        $user = User::where('id', $request->user_id)->get()->first();

        $request_history = $request->requestHistory()->orderBy('changed_at','desc')->get();

        return view('admin.requests.show',[
            'request' => $request,
            'equipment' => $equipment,
            'user' => $user,
            'request_history' => $request_history,
        ]);
    }

}