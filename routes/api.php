<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColormasterController;
use App\Http\Controllers\fakItemController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\generalItemController;
use App\Http\Controllers\HardcaseController;
use App\Http\Controllers\hardcaseItemController;
use App\Http\Controllers\HelmetController;
use App\Http\Controllers\helmetItemController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MenuitemController;
use App\Http\Controllers\motorItemController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizemasterController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Models\GeneralItem;
use App\Models\Material;
use App\Models\Reservation;
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
Route::middleware("auth:sanctum")->group(function () {
    Route::post("logout", [AuthController::class, "logout"]);
    Route::get("profile", [AuthController::class, "profile"]);
    // Route::post("/dashboard", DashboardController::class);

        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('colors', ColormasterController::class);
        Route::apiResource('sizes', SizemasterController::class);
        Route::apiResource("masters", MasterController::class);
        Route::apiResource("materials", MaterialController::class);
        Route::apiResource("generals", GeneralController::class);
        Route::apiResource("hardcases", HardcaseController::class);
        Route::apiResource("helmets", HelmetController::class);
        Route::apiResource("medicines", MedicineController::class);
        Route::apiResource('boms', BomController::class);
        Route::apiResource('helmetItems', helmetItemController::class);
        Route::apiResource('fakItems', fakItemController::class);
        Route::apiResource('plans', PlanController::class);
        Route::apiResource('motorItems', motorItemController::class);
        Route::apiResource('hardcaseItems', hardcaseItemController::class);
        Route::apiResource('generalItems', generalItemController::class);
        Route::apiResource('reservations', ReservationController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('staffs', StaffController::class);
        Route::apiResource('roles', RoleController::class);
});

Route::post("auth", [AuthController::class, "auth"]);
