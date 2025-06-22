<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/polygons', 'polygons')->name('polygons');
        Route::get('/drivers', 'drivers')->name('drivers');
    });
    Route::controller(PolygonController::class)->prefix('/polygons')->group(function () {
        Route::get('/destroy/{id}', 'destroy');
    });
    Route::resources([
        'polygon' =>PolygonController::class,
        'reports'=>ReportController::class,
        'trips'=>TripController::class,
        'shifts'=>ShiftController::class,
        'users' =>UserController::class,
    ]);
});
Route::get('/home', function (){
    return view('welcome');
});