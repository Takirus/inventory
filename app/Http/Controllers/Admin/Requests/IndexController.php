<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Carbon\Carbon;

class IndexController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pages = $request->input('pages',10);

        $statusesName = $request->input('status', []);

        $date_create = Carbon::parse($request->date_create)->startOfDay();

        $date_update = Carbon::parse($request->date_update)->startOfDay();

        //  Переменные для возврата обратно в форму, чтобы значения не пропадали после обновления страницы      
        $date_create_return = $request->date_create;
        $date_update_return = $request->date_update;
        $nameEmployee = "";

        $query = ModelsRequest::with(['equipment','user', 
        'status'])->orderBy('id','Desc');

        if(!empty($statusesName))
        {
            $query->whereHas('status',function($q) use ($statusesName){
                $q->whereIn('name', (array) $statusesName);
            });
        };

        if($request->filled('employee'))
        {
            $query->whereHas('user', function ($query) use($request){
                $query->where('name','LIKE', '%' . $request->employee . '%');
            });
            $nameEmployee = $request->employee;
        };

        if($request->filled('date_create'))
        {
            $query->whereDate('created_at',$date_create);
        };

        if($request->filled('date_update'))
        {
            $query->whereDate('updated_at',$date_update);
        };


        $requests = $query->paginate($pages)->appends($request->query());

        return view('admin.requests.index', [
            'requests' => $requests,
            'pages' => $pages,
            'statusesName' => $statusesName,
            'nameEmployee' => $nameEmployee,
            'date_create_return' => $date_create_return,
            'date_update_return' => $date_update_return,
        ]);
    }
}
