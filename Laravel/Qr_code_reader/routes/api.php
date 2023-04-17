<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\csvDataController;
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
Route::post("/register" ,  [AuthController::class, 'Register']);
Route::post("/login" ,  [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::post("/logout" ,  [AuthController::class, 'Logout']);
    Route::post("/saveData/{id}" ,  [csvDataController::class, 'saveData']);
    Route::get("/retrieve/{id}" ,  [csvDataController::class, 'retrieveData']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
