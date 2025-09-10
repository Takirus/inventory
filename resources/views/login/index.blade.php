@extends('layouts.main')

@section('content')
<div class="container px-4 text-center">
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-auto">
        <input class="form-control" type="text" placeholder="Сотрудник">
      </div>

      <div class="col-auto">
        <input class="form-control" type="text" placeholder="Устройство">
      </div>

      <div class="col-auto">
        <input class="form-control" type="text" placeholder="ПО">
      </div>
  
      <div class="col-auto">
        <input class="form-control" type="text" placeholder="Логин">
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
                <th class="text-center align-middle">Сотрудник</th>
                <th class="text-center align-middle">Устройство</th>
                <th class="text-center align-middle">ПО</th>
                <th class="text-center align-middle">Логин</th>
                <th class="text-center align-middle">Пароль</th> 
                <th class="text-center align-middle">Комментарий</th>
                <th class="text-center align-middle">Действия</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($logins as $login)
          <tr>
              <td>{{ $login->id }}</td>
              <td>{{ $login->user->name }}</td>
              <td>{{ $login->equipment->model ?? '-' }}</td>
              <td>{{ $login->software->name }}</td>
              <td>{{ $login->login }}</td>
              <td>{{ $login->password }}</td>
              <td>{{ $login->comment }}</td>
              <td>
                  <a href="#" class="btn btn-sm btn-outline-info">Подробнее</a>
              </td>
          </tr> 
          @endforeach
        </tbody>
    </table>
</div>

{{ $logins->links('pagination::bootstrap-5') }}

  <a href="#" class="btn btn-primary position-fixed" style="bottom: 100px; right: 30px; z-index: 999;">
    ➕ Добавить
    </a>
@endsection