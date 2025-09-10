<?php

namespace App\Http\Controllers\Admin\Equipments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\EquipmentFile;
use App\Models\EquipmentSoftware;
use App\Models\Software;
use App\Models\StatusEquipment;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipment = Equipment::findOrFail($id);

        $equipment_files = EquipmentFile::all()->where('equipment_id',$id);

        return view('admin.equipments.show',[
            'equipment' => $equipment,
            'equipment_files' => $equipment_files,
        ]);
    }
}
