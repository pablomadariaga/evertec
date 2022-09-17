<?php

use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
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

$basePathOrders = 'order';
Route::get($basePathOrders, [OrderApiController::class, 'index']);
Route::get("$basePathOrders/{id}", [OrderApiController::class, 'show']);
Route::post($basePathOrders, [OrderApiController::class, 'getCheckout']);
Route::put("$basePathOrders/{id}", [OrderApiController::class, 'update']);

Route::get("products", [ProductApiController::class, 'index']);
Route::get("products/{id}", [ProductApiController::class, 'show']);
