<?php

use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\SignInController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::get("signup", [RegisterController::class, "show_signup_page"])->name("auth.signup.get");
    Route::post("signup", [RegisterController::class, "login"])->name("auth.signup.post");

    Route::get("signin", [SignInController::class, "show_signin_page"])->name("auth.signin.get");
    Route::post("signin", [SignInController::class, "signin"])->name("auth.signin.post");

    Route::post("logout", [LogOutController::class, "logout"])->name("auth.logout.post");
});
