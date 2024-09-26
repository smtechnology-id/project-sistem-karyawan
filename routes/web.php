<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.check:admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.dashboard');

    // Satuan Kerja
    Route::get('/admin/satuan-kerja', [AdminController::class, 'satuanKerja'])->name('admin.satuan-kerja');
    Route::get('/admin/satuan-kerja/create', [AdminController::class, 'satuanKerjaCreate'])->name('admin.satuan-kerja.create');
    Route::post('/admin/satuan-kerja/store', [AdminController::class, 'satuanKerjaStore'])->name('admin.satuan-kerja.store');
    Route::post('/admin/satuan-kerja/update', [AdminController::class, 'satuanKerjaUpdate'])->name('admin.satuan-kerja.update');
    Route::get('/admin/satuan-kerja/delete/{id}', [AdminController::class, 'satuanKerjaDelete'])->name('admin.satuan-kerja.delete');


    // Karyawan
    Route::get('/admin/karyawan', [AdminController::class, 'karyawan'])->name('admin.karyawan');
    Route::get('/admin/karyawan/create', [AdminController::class, 'karyawanCreate'])->name('admin.karyawan.create');
    Route::post('/admin/karyawan/store', [AdminController::class, 'karyawanStore'])->name('admin.karyawan.store');
    Route::get('/admin/karyawan/edit/{id}', [AdminController::class, 'karyawanEdit'])->name('admin.karyawan.edit');
    Route::post('/admin/karyawan/update', [AdminController::class, 'karyawanUpdate'])->name('admin.karyawan.update');
    Route::get('/admin/karyawan/delete/{id}', [AdminController::class, 'karyawanDelete'])->name('admin.karyawan.delete');

    // profile
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
});

Route::middleware('auth.check:user')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');

    // profile
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/karyawan', [UserController::class, 'karyawan'])->name('user.karyawan');
    Route::get('/user/satuan-kerja', [UserController::class, 'satuanKerja'])->name('user.satuan-kerja');
});
