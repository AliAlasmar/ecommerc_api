<?php
// routes/api.php
/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0.0"
 * )
 */


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;



Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:api')->group(function () {
    Route::get('is_login', [AuthController::class, 'is_login']);

    Route::resource('products', ProductController::class);
    Route::post('orders', [OrderController::class, 'store']);
});
