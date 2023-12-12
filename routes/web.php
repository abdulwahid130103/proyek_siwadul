<?php


use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\JenisPengaduanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
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

Route::controller(LoginController::class)->group(function(){
    Route::get('/login','index')->name('login');
    Route::post('/login','authenticate')->name('authenticate');
    Route::get('/logout','logout')->name('logout');
});

