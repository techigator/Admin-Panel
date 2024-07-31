<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [FrontController::class, 'frontIndex'])->name('front.index');
Route::get('/front-login', [FrontController::class, 'frontLogin'])->name('front.login');
Route::get('/front-register', [FrontController::class, 'frontRegister'])->name('front.register');
