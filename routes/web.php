<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

// Backend Route API

Route::post("/registration1", [UserController::class, "registration1"]);

Route::post("/login1", [UserController::class, "login1"]);

Route::post("/send_otp1", [UserController::class, "send_otp1"]);

Route::post("/verify_otp1", [UserController::class, "verify_otp1"]);

Route::post("/reset_pass1", [UserController::class, "reset_pass1"])
    ->middleware([UserMiddleware::class]);

Route::get("/user_profile", [UserController::class, "user_profile"])
    ->middleware([UserMiddleware::class]);

Route::post("/update_profile", [UserController::class, "update_profile"])
    ->middleware([UserMiddleware::class]);



// User Pages Route

Route::get("/registration2", [UserController::class, "registration2"]);

Route::get("/login2", [UserController::class, "login2"]);

Route::get("/send_otp2", [UserController::class, "send_otp2"]);

Route::get("/verify_otp2", [UserController::class, "verify_otp2"]);

Route::get("/reset_pass2", [UserController::class, "reset_pass2"])->middleware([UserMiddleware::class]);

Route::get("/dashboard", [UserController::class, "dashboard"])->middleware([UserMiddleware::class]);

Route::get("/profile", [UserController::class, "profilePage"])->middleware([UserMiddleware::class]);

Route::get("/logout", [UserController::class, "logout"]);

