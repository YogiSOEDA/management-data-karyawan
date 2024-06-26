<?php

use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/data-unit', [UnitController::class, 'index']);
Route::get('/data-unit/create', [UnitController::class, 'create']);
Route::post('/data-unit', [UnitController::class, 'store'])->name('storeUnit');
Route::get('/data-unit/tabel', [UnitController::class, 'table']);
Route::get('/data-unit/{unit}', [UnitController::class, 'show']);
Route::get('/data-unit/{unit}/edit', [UnitController::class, 'edit']);
Route::post('/data-unit/{unit}/update', [UnitController::class, 'update']);
Route::get('/data-unit/{unit}/delete', [UnitController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
