<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Redireciona dashboard para o controller correto
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified', 'check.blocked'])->name('dashboard');

Route::middleware(['auth', 'check.blocked'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas de compromissos
    Route::resource('appointments', \App\Http\Controllers\AppointmentController::class);

    // Rotas administrativas
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
        Route::patch('/users/{user}/toggle-block', [\App\Http\Controllers\AdminController::class, 'toggleBlock'])->name('users.toggle-block');
        Route::patch('/users/{user}/toggle-admin', [\App\Http\Controllers\AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
        Route::delete('/users/{user}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');
        Route::post('/users/{user}/reset-password', [\App\Http\Controllers\AdminController::class, 'resetPassword'])->name('users.reset-password');
    });

    // Rota para mudança forçada de senha
    Route::get('/password/change', [\App\Http\Controllers\PasswordChangeController::class, 'show'])->name('password.change');
    Route::post('/password/change', [\App\Http\Controllers\PasswordChangeController::class, 'update'])->name('password.update');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordChangeController;

// Rotas protegidas com middlewares customizados
Route::middleware(['auth', 'check.blocked', 'force.password.change'])->group(function () {
    Route::get('/dashboard-custom', [DashboardController::class, 'index'])->name('dashboard.custom');
    Route::resource('appointments', AppointmentController::class);
    Route::get('password/change', [PasswordChangeController::class, 'showForm'])->name('password.change');
    Route::post('password/change', [PasswordChangeController::class, 'update'])->name('password.change.update');
    Route::middleware('admin')->group(function () {
        Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('admin/users/{user}/block', [AdminController::class, 'block'])->name('admin.users.block');
        Route::post('admin/users/{user}/unblock', [AdminController::class, 'unblock'])->name('admin.users.unblock');
    });
});
