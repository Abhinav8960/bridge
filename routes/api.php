<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\FeaturedStateCityController;
use App\Http\Controllers\Api\SpotliteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/exams', [ExamController::class, 'showCategoryStats']);
// routes/api.php

Route::get('/spotlites', [SpotliteController::class, 'showSpotlite']);
Route::get('/featured-state-city-name', [FeaturedStateCityController::class, 'stateCityGet']);
// Route::get('/featured-cities-institute', [FeaturedStateCityController::class, 'getInstituteFeaturedCitiesWise']);
Route::get('/featured-state-city-name/{cityId}', [FeaturedStateCityController::class, 'getInstituteFeaturedCitiesWise']);
