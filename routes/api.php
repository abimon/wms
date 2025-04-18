<?php

use App\Http\Controllers\PolygonController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripReportController;
use App\Http\Controllers\UserController;
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
Route::controller(UserController::class)->prefix('/user/')->group(function(){
    Route::get('index','index');//show all users
    Route::post('register','register');//register user name, email, contact, password
    Route::post('login','login'); //login email, password
    Route::get('delete/{id}','destroy');//delete user
    Route::post('edit/{id}','edit'); //edit next of kin
    Route::post('update/{id}','update'); //update user details
    Route::get('show/{id}','show'); // show user account
});
Route::controller(PolygonController::class)->prefix('/polygons')->group(function(){
    Route::get('/','getPolygons'); 
});
Route::controller(TripController::class)->prefix('/trip')->group(function(){
    Route::get('/store','store');
});
Route::controller(TripReportController::class)->prefix('/tripreport')->group(function(){
    Route::get('/store','store');
});
Route::controller(ReportController::class)->prefix('/report')->group(function(){
    Route::get('/store','store');
});