@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        @if ($errors->has('message'))
            <div class="text-bg-danger p-3">
                <h1 class="text-center"> {{ $errors->first('message') }} </h1>
            </div>
        @else
            <h1 class="text-center">Добро пожаловать в систему учета</h1>
            <p class="mt-4 fs-5 text-center">
                Это внутренняя информационная система для учета оборудования, программного обеспечения и сотрудников.
            </p>

            @if (!auth())
                <div class="mt-5 text-center">
                    <p>Пожалуйста, <a href="{{ route('login') }}">войдите</a>, чтобы получить доступ к личному кабинету.</p>
                </div> 
            @endif
        @endif
    </div>
@endsection