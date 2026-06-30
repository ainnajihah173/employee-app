<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('employees', EmployeeController::class);
});

require __DIR__.'/auth.php';