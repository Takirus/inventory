<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\RequestStatus;
use App\Models\RequestStatusHistory;
use App\Models\Status;
use App\Models\StatusUser;
use App\Models\User;
use App\Rules\StatusEntity;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user)
    {
        $user = User::findOrFail($user);
        $equipments_user = Equipment::where('user_id', $user->id)->get();
        $all_statuses = Status::where('entity', 'user')->get();
        $departments = Department::all();

        $status_user = $user->statusUser()
            ->wherePivotNull('date_to')
            ->orderByDesc('status_user.created_at')
            ->first();

        return view('admin.users.edit',
        [
            'user' => $user,
            'equipments_user' => $equipments_user,
            'all_statuses' => $all_statuses,
            'departments' => $departments,
            'status_user' => $status_user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'email' => 'required|email',
            'inside_code' => 'required|integer',
            'role' => 'required|exists:users,role',
            'department_id' => 'required|integer|exists:departments,id',
            'status_id' => ['required','integer','exists:status,id', new StatusEntity('status','entity','user')],
        ]);

        $user->update([
            'name' => $data['name'],
            'position' => $data['position'],
            'email' => $data['email'],
            'inside_code' => $data['inside_code'],
            'role' => $data['role'],
            'department_id' => $data['department_id'],
        ]);

        StatusUser::where('user_id', $user->id)
        ->whereNull(['date_to'])
        ->update(['date_to' => now()]);

        StatusUser::create([
            'user_id' => $user->id,
            'status_id' => $data['status_id'],
            'date_from' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('success','Данные успешно обновлены!');
    }
}
