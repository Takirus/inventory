@extends('layouts.main')

@section('content')
<div class="container px-4 text-center">
  <div class="container mt-3">
  <div class="row justify-content-center">
    <form action="{{ route('admin.users.index') }}" method="GET">
        <div class="row justify-content-center g-4 align-items-center">
    
            <div class="col-auto">
                <input class="form-control" type="text" name="name_employee" value="{{ $nameEmployee_value }}" placeholder="Имя сотрудника">
            </div>

            <div class="col-auto">
              <input class="form-control" type="text" name="position" value="{{ $position_value }}" placeholder="Должность">
          </div>
        
            <div class="col-auto">
                <select class="form-select" name="status" aria-label="статус сотрудника">
                    <option value="" selected>Статус сотрудника</option>
                    <option value="Активен" {{ request('status') == 'Активен' ? 'selected' : '' }}>Активен</option>
                    <option value="Уволен" {{ request('status') == 'Уволен' ? 'selected' : '' }}>Уволен</option>
                    <option value="В отпуске" {{ request('status') == 'В отпуске' ? 'selected' : '' }}>В отпуске</option>
                    <option value="На больничном" {{ request('status') == 'На больничном' ? 'selected' : '' }}>На больничном</option>
                </select>
            </div>

            <div class="col-auto">
              <select class="form-select" name="department" aria-label="отдел сотрудника">
                  <option value="" selected>Отдел сотрудника</option>
                  <option value="ОРИСБП" {{ request('department') == 'ОРИСБП' ? 'selected' : '' }}>ОРИСБП</option>
                  <option value="ОГМУ" {{ request('department') == 'ОГМУ' ? 'selected' : '' }}>ОГМУ</option>
                  <option value="ОАЗИС" {{ request('department') == 'ОАЗИС' ? 'selected' : '' }}>ОАЗИС</option>
                  <option value="ОРЭП" {{ request('department') == 'ОРЭП' ? 'selected' : '' }}>ОРЭП</option>
                  <option value="Бухгалтерия" {{ request('department') == 'Бухгалтерия' ? 'selected' : '' }}>Бухгалтерия</option>
                  <option value="Импортозамещение" {{ request('department') == 'Импортозамещение' ? 'selected' : '' }}>Импортозамещение</option>
              </select>
          </div>
    
            <div class="col-auto d-flex align-items-center">
                <label for="pages" class="me-2 mb-0">Показать:</label>
                <select name="pages" id="pages" class="form-select w-auto"
                        onchange="this.form.submit()">
                    <option value="6" {{ request('pages') == 6 ? 'selected' : '' }}>6</option>
                    <option value="12" {{ request('pages') == 12 ? 'selected' : '' }}>12</option>
                    <option value="18" {{ request('pages') == 18 ? 'selected' : '' }}>18</option>
                </select>
            </div>
    
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary">Найти</button>
            </div>
    
          </div>
      </form>
    </div>
  </div>

    <div class="border-bottom border-dark my-3"></div>

    <div class="row">
      @foreach ($users as $user)
        <div class="col-md-4 mb-3">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">{{ $user->position }}</p>
            </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex align-items-center justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone me-1" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                </svg>
                {{ $user->inside_code }}
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-center"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope me-1" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                  </svg> {{ $user->email }}
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people me-1" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                </svg>
                {{ $user->department->name ?? 'Отдел не назначен' }}
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-center text-{{ App\Helpers\getColorByName::getColor($user->statusUser->first()?->color) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock me-1" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                  </svg>
                {{ $user->statusUser->first()->name ?? 'Не известен' }}
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell me-1" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                  </svg>
                Активных заявок: {{ $user->requests()->whereHas('status',function($q){
                    $q->whereIn('name',['В работе','Новая', 'Отложена', 'Требуется дополнительная информация']);
                })->count() }}
            </li>
            </ul>
            <div class="card-body">
                <a href="{{route('admin.users.show', $user->id)}}" class="card-link">Подробнее</a>
                <a href="{{route('admin.users.edit', $user->id)}}" class="card-link">Редактировать</a>
            </div>
            </div>
        </div>
        @endforeach

    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{ $users->links('pagination::bootstrap-5') }}

    </div>
</div>
@endsection