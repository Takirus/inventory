@extends('layouts.main')

@section('content')
<div class="container px-4 text-center">
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-auto">
        <input class="form-control" type="text" placeholder="Название">
      </div>

      <div class="col-auto">
        <input class="form-control" type="text" placeholder="Разработчик">
      </div>
  
      <div class="col-auto d-flex align-items-center gap-2">
        <label for="date" class="form-label mb-0 text-nowrap">Дата окончания лицензии:</label>
        <input type="date" class="form-control" id="date" name="date">
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
                <th class="text-center align-middle">Наименование</th>
                <th class="text-center align-middle">Разработчик</th>
                <th class="text-center align-middle">Количество используемых версий</th>
                <th class="text-center align-middle">Максимальное количество устройств</th>
                <th class="text-center align-middle">Действия</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($softwares as $software)
                <tr>
                  <td>{{ $software->id }}</td>
                  <td>{{ $software->name }}</td>
                  <td>{{ $software->vendor }}</td>
                  <td>{{ $software->softwareVersion->count() }}</td> 
                  <td>{{ $software->license_device_limit }}</td>
                  <td>
                      <a href="#" class="btn btn-sm btn-outline-info">Подробнее</a>
                  </td>
                </tr>
                @endforeach
        </tbody>
    </table>
</div>
{{ $softwares->links('pagination::bootstrap-5') }}

  <a href="#" class="btn btn-primary position-fixed" style="bottom: 100px; right: 30px; z-index: 999;">
    ➕ Добавить
    </a>
@endsection