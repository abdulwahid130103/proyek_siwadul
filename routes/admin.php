<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\JenisPengaduanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\LaporanPengaduanController;
use App\Http\Controllers\Admin\ManageStatusController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\PengurusController;

Route::middleware(['auth','cekJabatan:admin,kaprodi,laboran,adminprodi'])->prefix('admin')->group(function () {

    Route::resource('dashboard',DashboardController::class);
    Route::resource('jabatan',JabatanController::class);
    Route::resource('user',UserController::class);
    Route::resource('jenisPengaduan',JenisPengaduanController::class);
    Route::resource('pengaduan',PengaduanController::class);
    Route::resource('history',HistoryController::class);
    Route::resource('pengurus',PengurusController::class);
    Route::resource('manage',ManageStatusController::class);
    Route::resource('laporanPengaduan',LaporanPengaduanController::class);
    Route::resource('notifications',NotificationsController::class);
    Route::get('laporanPengaduanData',[LaporanPengaduanController::class,'laporanPengaduanData']);
    Route::get('laporanPengaduanExcell',[LaporanPengaduanController::class,'exportExcellPengaduan'])->name('exportExcellPengaduan');
    Route::put('user/{id}/password',[UserController::class,'updatePassword'])->name('user.password');
    Route::put('pengurus/konfirmasiPengaduan/{id}',[PengurusController::class,'konfirmasiKaprodi']);
    Route::put('pengurus/konfirmasiAdmin/{id}',[PengurusController::class,'konfirmasiAdmin']);
    Route::put('pengurus/konfirmasiTersampaikan/{id}',[PengurusController::class,'konfirmasiTersampaikan']);
    Route::put('pengurus/konfirmasiSelesai/{id}',[PengurusController::class,'konfirmasiSelesai']);
    Route::put('pengurus/tolakPengaduan/{id}',[PengurusController::class,'tolakPengaduan']);
    Route::put('manage/updateStatusData/{id}',[ManageStatusController::class,'updateStatusData']);
    Route::get('adminProfile/{id}',[DashboardController::class,'showProfile']);
    Route::get('showChartMinggu',[DashboardController::class,'showChartMinggu']);
    Route::get('showChartBulan',[DashboardController::class,'showChartBulan']);
    Route::get('showChartTahun',[DashboardController::class,'showChartTahun']);
});