<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WellController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WellReadingController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('wells', WellController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('readings', WellReadingController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->parameters([
            'readings' => 'wellReading',
        ]);
    Route::resource('reports', ReportController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
