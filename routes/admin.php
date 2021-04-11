<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;

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

Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('admin.login.post');

Route::middleware('auth:admin')->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

  Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('admin.news');
  });
});