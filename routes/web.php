<?php

use App\Http\Controllers\PositionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
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
Route::get('/data-unit/dropdown', [UnitController::class, 'listUnit']);
Route::get('/data-unit/create', [UnitController::class, 'create']);
Route::post('/data-unit', [UnitController::class, 'store'])->name('storeUnit');
Route::get('/data-unit/tabel', [UnitController::class, 'table']);
Route::get('/data-unit/{unit}', [UnitController::class, 'show']);
Route::get('/data-unit/{unit}/edit', [UnitController::class, 'edit']);
Route::post('/data-unit/{unit}/update', [UnitController::class, 'update']);
Route::get('/data-unit/{unit}/delete', [UnitController::class, 'destroy']);

Route::get('/data-jabatan', [PositionController::class, 'index']);
Route::get('/data-jabatan/create', [PositionController::class, 'create']);
Route::get('/data-jabatan/dropdown', [PositionController::class, 'listPosition']);
Route::post('/data-jabatan', [PositionController::class, 'store'])->name('storePosition');
Route::get('/data-jabatan/tabel', [PositionController::class, 'table']);
Route::get('/data-jabatan/{position}', [PositionController::class, 'show']);
Route::get('/data-jabatan/{position}/edit', [PositionController::class, 'edit']);
Route::post('/data-jabatan/{position}/update', [PositionController::class, 'update']);
Route::get('/data-jabatan/{position}/delete', [PositionController::class, 'destroy']);

Route::get('/data-karyawan', [UserController::class, 'index']);
Route::get('/data-karyawan/create', [UserController::class, 'create'])->name('createEmployee');
Route::post('/data-karyawan', [UserController::class, 'store'])->name('storeEmployee');
Route::get('/data-karyawan/tabel', [UserController::class, 'table']);
Route::get('/data-karyawan/{user}', [UserController::class, 'show']);
Route::get('/data-karyawan/{user}/edit', [UserController::class, 'edit']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
