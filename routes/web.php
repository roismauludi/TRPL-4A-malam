<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardCarbonController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TurnController;
use App\Http\Controllers\EnergyUsageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ResetPasswordController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');
    Route::get('/dashboardcarbon', [DashboardCarbonController::class, 'DashboardCarbon'])->name('dashboardcarbon');
    Route::get('/turn', [TurnController::class, 'Turn'])->name('turn');
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('/laporan/gedung/{gedung}', [LaporanController::class, 'index'])->name('laporan.gedung');
    Route::get('/gedung1', [LaporanController::class, 'gedung1'])->name('laporan.gedung1');
    Route::get('/gedung2', [LaporanController::class, 'gedung2'])->name('laporan.gedung2');
    Route::get('/gedung3', [LaporanController::class, 'gedung3'])->name('laporan.gedung3');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/energy-usage/download-pdf/{gedung}', [EnergyUsageController::class, 'downloadEnergyUsagePDF'])
        ->name('energy-usage.downloadPDF');
});

Route::middleware(['auth:web', 'ceklevel:admin'])->group(function () {
    Route::get('/admin/list', [AuthController::class, 'index'])->name('admin.list');
    Route::get('/profil', [AuthController::class, 'profil'])->name('admin.profil');
    Route::get('/profil/edit/{id_staff}', [AuthController::class, 'editprofil'])->name('admin.editprofil');
    Route::put('/profil/update/{id_staff}', [AuthController::class, 'updateprofil'])->name('admin.updateprofil');
    Route::get('/detail-{id}', [AuthController::class, 'detail'])->name('admin.detail');
    Route::get('/list', [AuthController::class, 'index'])->name('admin.index');
    Route::get('/admin/edit/{id}', [AuthController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AuthController::class, 'update'])->name('admin.update');
});
