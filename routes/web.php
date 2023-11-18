<?php

use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', static function () {
    return redirect()->route('booking.index');
})->name('home');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/bookings')->controller(BookingController::class)->name('booking.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('', 'store')->name('store')->middleware('booking.check');
    });

    Route::prefix('/availabilities')->controller(AvailabilityController::class)->name('availability.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('/search', 'search')->name('search');
    });
});
