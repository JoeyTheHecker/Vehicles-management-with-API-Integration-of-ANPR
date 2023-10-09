<?php

use App\Http\Controllers\API\ActivityController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\OwnerController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Brands
Route::get('brands', [BrandController::class, 'index']);
Route::post('brands', [BrandController::class, 'store']);
Route::post('brands/{id}/update', [BrandController::class, 'update']);
Route::post('brands/{id}/delete', [BrandController::class, 'destroy']);

// Owners
Route::get('owners', [OwnerController::class, 'index']);
Route::post('owners', [OwnerController::class, 'store']);
Route::post('owners/{id}/update', [OwnerController::class, 'update']);
Route::post('owners/{id}/delete', [OwnerController::class, 'destroy']);

// Vehicles
Route::get('vehicles', [VehicleController::class, 'index']);
Route::get('vehicles/owners/{id}', [VehicleController::class, 'getOwnerVehicles']);
Route::post('vehicles', [VehicleController::class, 'store']);
Route::post('vehicles/{id}/update', [VehicleController::class, 'update']);
Route::post('vehicles/{id}/delete', [VehicleController::class, 'destroy']);
Route::post('vehicles/upload', [VehicleController::class, 'upload']);

// Users
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::post('users/{id}/update', [UserController::class, 'update']);
Route::post('users/{id}/delete', [UserController::class, 'destroy']);


// Logs
Route::get('activities', [ActivityController::class, 'index']);
