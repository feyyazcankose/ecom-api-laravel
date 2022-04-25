<?php

use App\Http\Controllers\AdressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryFieldController;
use App\Http\Controllers\CategoryFieldValueController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
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

Route::get('/category/{id}',[CategoryController::class,"show"]);
Route::get('/categories',[CategoryController::class,"index"]);


Route::get('/products',[ProductController::class,"index"]);
Route::get('/product/{id}',[ProductController::class,"show"]);





Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [AuthController::class,"logout"]);

    Route::prefix('admin')->middleware(["is.admin"])->group(function () {
        
        //Admin Check
        Route::get('/check',function () {
            return response()->json([
                'message' => 'Welcome',
                'status'=>200
            ],200);
        });

        //Category
        Route::resource('category', CategoryController::class);
       
        //Product
        Route::resource('product', ProductController::class);
       
        //Category Field
        Route::resource('category-field', CategoryFieldController::class);
       
        //Category Field Value
        Route::resource('category-field-value', CategoryFieldValueController::class);
        
        //Coupon
        Route::resource('coupon', CouponController::class);

        //Users
        Route::resource('user', UserController::class);

        Route::get('/table/categories',[TableController::class,"categories"]);
        Route::get('/table/users',[TableController::class,"users"]);
        Route::get('/table/products',[TableController::class,"products"]);

    });

    
    //Like
    Route::get('/likes',[LikeController::class,"index"]);
    Route::post('/like',[LikeController::class,"store"]);
    Route::delete('/like/{id}',[LikeController::class,"destroy"]);
    

    //Basket
    Route::resource('basket', BasketController::class);
    //Order
    Route::resource('order', OrderController::class);
    //card
    Route::resource('card', CardController::class);
    //card
    Route::resource('adres', AdressController::class);
    //Profile
    Route::get('profile',[ProfileController::class,"index"]);
    Route::post('profile',[ProfileController::class,"update"]);


});
