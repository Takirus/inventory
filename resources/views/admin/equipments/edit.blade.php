@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h4 class="text-center mb-4">Редактирование оборудования</h4>
        <form action="{{ route('admin.equipments.update', $equipment->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

          <div class="mb-3">
            <label for="serial_code" class="form-label">Серийный номер</label>
            <input type="text" class="form-control" id="serial_code" name="serial_code" value="{{$equipment->serial_code}}" required>
          </div>
          
          <div class="mb-3">
            <label for="manufacturer" class="form-label">Производитель</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="{{$equipment->manufacturer}}" required>
          </div>

          <div class="mb-3">
            <label for="model" class="form-label">Модель</label>
            <input type="text" class="form-control" id="model" name="model" value="{{$equipment->model}}"  required>
          </div>


          <div class="mb-3">
            <label for="type_id" class="form-label">Выберите тип оборудования:</label>
            <select class="form-select" id="type_id" name="type_id">
                <option value="" selected disabled>Тип оборудования</option>
                @foreach($types as $type)
                    <option
                        {{ $equipment->type_id == $type->id ? 'selected' : ' ' }}
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
                        {{ $equipment->user_id  == $user->id ? 'selected' : ' ' }}
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
                        {{ $currentStatusId == $status->id ? 'selected' : ' ' }}
                        value="{{ $status->id }}">{{$status->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Файлы (.doc,.docx,.pdf,.xlsx,.xlsb)</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="equipment_files[]" multiple>
          </div>

        <div class="card-body">
            @if($equipment_files->isEmpty())
                <p class="text-muted">Файлы не прикреплены.</p>
            @else
            <p>Отметьте файлы на удаление</p>
                <ul class="list-group">
                    @foreach($equipment_files as $file)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <input type="checkbox" name="files_delete[]" value="{{$file->id}}">
                                📄 {{ basename($file->path_to_file) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <br>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Изменить</button>
          </div>

          <br>
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
                @if(is_array(session('success')))
                    @foreach (session('success') as $message)
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
         @endif

        </form>
      </div>
    </div>
  </div>

@endsection