<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <style>
      body {
          min-height: 100vh;
          display: flex;
          flex-direction: column;
          margin: 0;
      }

      main {
          flex: 1;
      }
  </style>


    <!-- Bootstrap JS (локально не работает dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  </head>
<body>
          {{-- Шапка --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <nav class="navbar bg-dark navbar-dark">
            <div class="container-fluid">
              @if(Auth::check())
                    <a class="navbar-brand" href="/account">
                        <img src="{{ asset('images/logo-header.svg')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                        Inventory
                    </a>
              @else
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('images/logo-header.svg')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                        Inventory
                    </a>
              @endif
            </div>
          </nav>

            <ul class="navbar-nav ms-auto">

              @can('admin-only')
              <!-- Сделать CRUD для сущности  -->
              {{--
                @if(Route::currentRouteName() !== 'department.index')
                <li class="nav-item"><a class="nav-link text-white" href={{ route('department.index') }}>Отделы</a></li>
                @endif
              --}}

                @if(Route::currentRouteName() !== 'admin.users.index')
                <li class="nav-item"><a class="nav-link text-white" href={{ route('admin.users.index') }}>Сотрудники</a></li>
                @endif

                @if(Route::currentRouteName() !== 'admin.equipments.index')
                <li class="nav-item"><a class="nav-link text-white" href={{ route('admin.equipments.index') }}>Оборудование</a></li>
                @endif

               <!-- Сделать CRUD для сущности  -->
               {{--
                @if(Route::currentRouteName() !== 'software.index')
                <li class="nav-item"><a class="nav-link text-white" href={{ route('software.index') }}>Софт</a></li>
                @endif
               --}}

               <!-- Сделать CRUD для сущности  -->
               {{--
                @if(Route::currentRouteName() !== 'login.index')
                <li class="nav-item"><a class="nav-link text-white" href={{ route('login.index') }}>Учётные данные</a></li>
                @endif
               --}}

                @if(Route::currentRouteName() !== 'admin.request.index')
                <li class="nav-item"><a class="nav-link text-white" href={{ route('admin.requests.index') }}>Заявки</a></li>
                @endif
              @endcan

              @can('user-only')
                <li class="nav-item"><a class="nav-link text-white" href={{route('account.index')}}>Личный кабинет</a></li>
              @endcan
              <li class="nav-item">
              @if(auth()->check())
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light ms-2">Выйти</button>
                  </form>
              @else
                  <a href="{{ route('login') }}" class="btn btn-outline-light ms-2">Войти</a>
              @endif
              </li>

            </ul>
          </div>
        </div>
      </nav>


          {{-- Секция с контентом между хедером и футером --}}
    <main class="main">
        @yield('navbar')
        @yield('content')
    </main>

    <footer class="bg-body-tertiary py-3">
      <div class="container-fluid">
          <div class="row w-100 text-center">

              <div class="col-md-4 d-flex justify-content-center align-items-center">
                  <img src="{{ asset('images/logo-header.svg') }}" alt="Logo" style="max-height: 50px;" class="img-fluid">
              </div>

              <div class="col-md-4 d-flex justify-content-center align-items-center">
                  Инструкция по использованию ресурса • ТГ • Почта • Телефон
              </div>

              <div class="col-md-4 d-flex justify-content-center align-items-center">
                  2025 ОАЗИС • Inventory v1.0
              </div>

          </div>
      </div>
  </footer>
</body>
</html>
