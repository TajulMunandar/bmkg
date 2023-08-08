<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardApproveController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardUserController;

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

Route::get('/', [UmumController::class, 'index'])->name('umum.index');
Route::post('/umum', [UmumController::class, 'store'])->name('umum.store');

Route::prefix('/mahasiswa')->group(function () {
    Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
});

Route::prefix('/instansi')->group(function () {
    Route::get('/', [InstansiController::class, 'index'])->name('instansi.index');
    Route::post('/instansi', [InstansiController::class, 'store'])->name('instansi.store');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
    Route::resource('/user', DashboardUserController::class);
    Route::prefix('/approve')->group(function () {
        Route::prefix('/instansi')->group(function () {
            Route::get('/', [DashboardApproveController::class, 'instansi'])->name('DashboardIntansi.index')->middleware('auth');
            Route::put('/approve', [DashboardApproveController::class, 'approveInstansi'])->name('ApproveInstansi.put')->middleware('auth');
            Route::put('/disapprove', [DashboardApproveController::class, 'disapproveInstansi'])->name('DisapproveInstansi.put')->middleware('auth');
        });
        Route::prefix('/mahasiswa')->group(function () {
            Route::get('/', [DashboardApproveController::class, 'mahasiswa'])->name('DashboardMahasiswa.index')->middleware('auth');
            Route::put('/approve', [DashboardApproveController::class, 'approveMahasiswa'])->name('ApproveMahasiswa.put')->middleware('auth');
            Route::put('/disapprove', [DashboardApproveController::class, 'disapproveMahasiswa'])->name('DisapproveMahasiswa.put')->middleware('auth');
        });
        Route::prefix('/umum')->group(function () {
            Route::get('/', [DashboardApproveController::class, 'umum'])->name('DashboardUmum.index')->middleware('auth');
            Route::put('/approve', [DashboardApproveController::class, 'approveUmum'])->name('ApproveUmum.put')->middleware('auth');
            Route::put('/disapprove', [DashboardApproveController::class, 'disapproveUmum'])->name('DisapproveUmum.put')->middleware('auth');
        });
    });

    Route::post('/user/reset-password', [DashboardUserController::class, 'resetPasswordAdmin'])->name('user.reset')->middleware('auth');
});
