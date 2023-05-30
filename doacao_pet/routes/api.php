<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ConsultZipCodeController;

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

Route::group(['prefix' => 'user'], function() {

    Route::get('index', [UserController::class, 'index']);

    Route::post('store', [UserController::class, 'store']);

    Route::get('show/{id}', [UserController::class, 'show']);

    Route::put('update/{id}', [UserController::class, 'update']);

    Route::delete('destroy/{id}', [UserController::class, 'destroy']);
});

Route::group(['prefix' => 'institution'], function() {

    Route::get('index', [InstitutionController::class, 'index']);

    Route::post('store', [InstitutionController::class, 'store']);

    Route::get('show/{id}', [InstitutionController::class, 'show']);

    Route::put('update/{id}', [InstitutionController::class, 'update']);

    Route::delete('destroy/{id}', [InstitutionController::class, 'destroy']);
});

Route::group(['prefix' => 'animal'], function() {

    Route::get('index', [AnimalController::class, 'index']);

    Route::post('store', [AnimalController::class, 'store']);

    Route::get('show/{id}', [AnimalController::class, 'show']);

    Route::put('update/{id}', [AnimalController::class, 'update']);

    Route::delete('destroy/{id}', [AnimalController::class, 'destroy']);
});

Route::post('/consult-zip-code/{location}', [ConsultZipCodeController::class, 'consultZipCode']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
