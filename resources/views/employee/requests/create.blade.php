@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h4 class="text-center mb-4">Создать заявку</h4>

        <form action="{{ route('employee.requests.store') }}" method="POST">
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
                <option value="" selected disabled>Доступное оборудование</option>
                @foreach($equipments as $equipment)
                @php
                  $type_equipment = App\Models\TypeEquipment::where('id',$equipment->type_id)->first();
                  
                @endphp
                    <option
                        value="{{ $equipment->id }}">{{$type_equipment->name}} - {{$equipment->model}}</option>
                @endforeach
            </select>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Отправить</button>
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