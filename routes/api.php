<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageSearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Test;
use App\Http\Controllers\TextSearchController;
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

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('logout', [AuthController::class, 'logout']);
});
// Auth::routes(['verify' => true]);

Route::post('/validate-token', [AuthController::class, 'validateToken']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/image-search', [ImageSearchController::class, 'requestSimilarProducts']);
Route::post('/text-search', [TextSearchController::class, 'requestSimilarImages']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/products/store', [ProductController::class, 'store']);
Route::middleware('throttle:1500,1')->group(function () {
    Route::get('/dummy-products', [ProductController::class, 'dummyProducts']);
});


Route::get('/meta-data-test', [Test::class, 'testStorage']);
