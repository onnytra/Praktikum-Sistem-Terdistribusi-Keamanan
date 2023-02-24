<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MoviesController;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\LiveController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('movies', [MoviesController::class, 'index']);
// Route::post('movies', [MoviesController::class, 'create']);
// Route::put('movies/{id}', [MoviesController::class, 'update']);
// Route::delete('movies/{id}', [MoviesController::class, 'delete']);

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
// Route::middleware('auth:sanctum')->group(function () {
//     Route::resource('movies', MovieController::class);
    Route::controller(MovieController::class)->group(function () {
        Route::resource('movies', MovieController::class);
    // Route::get('movies', [MovieController::class, 'index']);
    // Route::get('movies/{movie}', [MovieController::class, 'show']);
    // Route::get('movies/create', [MovieController::class, 'create']);
    // Route::put('movies/{movie}', [MovieController::class, 'update']);
    // Route::delete('movies/{movie}', [MovieController::class, 'destroy']);
});
Route::controller(LiveController::class)->group(function () {
    Route::resource('lives', LiveController::class);
});
// Route::delete('movies/{movie}', [MovieController::class, 'delete']);