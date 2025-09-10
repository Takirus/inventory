@extends('layouts.main')
@section('content')

    <div class="container mt-5">
    {{-- Приветствие --}}
    <div class="mb-5 text-center">
        <h2 class="mb-3">Привет, {{ $user->name }}</h2>
        <p class="mb-1">Ваша роль: @if ($user->role === 'admin')
            <strong>Администратор</strong>
        @else
            <strong>Сотрудник</strong>
        @endif
        <p>Дата и время последнего захода: <strong>{{ $user->previous_login_at ? $user->previous_login_at : 'Никогда' }}</strong></p>
    </div>

    <div class="row">
        <!-- Профиль пользователя -->
        <div class="col-md-4">
            <h4>Профиль</h4>
            <div class="card mb-4">
                <div class="card-body">
                    <p><strong>Имя:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Должность:</strong> {{ $user->position }}</p>
                    <p><strong>Отдел:</strong> {{ $user->department->name ?? '—' }}</p>
                </div>
            </div>

            <!-- Оборудование сотрудника -->
            <h5>Ваше оборудование</h5>
            @if($equipments->isEmpty())
                <p>Оборудование не добавлено.</p>
            @else
                <ul class="list-group mb-4">
                    @foreach($equipments as $equipment)
                    @php
                        $type_equipment = App\Models\TypeEquipment::where('id',$equipment->type_id)->first();
                    @endphp
                        <li class="list-group-item">
                            <strong>{{$type_equipment->name}}:</strong> {{ $equipment->model }} — {{ $equipment->serial_code ?? 'Серийный номер не указан' }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Список заявок -->
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Ваши заявки</h4>
                <a href="{{route('employee.requests.create')}}" class="btn btn-primary">Создать заявку</a>
            </div>

            @if($requests->isEmpty())
                <p>Заявок пока нет.</p>
            @else
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Заголовок</th>
                            <th>Статус</th>
                            <th>Оборудование</th>
                            <th>Дата создания</th>
                            <th>    </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->title }}</td>
                            <td>{{ $request->status->name ?? '—' }}</td>
                            <td>{{ $request->equipment->model ?? '—' }}</td>
                            <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Действия
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('employee.requests.show', $request->id)}}">Просмотр</a></li>
                                    <li><a class="dropdown-item" href="{{route('employee.requests.edit', $request->id)}}">Редактировать</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <form action="{{route('employee.requests.delete', $request->id)}}" method="POST">
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
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection