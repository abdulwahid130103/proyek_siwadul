<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengadu\BerandaController;
use App\Http\Controllers\Pengadu\HistoryController;
use App\Http\Controllers\Pengadu\NotificationsController;
use App\Http\Controllers\Pengadu\PengaduanController;
use App\Http\Controllers\Pengadu\UserController;

Route::get('/',[BerandaController::class,'index']);

Route::resource('/beranda',BerandaController::class);
Route::middleware(['auth','cekJabatan:pengadu'])->group(function () {
    Route::resource('userFrontend',UserController::class);
    Route::resource('history',HistoryController::class);
    Route::resource('notificationsFrontend',NotificationsController::class);
    Route::resource('pengaduan',PengaduanController::class);
});