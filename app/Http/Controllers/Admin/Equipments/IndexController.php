<?php

namespace App\Http\Controllers\Admin\Equipments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $pages = $request->input('pages', 10);
            $serial_value = "";

            $statusesName = $request->input('status', []);

            $query = Equipment::with(['typeEquipment','user', 
            'statusEquipment' => function($q){
                $q->wherePivotNull('date_to');
            }])->orderBy('id','Desc');

            if($request->filled('serial'))
            {
                $query->where('serial_code', 'LIKE', '%' . $request->serial . '%');
                $serial_value = $request->serial;
            }


            if($request->filled('type'))
            {
                $query->whereHas('typeEquipment',function($q) use ($request){
                    $q->where('name',$request->type);
                    });
            }

            if($request->filled('status'))
            {
                $query->whereHas('statusEquipment',function($q) use ($statusesName){
                    $q->whereIn('name', (array) $statusesName)
                    ->whereNull('status_equipment.date_to');
                    });
            }

            $equipments = $query->paginate($pages)->appends($request->query());

            return view('admin.equipments.index',
        [
            'equipments' => $equipments,
            'serial_value' => $serial_value,
            'pages' => $pages,
            'statusesName' => $statusesName,
        ],);
    }
}
