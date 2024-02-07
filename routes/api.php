<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\FirestoreService;

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


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('logout', [AuthController::class, 'logout']);
});

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});
// Auth::routes(['verify' => true]);

Route::get('/test/{product}', [ProductController::class, 'show']);


Route::get('/images', [ImageController::class, 'test']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::middleware('throttle:1500,1')->group(function () {
    Route::get('/dummy-products', [ProductController::class, 'dummyProducts']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});