<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryFieldController;
use App\Http\Controllers\CategoryFieldValueController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


Route::post("/register", [AuthController::class,"register"]);

Route::post("/login", [AuthController::class,"login"]);

Route::get('/categories',[CategoryController::class,"index"]);
Route::get('/category/{id}',[CategoryController::class,"show"]);


Route::get('/products',[ProductController::class,"index"]);
Route::get('/product/{id}',[ProductController::class,"show"]);





Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [AuthController::class,"logout"]);

    Route::prefix('admin')->middleware(["is.admin"])->group(function () {
        Route::get('/check',function () {
            return response()->json([
                'message' => 'Welcome',
                'status'=>200
            ],200);
        });

        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);
        Route::resource('category-field', CategoryFieldController::class);
        Route::resource('category-field-value', CategoryFieldValueController::class);
        Route::resource('coupon', CouponController::class);

    });

    Route::get('/likes',[LikeController::class,"index"]);
    Route::post('/like',[LikeController::class,"store"]);
    Route::delete('/like/{id}',[LikeController::class,"destroy"]);

});
