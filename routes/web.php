<?php

use App\Http\Controllers\auth\emailverificationController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\SignInController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::get("signup", [RegisterController::class, "create"])->name("signup.create");
    Route::post("signup", [RegisterController::class, "store"])->name("signup.store");
    Route::get('/verify-email/{id}', [emailverificationController::class, 'verifyForm'])->name('verify.email.form');
    Route::post('/verify-email/{id}', [emailverificationController::class, 'verifyOtp'])->name('verify.email.otp');

    Route::get("signin", [SignInController::class, "show_signin_page"])->name("auth.signin.get");
    Route::post("signin", [SignInController::class, "signin"])->name("auth.signin.post");

    Route::post("logout", [LogOutController::class, "logout"])->name("auth.logout.post");
});
