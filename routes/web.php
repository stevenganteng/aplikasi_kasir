<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\ParkingAreaController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard - redirect based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user === null) {
        return redirect()->route('login');
    }
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isPetugas()) {
        return redirect()->route('petugas.dashboard');
    } elseif ($user->isOwner()) {
        return redirect()->route('owner.dashboard');
    }
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Guest routes
Route::middleware('guest')->group(function () {
    // Login routes are handled by Breeze auth
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================
// ADMIN ROUTES
// =====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // User Management
    Route::resource('users', UserController::class);
    
    // Tariff Management
    Route::resource('tariffs', TariffController::class);
    
    // Parking Area Management
    Route::resource('parking-areas', ParkingAreaController::class);
    
    // Vehicle Management
    Route::resource('vehicles', VehicleController::class);
    
    // Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('/activity-logs/{activityLog}', [ActivityLogController::class, 'show'])->name('activity-logs.show');
    Route::delete('/activity-logs/clear', [ActivityLogController::class, 'clear'])->name('activity-logs.clear');
});

// =====================
// PETUGAS ROUTES
// =====================
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    })->name('dashboard');

    // Parking Operations
    Route::get('/parking/create', [TransactionController::class, 'create'])->name('parking.create');
    Route::post('/parking', [TransactionController::class, 'store'])->name('parking.store');
    Route::get('/parking/active', [TransactionController::class, 'active'])->name('parking.active');
    Route::get('/parking/{transaction}/exit', [TransactionController::class, 'exit'])->name('parking.exit');
    Route::put('/parking/{transaction}/exit', [TransactionController::class, 'processExit'])->name('parking.exit.process');
    Route::get('/parking/{transaction}/print', [TransactionController::class, 'print'])->name('parking.print');
    
    // Transaction History
    Route::get('/transactions', [TransactionController::class, 'history'])->name('transactions.history');
});

// =====================
// OWNER ROUTES
// =====================
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('dashboard');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/custom', [ReportController::class, 'custom'])->name('reports.custom');
    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
});

require __DIR__.'/auth.php';
