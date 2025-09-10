<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('index');
})->name('index');




Route::get('/software', '\App\Http\Controllers\SoftwareController@index')->name('software.index');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::group(['namespace' => 'Users'], function () {
        Route::get('/users', 'IndexController@index')->name('admin.users.index');
        Route::get('/users/{user}', 'ShowController@show')->name('admin.users.show');
        Route::get('/users/{user}/edit', 'UpdateController@edit')->name('admin.users.edit');
        Route::patch('/users/{user}', 'UpdateController@update')->name('admin.users.update');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::group(['namespace' => 'Requests'], function () {
        Route::get('/requests', 'IndexController@index')->name('admin.requests.index');
        Route::get('/requests/create', 'CreateController@create')->name('admin.requests.create');
        Route::post('/requests', 'CreateController@store')->name('admin.requests.store');
        Route::get('/requests/{req}', 'ShowController@show')->name('admin.requests.show');
        Route::get('/requests/{request}/edit', 'UpdateController@edit')->name('admin.requests.edit');
        Route::patch('/requests/{req}', 'UpdateController@update')->name('admin.requests.update');
        Route::delete('/requests/{req}', 'DeleteController@destroy')->name('admin.requests.delete');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Employee', 'prefix' => 'employee', 'middleware' => 'employee'], function () {
    Route::group(['namespace' => 'Requests'], function () {
        Route::get('/requests/create', 'CreateController@create')->name('employee.requests.create');
        Route::post('/requests', 'CreateController@store')->name('employee.requests.store');
        Route::get('/requests/{req}', 'ShowController@show')->name('employee.requests.show');
        Route::get('/requests/{request}/edit', 'UpdateController@edit')->name('employee.requests.edit');
        Route::patch('/requests/{req}', 'UpdateController@update')->name('employee.requests.update');
        Route::delete('/requests/{req}', 'DeleteController@destroy')->name('employee.requests.delete');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::group(['namespace' => 'Equipments'], function () {
        Route::get('/equipments', 'IndexController@index')->name('admin.equipments.index');
        Route::get('/equipments/create', 'CreateController@create')->name('admin.equipments.create');
        Route::post('/equipments', 'CreateController@store')->name('admin.equipments.store');
        Route::get('/equipments/{equipment}', 'ShowController@show')->name('admin.equipments.show');
        Route::get('/equipments/{equipment}/edit', 'UpdateController@edit')->name('admin.equipments.edit');
        Route::patch('/equipments/{equipment}', 'UpdateController@update')->name('admin.equipments.update');
        Route::delete('/equipments/{equipment}', 'DeleteController@destroy')->name('admin.equipments.delete');

        Route::get('/equipments/{equipment}/files/types', 'CreateController@selectTypes')->name('admin.equipments.linking');
        Route::post('/equipments/{equipment}/files/store', 'CreateController@storeFilesWithTypes')->name('admin.equipments.linking.store');
    });
});


Route::get('/departments', '\App\Http\Controllers\DepartmentController@index')->name('department.index');

Route::get('/logins', '\App\Http\Controllers\LoginController@index')->name('login.index');

Route::get('/account', '\App\Http\Controllers\AccountController@index')->name('account.index');


Auth::routes();
use App\Http\Controllers\Auth\RegisterController;
Route::get('register', [RegisterController::class, 'showRegistrationForm'])
    ->middleware(['auth', 'admin'])
    ->name('register');

Route::post('register', [RegisterController::class, 'register'])
    ->middleware(['auth', 'admin']);

//['register' => false]
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
