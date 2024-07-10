<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\JurusanController;

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

Route::middleware('token')->group(function () {
    Route::get('/biodata', [BiodataController::class, 'get']);
    Route::post('/biodata', [BiodataController::class, 'create']);
    Route::patch('/biodata/{id}', [BiodataController::class, 'update']);
    Route::delete('/biodata/{id}', [BiodataController::class, 'delete']);

    Route::get('/jurusan', [JurusanController::class, 'get']);
    Route::post('/jurusan', [JurusanController::class, 'create']);
    Route::patch('/jurusan/{id}', [JurusanController::class, 'update']);
    Route::delete('/jurusan/{id}', [JurusanController::class, 'delete']);

});