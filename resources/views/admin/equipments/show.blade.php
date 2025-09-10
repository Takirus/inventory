@extends('layouts.main')
@section('content')
    <div class="container my-5">

        <!-- Информация об оборудовании -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold text-center fs-4">
                Информация о оборудовании №{{$equipment->id}}
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Наименование: <strong>{{ $equipment->model }}</strong></h5>
                <p class="card-text mb-1"><strong>Серийный номер:</strong> {{ $equipment->serial_code }}</p>
                <p class="card-text mb-1"><strong>Производитель:</strong> {{ $equipment->manufacturer }}</p>
                <p class="card-text mb-1"><strong>Тип:</strong> {{ $equipment->typeEquipment->name ?? '—' }}</p>
                <p class="card-text mb-1"><strong>Ответственный:</strong> {{ $equipment->user->name ?? '—' }}</p>
            </div>
        </div>


        <!-- Прикреплённые файлы -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                Прикреплённые файлы
            </div>
            <div class="card-body">
                @if($equipment_files->isEmpty())
                    <p class="text-muted">Файлы не прикреплены.</p>
                @else
                    <ul class="list-group">
                        @foreach($equipment_files as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>
                                    📄 {{ basename($file->path_to_file) }}
                                </span>
                                <a href="{{ asset($file->path_to_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">Скачать</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- История смены статусов -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                История статусов
            </div>
            <div class="card-body">
                @if($equipment->statusEquipment->isEmpty())
                    <p class="text-muted">История смены статусов отсутствует.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Статус</th>
                                <th>Дата изменения</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipment->statusEquipment as $status)
                                @php
                                    $name = App\Models\Status::find($status->pivot->status_id);
                                @endphp
                                <tr>
                                    <td>{{ $name->name}}</td>
                                    @if (!empty($status->pivot->created_at))
                                        <td>{{ $status->pivot->created_at->format('d.m.Y H:i')}}</td> 
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Установленное ПО-->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                Установленные программы
            </div>
            <div class="card-body">
                @if($equipment->equipmentVersion->isEmpty())
                    <p class="text-muted">Установленное ПО отсутствует.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Наименование</th>
                                <th>Версия</th>
                                <th>Срок окончания лицензии</th>
                                <th>Дата установки ПО</th>
                                <!-- Добавление связанных с ПО паролей/логинов  -->
                                {{--
                                <th>Логин</th>
                                <th>Пароль</th>
                                --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipment->equipmentVersion as $soft_info)
                                @php
                                    $name = App\Models\Software::find($soft_info->pivot->software_id);
                                    /**
                                     * Добавление связанных с ПО паролей/логинов (Не работает корректно)
                                     * Исправить сидер Login (Появляются дублирующие записи, и не полностью заполняет)
                                    **/
                                    /*
                                    $logins = \App\Models\Login::where('equipment_id', $equipment->id)
                                    ->where('software_id', $soft_info->pivot->software_id)
                                    ->get();
                                    */
                                @endphp
                                <tr>
                                    <td>{{ $name->name}}</td>
                                    <td>{{ $soft_info->pivot->version}}</td>
                                    <td>{{ $soft_info->pivot->expiry_date}}</td>
                                    <td>{{ $soft_info->pivot->created_at}}</td>
                                    <!-- Добавление связанных с ПО паролей/логинов  -->
                                    {{--
                                    @foreach ($logins as $login)
                                        <td>{{ $login->login }}</td>
                                    @endforeach
                                    @foreach ($logins as $login)
                                        <td>{{ $login->password }}</td>
                                    @endforeach 
                                    --}}    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="text-center">
            <a href="{{route('admin.equipments.edit', $equipment->id)}}" class="btn btn-primary">Редактировать</a>
        </div>
    
    </div>
@endsection