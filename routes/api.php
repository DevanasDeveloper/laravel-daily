<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Auth Controller
Route::controller(AuthController::class)->group(function () {
    Route::post("/login", "login")->name('login');
    Route::post("/register", "register")->name('register');
});

// Auth Controller
Route::group(["middleware" => "auth:sanctum"], function () {
    // Auth Controller
    Route::controller(AuthController::class)->group(function () {
        Route::get("/logout", "logout")->name('logout');
        Route::get("/profile", "profile")->name('profile');
    });
    // Admin Authorization
    Route::group(["middleware" => "is.role:admin,user"], function () {
        //  Customer Controller
        Route::group(["prefix" => "customers", "as" => "customers."],function () {
            Route::get("/", [CustomerController::class,"index"])->name('index');
            Route::post("/", [CustomerController::class,"store"])->name('store');
            Route::get("/{id}", [CustomerController::class,"show"])->name('show');
            Route::post("/{id}", [CustomerController::class,"update"])->name('update');
            Route::delete("/{id}", [CustomerController::class,"destroy"])->name('destroy');
            Route::get("/{id}/change/status", [CustomerController::class,"changeStatus"])->name('change.status');
        });
        // Category Controller
        Route::group(["prefix" => "categories", "as" => "categories."],function () {
            Route::get("/", [CategoryController::class,"index"])->name('index');
            Route::post("/", [CategoryController::class,"store"])->name('store');
            Route::get("/{id}", [CategoryController::class,"show"])->name('show');
            Route::post("/{id}", [CategoryController::class,"update"])->name('update');
            Route::delete("/{id}", [CategoryController::class,"destroy"])->name('destroy');
            Route::get("/{id}/change/status", [CategoryController::class,"changeStatus"])->name('change.status');
        });
        // Product Controller
        Route::group(["prefix" => "products", "as" => "products."],function () {
            Route::get("/", [ProductController::class,"index"])->name('index');
            Route::post("/", [ProductController::class,"store"])->name('store');
            Route::get("/{id}", [ProductController::class,"show"])->name('show');
            Route::post("/{id}", [ProductController::class,"update"])->name('update');
            Route::delete("/{id}", [ProductController::class,"destroy"])->name('destroy');
            Route::get("/{id}/change/status", [ProductController::class,"changeStatus"])->name('change.status');
        });
        Route::group(["middleware" => "is.role:admin"], function () {
            //  User Controller
            Route::group(["prefix" => "users", "as" => "users."],function () {
                Route::get("/", [UserController::class,"index"])->name('index');
                Route::post("/", [UserController::class,"store"])->name('store');
                Route::get("/{id}", [UserController::class,"show"])->name('show');
                Route::post("/{id}", [UserController::class,"update"])->name('update');
                Route::delete("/{id}", [UserController::class,"destroy"])->name('destroy');
                Route::get("/{id}/change/status", [UserController::class,"changeStatus"])->name('change.status');
            });
        });

        // Customer Authorization
        Route::group(["middleware" => "is.role:customer"], function () {
            
        });

    });
});
