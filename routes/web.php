<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\KibTanahController;
use App\Http\Controllers\PenandatanganController;


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

Route::post('/ganti-password',[AuthController::class, 'ganti_password'])->name('ganti.password');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/',[AuthController::class, 'index'])->name('login.page');
Route::get('/login',[AuthController::class, 'index'])->name('login');

Route::post('/login',[AuthController::class, 'login'])->name('login.auth');
Route::group(['middleware' => ['cekLogin:dinas']], function () {
    Route::get('/dashboard-dinas',[DinasController::class, 'dashboard'])->name('dashboard.dinas');
    Route::get('/admin-kib-tanah',[DinasController::class, 'kib'])->name('kib.tanah');
    Route::get('/admin-kib-tanah-pencarian',[DinasController::class, 'kib_pencarian'])->name('kib.tanah.pencarian');
    Route::get('/admin-kib-tanah-cetak',[DinasController::class, 'kib_cetak'])->name('kib.tanah.cetak');
    Route::get('/admin-kib-tanah-print',[DinasController::class, 'kib_print'])->name('admin.kib.tanah.print');
    
    Route::get('/daftar-opd',[DinasController::class, 'opd'])->name('opd');
    Route::post('/daftar-opd',[DinasController::class, 'opd_store'])->name('opd.store');
    Route::put('/opd/{id}',[DinasController::class, 'opd_update'])->name('opd.update');
    Route::delete('/daftar-opd/{id}',[DinasController::class, 'opd_delete'])->name('opd.delete');

});

Route::group(['middleware' => ['cekLogin:opd']], function () {
    Route::get('/dashboard-opd',[OpdController::class, 'dashboard'])->name('dashboard.opd');
    Route::get('/kib-tanah',[KibTanahController::class, 'index'])->name('kib.tanah');
    Route::get('/kib-tanah-pencarian',[KibTanahController::class, 'pencarian'])->name('kib.tanah.pencarian');
    Route::get('/kib-tanah-cetak',[KibTanahController::class, 'cetak'])->name('kib.tanah.cetak');
    Route::get('/kib-tanah-print',[KibTanahController::class, 'print'])->name('kib.tanah.print');
    
    Route::get('/penandatangan',[PenandatanganController::class, 'index'])->name('penandatangan');
    Route::put('/penandatangan-pimpinan/{id}',[PenandatanganController::class, 'update_pimpinan'])->name('update.pimpinan');
    Route::put('/penandatangan-pengurus/{id}',[PenandatanganController::class, 'update_pengurus'])->name('update.pengurus');

    Route::post('/kib-tanah',[KibTanahController::class, 'store'])->name('kib.store');
    Route::put('/kib-tanah/{id}',[KibTanahController::class, 'update'])->name('kib.update');
    Route::delete('/kib-tanah/{id}',[KibTanahController::class, 'destroy'])->name('kib.delete');
});

