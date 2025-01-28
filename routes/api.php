<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    Route::group(["middleware" => "is.admin"], function () {
    //     // User Controller
        Route::controller(UserController::class)->group(function () {
            Route::get("/users", "index")->name('users.index');
            Route::post("/users", "store")->name('users.store');
            Route::get("/users/{id}", "show")->name('users.show');
            Route::post("/users/{id}", "update")->name('users.update');
            Route::delete("/users/{id}", "destroy")->name('users.destroy');
            Route::get("/users/{id}/change/status", "changeStatus")->name('users.change.status');
        });
    });
});
