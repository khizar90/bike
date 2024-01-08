<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


Route::post('add/bike', [BikeController::class, 'add']);
Route::get('delete/bike/{id}', [BikeController::class, 'delete']);
Route::get('home', [BikeController::class, 'home']);
Route::post('list/bike', [BikeController::class, 'list']);
Route::post('edit/bike', [BikeController::class, 'edit']);
Route::post('search/bike', [BikeController::class, 'search']);




