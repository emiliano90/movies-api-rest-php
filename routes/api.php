<?php

use App\Http\Controllers\ActorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TvShowActorController;
use App\Http\Controllers\TvShowController;
use App\Models\TvShow;

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

Route::group([
	'middleware' => 'api',
	'prefix' => 'auth'
], function ($router) {
	Route::post('/login', [AuthController::class, 'login'])->name('login');
	Route::post('/register', [AuthController::class, 'register']);
	Route::post('/logout', [AuthController::class, 'logout']);
	Route::post('/refresh', [AuthController::class, 'refresh']);
	Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
	'middleware' => 'api',
	'prefix' => 'v1'
], function ($router) {
	Route::apiResource('movies', MovieController::class);
	Route::apiResource('tvshows', TvShowController::class);
	Route::apiResource('actors', ActorController::class);
	Route::apiResource('directors', DirectorController::class);
	Route::apiResource('seasons', SeasonController::class);
	Route::apiResource('episodes', EpisodeController::class);
	Route::apiResource('genres', GenreController::class);
	Route::apiResource('movies/{movie}/actors', MovieActorController::class);
	Route::apiResource('tvshows/{tvshow}/actors', TvShowActorController::class);
});
