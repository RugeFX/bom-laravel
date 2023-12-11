<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColormasterController;
use App\Http\Controllers\SizemasterController;
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

Route::apiResource('category',CategoryController::class);
Route::apiResource('color',ColormasterController::class);
Route::apiResource('size',SizemasterController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
