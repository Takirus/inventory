<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $pages = $request->input('pages', 6);
        $position_value = "";
        $nameEmployee_value = "";

        $query = User::with(['department','statusUser'
        => function($q){
            $q->wherePivotNull('date_to');
        }]);

        if($request->filled('position'))
        {
            $query->where('position',$request->position);
            $position_value = $request->position;
        }

        if($request->filled('name_employee'))
        {
            $query->where('name', 'LIKE', '%'. $request->name_employee . '%');
            $nameEmployee_value = $request->name_employee;
        }

        if($request->filled('department'))
        {
            $query->whereHas('department',function($q) use ($request){
                $q->where('name',$request->department);
                });
        }

        if($request->filled('status'))
        {
            $query->whereHas('statusUser',function($q) use ($request){
                $q->where('name',$request->status)
                ->whereNull('status_user.date_to');
                });
        }

        $users = $query->paginate($pages)->appends($request->query());

        return view('admin.users.index',
    [
        'users' => $users,
        'pages' => $pages,
        'position_value' => $position_value,
        'nameEmployee_value' => $nameEmployee_value,
    ]);
    }
}
