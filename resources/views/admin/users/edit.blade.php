@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h4 class="text-center mb-4">Редактирование пользователя</h4>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
          @csrf
          @method('PATCH')

          <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" required  value="{{$user->name}}">
          </div>
          
          <div class="mb-3">
            <label for="position" class="form-label">Должность</label>
            <input type="text" class="form-control" id="position" name="position"  value="{{$user->position}}" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Электронная почта</label>
            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" required>
          </div>

          <div class="mb-3">
            <label for="inside_code" class="form-label">Внутренний код</label>
            <input type="text" class="form-control" id="inside_code" name="inside_code" value="{{$user->inside_code}}" required>
          </div>

          <div class="mb-3">
            <label for="role" class="form-label">Выберите роль:</label>
            <select class="form-select" id="role" name="role">
                <option value="" selected disabled>Роль сотрудника</option>
                @php
                  $roles = ['admin',
                  'employee'];
                @endphp
                @foreach($roles as $role)
                    <option value="{{ $user->role }}" 
                      {{ $user->role  == $role ? 'selected' : ' ' }}>{{$role}}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="department_id" class="form-label">Выберите отдел сотрудника:</label>
            <select class="form-select" id="department_id" name="department_id">
                <option value="" selected disabled>Отдел сотрудника</option>
                @foreach($departments as $department)
                    <option {{ $department->id  == $user->department_id ? 'selected' : ' ' }}
                        value="{{ $department->id }}">{{$department->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="status_id" class="form-label">Выберите статус сотрудника:</label>
            <select class="form-select" id="status_id" name="status_id">
                <option value="" selected disabled>Статус сотрудника</option>
                @foreach($all_statuses as $status)
                    <option {{ $status_user?->id == $status->id ? 'selected' : ' ' }}
                        value="{{ $status->id }}">{{$status->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Обновить</button>
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

          @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif

        </form>
      </div>
    </div>
  </div>

@endsection