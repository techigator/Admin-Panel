<?php

use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use MongoDB\Client as MongoClient;

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

Route::get('/test-mongodb', function () {
    try {
        // Create a new MongoDB client using the connection string from .env
        $mongo = new MongoClient(
            env('MONGODB_CONNECTION_STRING'),
            [
                'username' => env('MONGODB_USERNAME'),
                'password' => env('MONGODB_PASSWORD'),
                'authSource' => env('MONGODB_AUTH_DATABASE', 'admin')
            ]
        );

        // Fetch list of databases to verify the connection
        $databases = $mongo->listDatabases();

        return response()->json(['status' => 'connected', 'databases' => $databases]);
    } catch (Exception $e) {
        return response()->json(['status' => 'failed', 'error' => $e->getMessage()]);
    }
});

Route::get('firebase-phone-authentication', [FirebaseController::class, 'index']);
