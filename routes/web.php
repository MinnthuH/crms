<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\PasswordController;

require __DIR__.'/auth.php';
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


Route::middleware('auth:admin_users')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/change-password', [PasswordController::class, 'edit'])->name('change.password.edit');
    Route::put('/change-password', [PasswordController::class, 'update'])->name('change.password.update');
 
});


Route::middleware('auth:admin_users')->group(function () {
   Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

   Route::resource('admin-user', AdminUserController::class);
   Route::get('admin-user-databale', [AdminUserController::class, 'databale'])->name('admin-user-databale');

   Route::resource('hall', HallController::class);
   Route::get('hall-databale', [HallController::class, 'databale'])->name('hall-databale');
});

