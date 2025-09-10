@extends('layouts.main')
@section('content')
    <div class="container my-5">

        <!-- Информация об оборудовании -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold text-center fs-4">
                Заявка №{{$request->id}}
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Сотрудник: <strong>{{ $user->name }}</strong></h5>
                <p class="card-text mb-1"><strong>Краткое описание:</strong> {{ $request->title }}</p>
                <p class="card-text mb-1"><strong>Подробное описание:</strong> {{ $request->description }}</p>
                <p class="card-text mb-1"><strong>Оборудование:</strong> {{ $equipment->model }}</p>
                <p class="card-text mb-1">
                    <strong>Текущий статус заявки:</strong>  
                    <strong class="text-{{ $request->status ? App\Helpers\getColorByName::getColor($request->status->color) : 'danger' }}">
                    {{ $request->status->name ?? 'Статус не известен' }}</strong>
                </p>
            </div>
        </div>

        <!-- История смены статусов -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                История заявки
            </div>
            <div class="card-body">
                @if($request_history->isEmpty())
                    <p class="text-muted">История отсутствует.</p>
                @else
                <h5>История статусов</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Статус</th>
                                <th>Кем изменён</th>
                                <th>Когда изменён</th>
                                <th>Когда закрыт</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($request_history as $history)
                                <tr>
                                    <td class="text-{{ $history->status ? App\Helpers\getColorByName::getColor($history->status->color) : 'danger' }}">
                                    {{ $history->status->name }}</td>
                                    <td>{{ $history->changedBy->name ?? 'Не известно' }}</td>
                                    <td>{{ $history->changed_at }}</td>
                                    <td>{{ $history->closed_at ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        
        <div class="text-center">
            <a href="{{route('admin.requests.edit', $request->id)}}" class="btn btn-primary">Редактировать</a>
        </div>

    </div>
@endsection