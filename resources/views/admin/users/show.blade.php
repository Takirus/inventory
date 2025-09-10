@extends('layouts.main')
@section('content')
    <div class="container my-5">

        <!-- Информация о сотруднике -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold text-center fs-4">
                Сотрудник №{{$user->id}}
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Имя: <strong>{{ $user->name }}</strong></h5>
                <p class="card-text mb-1"><strong>Должность:</strong> {{ $user->position  }}</p>
                <p class="card-text mb-1"><strong>email:</strong> {{ $user->email  }}</p>
                <p class="card-text mb-1"><strong>Внутренний код:</strong> {{ $user->inside_code  }}</p>
                <p class="card-text mb-1"><strong>Отдел:</strong> {{ $user->department->name ?? 'Отдел не назначен' }}</p>
                <p class="card-text mb-1">
                    <strong>Текущий статус:</strong>  
                    <strong class="text-{{ $user->statusUser ? App\Helpers\getColorByName::getColor($user->statusUser->first()?->color) : 'danger' }}">
                    {{ $user->statusUser->first()->name ?? 'Не известен'}}</strong>
                </p>
            </div>
        </div>

        <!-- История смены статусов заявок -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                История заявки
            </div>
            <div class="card-body">
                @if($request->isEmpty())
                    <p class="text-muted">История заявок отсутствует.</p>
                @else
                <h5>История заявок</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Номер заявки</th>
                                <th>Текущий статус</th>
                                <th>Оборудование</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($request as $req)
                                <tr>
                                    <td>{{$req->id}}</td>
                                    <td class="text-{{ $req->status ? App\Helpers\getColorByName::getColor($req->status->color) : 'danger' }}">
                                        {{$req->status->name}}
                                    </td>
                                    <td>{{$req->equipment->model}}</td>    
                                    <td><a href="{{route('admin.requests.show', $req->id)}}" class="card-link">Подробнее</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- История смены статусов -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                История статусов
            </div>
            <div class="card-body">
                @if($user->statusUser->isEmpty())
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
                            @foreach($user->statusUser as $status)
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

    </div>
@endsection