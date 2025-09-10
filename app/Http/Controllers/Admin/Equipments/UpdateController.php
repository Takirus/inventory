<?php

namespace App\Http\Controllers\Admin\Equipments;

use App\Models\Equipment;
use App\Models\Status;
use App\Models\TypeEquipment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EquipmentFile;
use Illuminate\Validation\Rule;

class UpdateController extends Controller
{
    public function edit(Equipment $equipment)
    {
        $users = User::all();
        $types = TypeEquipment::all();

        $statuses = Status::where('entity', 'equipment')
        ->get();

        $currentStatusId = $equipment->statusEquipment()
        ->wherePivot('date_to', null)
        ->latest('date_from')
        ->first()?->pivot->status_id;

        $equipment_files = EquipmentFile::all()->where('equipment_id',$equipment->id);

        return view('admin.equipments.edit',
        [
            'equipment' => $equipment,
            'users' => $users,
            'types' => $types,
            'statuses' => $statuses,
            'currentStatusId' => $currentStatusId,
            'equipment_files' => $equipment_files,
        ]); 
    }

    public function update(Request $request,Equipment $equipment)
    {
        //Получения id файлов для удаления
        $files_delete = $request->input('files_delete', []);

        //Массив для возможности вывода нескольких сообщений одновременно
        $messages = [];
        
        /**
         * Валидация основных данных с формы
         */

        $validate = $request->validate([
            'serial_code' => ['required',
            'string',
            'max:255',
            Rule::unique('equipment','serial_code')->ignore($equipment->id)],
            'manufacturer' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'user_id' => 'required|integer',
            'status_id' => 'required|integer',
        ]);

        $equipment->update([
            'serial_code' => $validate['serial_code'],
            'manufacturer' => $validate['manufacturer'],
            'model' => $validate['model'],
            'type_id' => $validate['type_id'],
            'user_id' => $validate['user_id'],
        ]);


        /**
         * Обновление статуса, старый статус получает текущую дату в date_to, новый в date_from
         * currentStatusId - получение текущего статуса у оборудования
         */
        $currentStatusId = $equipment->statusEquipment()
        ->wherePivot('date_to', null)
        ->latest('date_from')
        ->first()?->pivot->status_id;

        if($validate['status_id'] != $currentStatusId)
        {
            if($currentStatusId){
                $equipment->statusEquipment()->updateExistingPivot($currentStatusId,[
                    'date_to' => now(),
                    'updated_at' => now(),
                ]);
            }

            $equipment->statusEquipment()->attach($validate['status_id'],[
                'date_from' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /**
         * Удаление выбранных файлов с хранилища, и удаления записей о них из бд
         */
        if($files_delete != null)
        {
            foreach($files_delete as $file_delete)
            {
                $file = EquipmentFile::find($file_delete);
                if($file->equipment_id === $equipment->id)
                {
                    unlink(public_path($file->path_to_file));
                }

                $file->delete();
            }

            $messages[] = 'Выбранные файлы успешно удалены!';
        };

        /**
         * Добавление новых файлов (по аналогии с create)
         */
        if ($request->hasFile('equipment_files')) 
        {
            $request_files = $request->validate([
                'equipment_files' => 'array',
                'equipment_files.*' => 'file|mimes:doc,docx,pdf,xlsx,xlsb', 
            ]);

            $files = [];

            foreach($request_files['equipment_files'] as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = 'equipment_files/' . $fileName;
                $file->move(public_path('equipment_files'), $fileName);
                $files[] = [
                    
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                ];
            }

            session(['uploaded_files' => $files]);

            return redirect()->route('admin.equipments.linking',[
                'equipment' => $equipment->id
            ]);
        };


        $messages[] = 'Данные успешно изменены!';
        return redirect()->back()->with('success', $messages);
    }
}
