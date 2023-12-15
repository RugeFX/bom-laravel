<?php

use App\Http\Controllers\BomController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColormasterController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HardcaseController;
use App\Http\Controllers\HelmetController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SizemasterController;
use App\Models\Material;
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

Route::apiResource('categories', CategoryController::class);
Route::apiResource('colors', ColormasterController::class);
Route::apiResource('sizes', SizemasterController::class);
Route::apiResource("masters", MasterController::class);
Route::apiResource("generals", GeneralController::class);
Route::apiResource("hardcases", HardcaseController::class);
Route::apiResource("helmets", HelmetController::class);
Route::apiResource("medicines", MedicineController::class);
Route::apiResource('boms', BomController::class);

Route::get("materials", fn () =>  Material::all());
Route::delete("materials/{id}", fn (string $id) =>  Material::query()->find($id)->delete());

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
