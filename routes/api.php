<?php

use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\ContributionsController;
use App\Http\Controllers\UserController;
use App\Models\Beneficiary;
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
Route::controller(ContributionsController::class)->prefix('/account/')->group(function(){
    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::get('destroy/{id}','destroy');
    Route::post('update/{id}','update');
    Route::post('create','create');
});
Route::controller(BeneficiaryController::class)->prefix('/beneficiary/')->group(function(){
    Route::get('index/{id}','index');
    Route::get('destroy/{id}','destroy');
    Route::get('show/{id}','show');
    Route::post('create','create');
    Route::post('update/{id}','update');

});