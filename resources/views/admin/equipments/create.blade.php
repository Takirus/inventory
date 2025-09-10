@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h4 class="text-center mb-4">Добавить оборудование</h4>
        <form action="{{ route('admin.equipments.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label for="serial_code" class="form-label">Серийный номер</label>
            <input type="text" class="form-control" id="serial_code" name="serial_code" required>
          </div>
          
          <div class="mb-3">
            <label for="manufacturer" class="form-label">Производитель</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
          </div>

          <div class="mb-3">
            <label for="model" class="form-label">Модель</label>
            <input type="text" class="form-control" id="model" name="model" required>
          </div>


          <div class="mb-3">
            <label for="type_id" class="form-label">Выберите тип оборудования:</label>
            <select class="form-select" id="type_id" name="type_id">
                <option value="" selected disabled>Тип оборудования</option>
                @foreach($types as $type)
                    <option
                        {{ old('type_id') == $type->id ? 'selected' : ' ' }}
                        value="{{ $type->id }}">{{$type->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="user_id" class="form-label">Выберите сотрудника:</label>
            <select class="form-select" id="user_id" name="user_id">
                <option value="" selected disabled>Сотрудник</option>
                @foreach($users as $user)
                    <option
                        {{ old('user_id') == $user->id ? 'selected' : ' ' }}
                        value="{{ $user->id }}">{{$user->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="status_id" class="form-label">Выберите статус для оборудования:</label>
            <select class="form-select" id="status_id" name="status_id">
                <option value="" selected disabled>Статус оборудования</option>
                @foreach($statuses as $status)
                    <option
                        {{ old('status_id') == $status->id ? 'selected' : ' ' }}
                        value="{{ $status->id }}">{{$status->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Файлы (.doc,.docx,.pdf,.xlsx,.xlsb)</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="equipment_files[]" multiple>
          </div>

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