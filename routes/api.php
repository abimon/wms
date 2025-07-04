<?php

use App\Http\Controllers\PolygonController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftReportController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(UserController::class)->prefix('/user')->group(function(){
    Route::get('/index','index');//show all users
    Route::post('/register','register');//register user name, email, contact, password
    Route::post('/login','login'); //login email, password
    Route::get('/delete/{id}','destroy');//delete user
    Route::post('/edit/{id}','edit'); //edit next of kin
    Route::post('/update/{id}','update'); //update user details
    Route::get('/show/{id}','show'); // show user account
});
Route::controller(PolygonController::class)->prefix('/polygons')->group(function(){
    Route::get('/','getPolygons'); 
});
Route::controller(TripController::class)->prefix('/trip')->group(function(){
    Route::post('/store','store');
    Route::get('/show/{plate}', 'showTrip');
});
Route::controller(TripReportController::class)->prefix('/tripreport')->group(function(){
    Route::post('/store','store');
    Route::put('/update/{id}','update');
    Route::get('/show/{id}', 'show');
});
Route::controller(ReportController::class)->prefix('/report')->group(function(){
    Route::post('/store','store');
    Route::get('/show/{plate}','show');
});
Route::controller(ShiftController::class)->prefix('/shift')->group(function(){
    Route::get('/','index');
    Route::post('/store','store');
    Route::post('/callback/{id}', 'callback');
    Route::put('/update/{id}', 'update');
    Route::get('/pay/{amount}/{contact}/{id}','pay');
    Route::get('/ispaid/{id}', 'ispaid');
    Route::get('/getshift/{plate}', 'getShift');
});
Route::controller(ShiftReportController::class)->prefix('shiftreport')->group(function(){
    Route::get('/','index');
    Route::post('/store','store');
    Route::put('/update/{id}','update');
    Route::get('/show/{id}', 'show');
});
Route::controller(VehicleController::class)->prefix('/vehicle')->group(function(){
    Route::get('/','index');
    Route::post('/store','store');
    Route::put('/update/{id}','update');
    Route::get('/show/{id}', 'show');
    Route::get('/delete/{id}', 'destroy');
});
