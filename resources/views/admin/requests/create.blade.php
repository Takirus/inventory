@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h4 class="text-center mb-4">Добавить заявку</h4>
        {{-- Форма для отправки id юзера, для дальнейшей обработки в контроллере и выдачи привязанного оборудования--}}
        <form action="{{ route('admin.requests.create') }}" method="GET">

          <div class="mb-3">
            <label for="user_id" class="form-label">Выберите сотрудника:</label>
            <select class="form-select" id="user_id" name="user_id" onchange="this.form.submit()">
                <option value="" disabled {{request('user_id') ? '' : 'selected'}}>Сотрудник</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}" {{request('user_id') == $u->id ? 'selected' : ''}}>
                        {{$u->name}}
                    </option>
                @endforeach
            </select>
          </div>

        </form>

        <form action="{{ route('admin.requests.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          
          <div class="mb-3">
            <label for="description" class="form-label">Описание проблемы</label>
            <textarea type="text" class="form-control" id="description" name="description" rows=3 required> </textarea>
          </div>

          <div class="mb-3">
            <label for="equipment_id" class="form-label">Выберите оборудование:</label>
            <select class="form-select" id="equipment_id" name="equipment_id">
                <option value="" selected disabled>Оборудование сотрудника</option>
                @foreach($equipments_user as $equipment_user)
                    <option
                        value="{{ $equipment_user->id }}">{{$equipment_user->model}}</option>
                @endforeach
            </select>
          </div>
          {{-- Передача выбранного юзера для создания заявки через скрытое поле --}}
          <input type="hidden" name="user_id" value="{{ $selectUserId }}">

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Добавить</button>
          </div>

          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
          @endif

        </form>
      </div>
    </div>
  </div>

@endsection