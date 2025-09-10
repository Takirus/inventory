@extends('layouts.main')
@section('content')
<div class="container py-4">

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

    {{-- Статистика --}}
    <div class="mb-5">
        <h4 class="mb-3 text-center">Текущая информация о предприятии</h4>
        <div class="row text-center">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6>Активных сотрудников:</h6>
                        <h4>
                            <a class="icon-link icon-link-hover" href="{{ route('admin.users.index', ['status' => 'Активен', 'pages' => '6']) }}">
                            {{ $countEmployees }}
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6>Активных устройств:</h6>
                        <h4> 
                            <a class="icon-link icon-link-hover" href="{{ route('admin.equipments.index', ['status' => ['В использовании'], 'pages' => '10']) }}">
                            {{ $countActiveEquipment }} 
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6>Свободных устройств:</h6>
                        <h4>
                            <a class="icon-link icon-link-hover" href="{{ route('admin.equipments.index', ['status' => ['Не используется'], 'pages' => '10']) }}">
                                {{ $countFreeEquipment }}
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6>Активные заявки:</h6>
                        <h4>
                            <a class="icon-link icon-link-hover" href="{{ route('admin.requests.index', [
                            'status' => ['Новая','Отложена','В работе','Требуется дополнительная информация'], 
                            'pages' => '10'
                            ]) }}">
                                {{ $countActiveRequests }}
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Взаимодействие --}}
    <div class="mb-5">
        <h4 class="mb-3 text-center">Взаимодействие</h4>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="list-group">
                    <h5>Сотрудники</h5>
                    <a href="#" class="list-group-item list-group-item-action">Просмотр</a>
                    <a href="#" class="list-group-item list-group-item-action">Редактирование</a>
                    <a href="#" class="list-group-item list-group-item-action">Добавление сотрудников</a>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="list-group">
                    <h5>Устройства</h5>
                    <a href="#" class="list-group-item list-group-item-action">Учёт техники</a>
                    <a href="#" class="list-group-item list-group-item-action">Назначение пользователям</a>
                    <a href="#" class="list-group-item list-group-item-action">Отслеживание состояния и доступности</a>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="list-group">
                    <h5>Софт</h5>
                    <a href="#" class="list-group-item list-group-item-action">Контроль лицензий</a>
                    <a href="#" class="list-group-item list-group-item-action">Распределение ПО по устройствам</a>
                    <a href="#" class="list-group-item list-group-item-action">Отслеживание состояния и доступности</a>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="list-group">
                    <h5>Заявки</h5>
                    <a href="#" class="list-group-item list-group-item-action">Создание</a>
                    <a href="#" class="list-group-item list-group-item-action">Обработка и контроль выполнения заявок сотрудников</a>
                    <a href="#" class="list-group-item list-group-item-action">Отслеживание состояния и доступности</a>
                  </div>
            </div>
        </div>
    </div>

    {{-- Напоминания --}}
    <div class="mb-5">
        <h4 class="mb-3 text-center">🔔 Напоминания</h4>
            <ul class="list-group">
                    <li class="list-group-item">Напоминание 1</li>
            </ul>
            <div class="alert alert-success">Напоминаний нет — всё в порядке ✅</div>
    </div>

</div>
@endsection