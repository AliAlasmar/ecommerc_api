<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
$user = Session::get('user');

if ($user) {
    Auth::login($user);
    // استعادة جلسة المستخدم
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/session', function () {
    return \auth()->user();
});

Route::post('login', [AuthController::class, 'login']);


