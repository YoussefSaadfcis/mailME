<?php

use App\Http\Controllers\auth\emailverificationController;
use App\Http\Controllers\auth\ForgetPasswordController;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {

    Route::get('google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('google/callback', [GoogleController::class, 'callback'])->name('google.callback');
    
    Route::get("signup", [RegisterController::class, "create"])->name("signup.create");
    Route::post("signup", [RegisterController::class, "store"])->name("signup.store");
    Route::get('/verify-email/{id}', [emailverificationController::class, 'verifyForm'])->name('verify.email.form');
    Route::post('/verify-email/{id}', [emailverificationController::class, 'verifyOtp'])->name('verify.email.otp');

    Route::get("signin", [SignInController::class, "show_signin_page"])->name("signin.get");
    Route::post("signin", [SignInController::class, "signin"])->name("signin.post");

    Route::get('/forgot-password', [ForgetPasswordController::class, 'index'])->name('password.reset.request');
    Route::post('/forgot-password', [ForgetPasswordController::class, 'sendResetOTP'])->name('password.reset.otp');
    Route::get('/forgot-password/verifyOTP/{id}', [ForgetPasswordController::class, 'verifyOTP1'])->name('password.reset.verifyOTP');
    Route::post('/forgot-password/verifyOTP/{id}', [ForgetPasswordController::class, 'verifyOTP2'])->name('password.reset.verifyOTP');
    Route::get("changePassword/{id}", [ForgetPasswordController::class, "changePassword"])->name("changePassword.get");
    Route::post("changePassword/{id}", [ForgetPasswordController::class, "UpdatePassword"])->name("changePassword.post");
    Route::get("logout", [LogOutController::class, "logout"])->name("logout");
});

Route::get('/home', [HomeController::class, 'index'])->name('user.home');

Route::get('/user_character',[ProfileController::class,'index'])->name('user.character');
Route::post('/user_character', [ProfileController::class, 'setUserCharacter'])->name('user.character');
