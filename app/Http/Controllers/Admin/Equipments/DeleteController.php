<?php

namespace App\Http\Controllers\Admin\Equipments;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('admin.equipments.index')->with('success','Оборудование успешно удалено!');
    }
}
