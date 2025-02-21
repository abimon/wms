<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolygonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    ROute::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });
    Route::controller(PolygonController::class)->prefix('/polygons')->group(function () {
        Route::get('/destroy/{id}', 'destroy');
    });
    Route::resources([
        'polygon' =>PolygonController::class,
    ]);
});
Route::get('/home', function (){
    return view('welcome');
});