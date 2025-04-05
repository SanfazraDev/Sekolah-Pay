<?php

use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::prefix('admin')->name('admin.')->group(function() {

    Route::middleware('auth')->group(function() {
        
        Route::get('/dashboard', DashboardController::class);

        Route::prefix('batches')->name('batches.')->group(function() {
            Route::controller(BatchController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{batch:slug}', 'edit')->name('edit');
                Route::put('/update/{batch:slug}', 'update')->name('update');
                Route::delete('/delete/{batch:slug}', 'destroy')->name('destroy');
            });
        });

    });

});