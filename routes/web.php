<?php

use App\Models\off;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthCustom;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\OffController;
use App\Models\User;
use App\Models\intern;
use App\Models\hr;
use App\Models\application;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome')->with('mode', 1);
});

// 0 auth 
// 1 admin
// 2 user

//Auth::routes();

Route::get('/rh/all', function() {
    return hr::all();
});
Route::get('/application/all', function() {
    $applications = application::all(); 
    foreach ($applications as $key => $app) {
        $app->user = User::find($app->user_id);
        $app->rh = User::find($app->hr_id);
    }
    return $applications;
});
Route::get('/employees/all', function() {
    $applications = intern::all(); 
    foreach ($applications as $key => $app) {
        $app->user = User::find($app->user_id);
        $app->rh = User::find($app->hr_id);
    }
    return $applications;
});
Route::get('/off/all', function() {
    $applications = off::all(); 
    foreach ($applications as $key => $app) {
        $app->user = User::find(intern::find($app->intern_id)->user_id);
    }
    return $applications;
});
Route::post('/user/application', [ApplicationController::class, 'store']);
Route::post('/user/application/judge', [ApplicationController::class, 'judge']);
Route::post('/user/off', [OffController::class, 'store']);

Route::post('/login', [AuthCustom::class, 'customLogin'])->name('login.custom'); 
Route::get('/login', function() {
    return view('welcome')->with('mode', 0);
});
Route::post('/register', [AuthCustom::class, 'customRegister'])->name('register.custom'); 
Route::get('/register', function() {
    return view('welcome')->with('mode', 0);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
