<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');


Route::resource('order',OrderController::class);
Route::get('order/{id}/payment',[OrderController::class, 'paymentResult'])->name('order.payment');

// Route::get('order/create', [OrderController::class, 'create'])->name('create-order');
// Route::post('order/create', [OrderController::class, 'create'])->name('create-order');

