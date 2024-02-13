<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\Api\MovieAPIController;

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

Route::group(array('middleware' => ['custom_auth']), function ()
{
    Route::apiResource('token', TokenController::class);
    Route::post('/token/topup', [TokenController::class, 'store']);
});

Route::get('/genre', [MovieAPIController::class, 'genre']);
Route::get('/timeslot', [MovieAPIController::class, 'timeslot']);
Route::get('/specific_movie_theater', [MovieAPIController::class, 'specific_movie_theater']);
Route::get('/search_performer', [MovieAPIController::class, 'search_performer']);
Route::get('/new_movies', [MovieAPIController::class, 'new_movies']);
Route::get('/movies', [MovieAPIController::class, 'movies']);
Route::post('/add_movie', [MovieAPIController::class, 'add_movie']);
Route::post('/give_rating', [MovieAPIController::class, 'give_rating']);




