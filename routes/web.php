<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/1', [HomeController::class, 'pertama'])->name('pertama');
Route::get('/2', [HomeController::class, 'kedua'])->name('kedua');
Route::get('/3', [HomeController::class, 'ketiga'])->name('ketiga');
Route::post('/user/list-user/sp', [UserController::class, 'getDataSp'])->name('list-user-sp');
Route::post('/user/list-user/qb', [UserController::class, 'getDataQb'])->name('list-user-qb');
