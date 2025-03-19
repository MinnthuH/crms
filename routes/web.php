<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpcController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SnackShopController;
use App\Http\Controllers\TicketPriceController;
use App\Http\Controllers\CinemaReportController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\SnackShopUserController;
use App\Http\Controllers\SnackShopReportController;

require __DIR__ . '/auth.php';
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


Route::middleware(['auth:admin_users', 'admin.role'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('admin-user', AdminUserController::class);
    Route::get('admin-user-databale', [AdminUserController::class, 'databale'])->name('admin-user-databale');

    Route::resource('user', UserController::class);
    Route::get('user-databale', [UserController::class, 'databale'])->name('user.datatable');

    Route::resource('hall', HallController::class);
    Route::get('hall-databale', [HallController::class, 'databale'])->name('hall-databale');

    Route::resource('showtime', ShowtimeController::class);
    Route::get('showtime-datatable', [ShowtimeController::class, 'datatable'])->name('showtime.datatable');

    Route::resource('ticket-price', TicketPriceController::class);
    Route::get('ticket-price-datatable', [TicketPriceController::class, 'datatable'])->name('ticket-price.datatable');

    Route::resource('movie', MovieController::class);
    Route::get('movie-datatable', [MovieController::class, 'datatable'])->name('movie.datatable');

    Route::resource('cinema', CinemaController::class);
    Route::get('cinema-datatable', [CinemaController::class, 'datatable'])->name('cinema.datatable');

    Route::resource('snack-shop', SnackShopController::class);
    Route::get('snack-shop-databale', [SnackShopController::class, 'databale'])->name('snack-shop.datatable');

    Route::resource('snack-shop-user', SnackShopUserController::class);
    Route::get('snack-shop-user-databale', [SnackShopUserController::class, 'databale'])->name('snack-shop-user.datatable');

    Route::resource('epc', EpcController::class);
    Route::get('epc-datatable', [EpcController::class, 'datatable'])->name('epc.datatable');



    Route::get('cinema-report/download', [CinemaReportController::class, 'downloadDailyReport'])->name('cinema-report.download');
    Route::get('export-weekly', [CinemaReportController::class, 'exportWeekly'])->name('export.weekly');

    Route::get('snack-shop-report/download', [SnackShopReportController::class, 'downloadDailyReport'])->name('snack-shop-report.download');
    Route::get('export-snack-shop-weekly', [SnackShopReportController::class, 'exportWeekly'])->name('export-snack-shop-weekly');

   
});

Route::middleware('auth:admin_users')->group(function () {
   
    Route::resource('cinema-report', CinemaReportController::class);
    Route::get('cinema-report-databale', [CinemaReportController::class, 'datatable'])->name('cinema-report-databale');

    Route::resource('snack-shop-report', SnackShopReportController::class);
    Route::get('snack-shop-report-databale', [SnackShopReportController::class, 'datatable'])->name('snack-shop-report-databale');

    

});