@extends('layouts.main')

@section('content')
<div class="container px-4 text-center">
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-auto">
        <input class="form-control" type="text" placeholder="Название">
      </div>

      <div class="col-auto">
        <input class="form-control" type="text" placeholder="Номер телефона">
      </div>
  
      <div class="col-auto">
        <button type="button" class="btn btn-secondary">Найти</button>
      </div>
    </div>
  </div>

  <div class="border-bottom border-dark my-3"></div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
            <tr>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Название</th>
                <th class="text-center align-middle">Номер телефона</th>
                <th class="text-center align-middle">Количество активных сотрудников</th>
                <th class="text-center align-middle">Действия</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($departments as $department)
                <tr>
                  <td>{{ $department->id }}</td>
                  <td>{{ $department->name }}</td>
                  <td>{{ $department->city_phone_number }}</td>
                  <td>{{ $department->user->where('department_id',$department->id)->count() }}</td>
                  <td>
                      <a href="#" class="btn btn-sm btn-outline-info">Подробнее</a>
                  </td>
                </tr>
                @endforeach
        </tbody>
    </table>
</div>

  <a href="#" class="btn btn-primary position-fixed" style="bottom: 100px; right: 30px; z-index: 999;">
    ➕ Добавить
    </a>
@endsection