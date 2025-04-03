<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::prefix('admin')->name('admin.')->group(function() {

    Route::middleware('auth')->group(function() {
        
        Route::get('/dashboard', DashboardController::class);

    });

});