@extends('layouts.main')

@section('content')
<div class="container px-4 text-center">
    <div class="container mt-4">
        <div class="row justify-content-center">

            <form action="{{ route('admin.equipments.index') }}" method="GET">
                <div class="row justify-content-center g-4 align-items-center">
            
                    <div class="col-auto">
                        <input class="form-control" type="text" name="serial" value="{{ $serial_value }}" placeholder="Серийный код">
                    </div>
            
                    <div class="col-auto">
                        <select class="form-select" name="type" aria-label="тип устройства">
                            <option value="" selected>Тип устройства</option>
                            <option value="Монитор" {{ request('type') == 'Монитор' ? 'selected' : '' }}>Монитор</option>
                            <option value="Системный блок" {{ request('type') == 'Системный блок' ? 'selected' : '' }}>Системный блок</option>
                            <option value="Принтер" {{ request('type') == 'Принтер' ? 'selected' : '' }}>Принтер</option>
                            <option value="Сканер" {{ request('type') == 'Сканер' ? 'selected' : '' }}>Сканер</option>
                            <option value="Свитч" {{ request('type') == 'Свитч' ? 'selected' : '' }}>Свитч</option>
                            <option value="Маршрутизатор" {{ request('type') == 'Маршрутизатор' ? 'selected' : '' }}>Маршрутизатор</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <div class="dropdown" name="status">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            style="color: #212529; border:1px solid #ced4da">
                            Статус оборудования
                            </button>
                            <ul class="dropdown-menu p-2">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="В использовании" id="status_use" name="status[]"
                                    {{-- Поиск по слову В использовании в массиве значений status[], переданных из контроллера, для сохранения чекбокса после обновления страницы --}}
                                    {{ in_array('В использовании', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_use">В использовании</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="В ремонте" id="status_repair" name="status[]"
                                    {{ in_array('В ремонте', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_repair">В ремонте</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Списано" id="written_off" name="status[]"
                                    {{ in_array('Списано', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="written_of">Списано</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Не используется" id="not_use" name="status[]"
                                    {{ in_array('Не используется', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="not_use">Не используется</label>
                                </div>
                            </li>
                            </ul>
                        </div>
                      </div>
            
                    <div class="col-auto d-flex align-items-center">
                        <label for="pages" class="me-2 mb-0">Показать:</label>
                        <select name="pages" id="pages" class="form-select w-auto"
                                onchange="this.form.submit()">
                            <option value="10" {{ request('pages') == 10 ? 'selected' : '' }}>10</option>
                            <option value="30" {{ request('pages') == 30 ? 'selected' : '' }}>30</option>
                            <option value="50" {{ request('pages') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('pages') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
            
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary">Найти</button>
                    </div>
            
                </div>
            </form>
        </div>
  </div>

  <div class="border-bottom border-dark my-3"></div>

  <div class="table-responsive">
    <table class="table table-hover align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Тип</th>
                <th>Модель</th>
                <th>Производитель</th>
                <th>Серийный номер</th>
                <th>Статус</th>
                <th>Сотрудник</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipments as $equipment)
            <tr>
                <td>{{ $equipment->id }}</td>
                <td>{{ $equipment->typeEquipment->name }}</td>
                <td>{{ $equipment->model }}</td>
                <td>{{ $equipment->manufacturer }}</td>
                <td>{{ $equipment->serial_code }}</td>
                <td class="text-{{ App\Helpers\getColorByName::getColor($equipment->statusEquipment->first()?->color) }}">
                    {{ $equipment->statusEquipment->first()->name ?? 'Не известен'}}
                </td>
                <td>{{ $equipment->user->name }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Действия
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin.equipments.show', $equipment->id)}}">Подробнее</a></li>
                          <li><a class="dropdown-item" href="{{route('admin.equipments.edit', $equipment->id)}}">Редактировать</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <form action="{{route('admin.equipments.delete', $equipment->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <li><button class="dropdown-item btn-danger" type="submit">Удалить</button></li>
                          </form>
                        </ul>
                      </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if (session('success'))
        <div class="alert alert-success">
           {{ session('success') }}
        </div>
    @endif
</div>

{{ $equipments->links('pagination::bootstrap-5') }}

  <a href="{{route('admin.equipments.create')}}" class="btn btn-primary position-fixed" style="bottom: 100px; right: 30px; z-index: 999;">
    ➕ Добавить
    </a>
@endsection