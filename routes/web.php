<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Admin\HospitalController as AdminHospitalController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminDashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard');
        });
        Route::prefix('hospitals')->group(function () {
            Route::controller(AdminHospitalController::class)->group(function () {
                Route::get('/', 'index')->name('admin.hospitals.index');
                Route::get('/create', 'create')->name('admin.hospitals.create');
                Route::post('/', 'store')->name('admin.hospitals.store');
                Route::get('/{hospital}', 'show')->name('admin.hospitals.show');
                Route::get('/{hospital}/edit', 'edit')->name('admin.hospitals.edit');
                Route::put('/{hospital}', 'update')->name('admin.hospitals.update');
                Route::delete('/{hospital}', 'destroy')->name('admin.hospitals.destroy');
            });
        });
        Route::prefix('patients')->group(function () {
            Route::controller(AdminPatientController::class)->group(function () {
                Route::get('/', 'index')->name('admin.patients.index');
                Route::get('/create', 'create')->name('admin.patients.create');
                Route::post('/', 'store')->name('admin.patients.store');
                Route::get('/{patient}', 'show')->name('admin.patients.show');
                Route::get('/{patient}/edit', 'edit')->name('admin.patients.edit');
                Route::put('/{patient}', 'update')->name('admin.patients.update');
                Route::delete('/{patient}', 'destroy')->name('admin.patients.destroy');
            });
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
