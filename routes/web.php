<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
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

        Route::prefix('academic-years')->name('academic.years.')->group(function() {
            Route::controller(AcademicYearController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{academicYear:slug}', 'edit')->name('edit');
                Route::put('/update/{academicYear:slug}', 'update')->name('update');
                Route::delete('/delete/{academicYear:slug}', 'destroy')->name('destroy');
            });
        });

        Route::prefix('classrooms')->name('classrooms.')->group(function() {
            Route::controller(ClassroomController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{classroom:slug}', 'edit')->name('edit');
                Route::put('/update/{classroom:slug}', 'update')->name('update');
                Route::delete('/delete/{classroom:slug}', 'destroy')->name('destroy');
            });
        });

        Route::prefix('students')->name('students.')->group(function() {
            Route::controller(StudentController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/show/{student}', 'edit')->name('show');
                Route::get('/edit/{student}', 'edit')->name('edit');
                Route::put('/update/{student}', 'update')->name('update');
                Route::delete('/delete/{student}', 'destroy')->name('destroy');
            });
        });

    });

});