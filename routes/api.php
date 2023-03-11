<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PreferencesController;
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

// Route::group(['middleware' => 'auth.if.has.token'], function () {

    // Route::get('/getArticles', [ArticleController::class, 'getArticles']);
    // Route::get('/getAuthors', [ArticleController::class, 'getAuthors']);
    // Route::get('/getSources', [ArticleController::class, 'getSources']);

// });

Route::middleware("auth.if.has.token")->group(function() {
    Route::get('/getArticles', [ArticleController::class, 'getArticles']);
    Route::get('/getAuthors', [ArticleController::class, 'getAuthors']);
    Route::get('/getSources', [ArticleController::class, 'getSources']);
});


Route::middleware("auth:sanctum")->group(function() {
    Route::get("/user", function (Request $request) {
        return $request->user();
    });

    Route::post("/logout", [AuthController::class, "logout"]);

    Route::get('/preferences', [PreferencesController::class, 'getPreferencesPageResources']);
    Route::post('/preferences', [PreferencesController::class, 'savePreferences']);
});

Route::post("/signup", [AuthController::class, "signup"]);
Route::post("/login", [AuthController::class, "login"]);
