<?php

use App\Http\Controllers\CategoriesControll;
use App\Http\Controllers\ProductControll;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuthController;

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

Route::group(['middleware' => ['web']], function () {
    Route::get('/oauth/register', [OAuthController::class, 'redirect']);
    Route::get('/auth/google/callback', [OAuthController::class, 'callback']);
});

//Route Product
Route::middleware(['jwt-auth'])->group(function () {
    Route::post("/product", [ProductControll::class, "store"]);
    Route::get("/product", [ProductControll::class, "ShowAll"]);
    Route::put("/product/{id}", [ProductControll::class, "update"]);
    Route::delete("/product/{id}", [ProductControll::class, "delete"]);
});

//Route Categories
Route::middleware(['jwt-auth'])->group(function () {
    Route::post("/categories", [CategoriesControll::class, "store"]);
    Route::get("/categories", [CategoriesControll::class, "ShowAll"]);
    Route::put("/categories/{id}", [CategoriesControll::class, "update"]);
    Route::delete("/categories/{id}", [CategoriesControll::class, "delete"]);
});

//Route Register
Route::post("/register", [RegisterController::class, "store"]);

//Route Login
Route::post('/login', [UserController::class, 'login']);