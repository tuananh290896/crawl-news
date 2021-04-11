<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\EditorController;

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
  Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
  Route::post('/ckeditor/upload', [EditorController::class, 'upload'])->name('admin.editor.upload');

  Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('admin.news');
    
    Route::get('/create', [NewsController::class, 'create'])->name('admin.news.create');

    Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/update/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::post('/store', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/delete/{id}', [NewsController::class, 'destroy'])->name('admin.news.delete');
  });
});