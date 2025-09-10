<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\RequestStatusHistory;
use App\Models\StatusUser;
use App\Models\User;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::findOrFail($user);
        $request = ModelsRequest::where('user_id',$user->id)->get();
        $equipment = Equipment::where('user_id', $user->id)->get();

        return view('admin.users.show',[
            'request' => $request,
            'equipment' => $equipment,
            'user' => $user
        ]);
    }

}