@extends('layouts.main')

@section('content')
<div class="container px-4 text-center">
  <div class="container mt-4">
    <div class="row justify-content-center">

        <form action="{{ route('admin.requests.index') }}" method="GET">
            <div class="row justify-content-center g-4 align-items-center">
        
              <div class="col-auto">
                <input class="form-control" type="text" name="employee" value="{{ $nameEmployee }}" placeholder="Сотрудник">
              </div>

              <div class="col-auto">
                <div class="dropdown" name="status">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    style="color: #212529; border:1px solid #ced4da">
                    Статус заявки
                    </button>
                    <ul class="dropdown-menu p-2">
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Новая" id="status_new" name="status[]"
                            {{-- Поиск по слову Новая в массиве значений status[], переданных из контроллера, для сохранения чекбокса после обновления страницы --}}
                            {{ in_array('Новая', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_new">Новая</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="В работе" id="status_work" name="status[]"
                            {{ in_array('В работе', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_work">В работе</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Ожидание оборудования" id="waiting_for_equipment" name="status[]"
                            {{ in_array('Ожидание оборудования', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="waiting_for_equipment">Ожидание оборудования</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Отклонена" id="rejected" name="status[]"
                            {{ in_array('Отклонена', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="rejected">Отклонена</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Отложена" id="postponed" name="status[]"
                            {{ in_array('Отложена', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="postponed">Отложена</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Требуется дополнительная информация" id="information_required" name="status[]"
                            {{ in_array('Требуется дополнительная информация', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="information_required">Требуется дополнительная информация</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Завершена" id="completed" name="status[]"
                            {{ in_array('Завершена', isset($statusesName) ? $statusesName : []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="completed">Завершена</label>
                        </div>
                    </li>
                    </ul>
                </div>
              </div>
        
                <div class="col-auto d-flex align-items-center gap-2">
                    <label for="date_create" class="form-label mb-0 text-nowrap">Создание заявки:</label>
                    <input type="date" class="form-control" id="date_create" name="date_create" value="{{ $date_create_return }}">
                </div>

                <div class="col-auto d-flex align-items-center gap-2">
                  <label for="date_update" class="form-label mb-0 text-nowrap">Обновление заявки:</label>
                  <input type="date" class="form-control" id="date_update" name="date_update" value="{{ $date_update_return }}">
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
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Сотрудник</th>
                <th class="text-center align-middle">Оборудование</th>
                <th class="text-center align-middle">Проблема</th>
                <th class="text-center align-middle">Статус заявки</th>
                <th class="text-center align-middle">Дата заявки</th>
                <th class="text-center align-middle">Дата обновления</th>
                <th class="text-center align-middle">Действия</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($requests as $request)
              <tr>
                <td>{{ $request->id }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->equipment->model }}</td>
                <td>{{ $request->title }}</td>
                <td class="text-{{ $request->status ? App\Helpers\getColorByName::getColor($request->status->color) : 'danger' }}">
                    {{ $request->status->name ?? 'Статус не известен' }}
                </td>
                <td>{{ $request->created_at }}</td>
                <td>{{ $request->updated_at }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Действия
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin.requests.show', $request->id)}}">Подробнее</a></li>
                          <li><a class="dropdown-item" href="{{route('admin.requests.edit', $request->id)}}">Редактировать</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <form action="{{route('admin.requests.delete', $request->id)}}" method="POST">
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

{{ $requests->links('pagination::bootstrap-5') }}

<a href="{{route('admin.requests.create')}}" class="btn btn-primary position-fixed" style="bottom: 100px; right: 30px; z-index: 999;">
    ➕ Добавить
</a>

@endsection