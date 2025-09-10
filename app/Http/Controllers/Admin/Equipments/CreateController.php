<?php

namespace App\Http\Controllers\Admin\Equipments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\EquipmentFile;
use App\Models\Status;
use App\Models\StatusEquipment;
use App\Models\TypeEquipment;
use App\Models\TypeEquipmentFile;
use App\Models\User;
use Illuminate\Support\Facades\File;

class CreateController extends Controller
{
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $types = TypeEquipment::all();

        $statuses = Status::where('entity', 'equipment')
        ->get();

        return view('admin.equipments.create',
        [
            'users' => $users,
            'types' => $types,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $data = $request->validate([
                'serial_code' => 'required|string|unique:equipment,serial_code|max:255',
                'manufacturer' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'type_id' => 'required|integer',
                'user_id' => 'required|integer',
                'status_id' => 'required|integer',
            ]);

        $equipment = Equipment::create([
            'serial_code' => $data['serial_code'],
            'manufacturer' => $data['manufacturer'],
            'model' => $data['model'],
            'type_id' => $data['type_id'],
            'user_id' => $data['user_id'],
        ]);

        //Отдельное создание оборудования и последующее создание статуса в таблице "status_equipment" для созданного оборудования
        StatusEquipment::create([
            'equipment_id' => $equipment->id,
            'status_id' => $data['status_id'],
            'created_at' => now(),
        ]);

        if ($request->hasFile('equipment_files'))
        {
            $request_files = $request->validate([
                'equipment_files' => 'array',
                'equipment_files.*' => 'file|mimes:doc,docx,pdf,xlsx,xlsb|max:50000',
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
        }

        elseif(!$request->hasFile('equipment_files'))
        {
            return redirect()->route('admin.equipments.index')->with('success','Оборудование успешно добавлено');
        }

    }

    /**
     * Представление для назначения типов для переданных файлов с оборудованием
     */
    public function selectTypes($equipmentId){
        $equipment = Equipment::findOrFail($equipmentId);
        $files = session('uploaded_files', []);

        $fileTypes = TypeEquipmentFile::all();

        return view('admin.equipments.linking_types',[
            'equipment' => $equipment,
            'files' => $files,
            'fileTypes' => $fileTypes,
        ]);
    }
    /**
     * Связывание переданных файлов с типами файлов
     */
    public function storeFilesWithTypes($equipment, Request $request)
    {
        $equipmentId = $equipment;
        $equipmentFiles = $request->input('equipment_files');

        foreach($equipmentFiles as $equipmentFile)
        {
            // Перемещение файла из временного хранилища
            $path = $equipmentFile['path'];

            if(!$path)
            {
                throw new \Exception("По пути `$path` файл не найден!");
            };

            $fileName = basename($path);

            $newPath = public_path('equipment_files/success');
            $newFullPath = $newPath . '/' . $fileName;

            File::move($path, $newFullPath);

            // Создание записи в бд
            EquipmentFile::create([
                'path_to_file' => 'equipment_files/success/' . $fileName,
                'equipment_id' => $equipmentId,
                'type_file_id' => $equipmentFile['type_id'],
            ]);
        }

            return redirect()->route('admin.equipments.edit',$equipmentId)->with('success','Файлы успешно загружены');
    }
}
