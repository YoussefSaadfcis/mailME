<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\auth\emailverificationController;
use App\Http\Controllers\auth\ForgetPasswordController;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\mail\MailController;
use App\Http\Controllers\user\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")
    ->middleware(['guest'])
    ->group(function () {

        // --- Social Login ---
        Route::get('google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
        Route::get('google/callback', [GoogleController::class, 'callback'])->name('google.callback');

        // --- Registration ---
        Route::get("signup", [RegisterController::class, "create"])->name("signup.create");
        Route::post("signup", [RegisterController::class, "store"])->name("signup.store")->middleware('throttle:10,1');

        // --- Sign In ---
        Route::get("signin", [SignInController::class, "show_signin_page"])->name("signin.get");
        Route::post("signin", [SignInController::class, "signin"])->name("signin.post")->middleware('throttle:10,1');

        // --- Email Verification ---
        Route::get('/verify-email/{id}', [emailverificationController::class, 'verifyForm'])->name('verify.email.form');
        Route::post('/verify-email/{id}', [emailverificationController::class, 'verifyOtp'])->name('verify.email.otp')->middleware('throttle:10,1');

        // --- Password Reset ---
        Route::get('/forgot-password', [ForgetPasswordController::class, 'index'])->name('password.reset.request');
        // Stricter limit for sending OTP
        Route::post('/forgot-password', [ForgetPasswordController::class, 'sendResetOTP'])->name('password.reset.otp')->middleware('throttle:10,1');

        // --- OTP Verification & Change Password ---
        Route::get('/forgot-password/verifyOTP/{id}', [ForgetPasswordController::class, 'verifyOTP1'])->name('password.reset.verifyOTP');
        Route::post('/forgot-password/verifyOTP/{id}', [ForgetPasswordController::class, 'verifyOTP2'])->name('password.reset.verifyOTP')->middleware('throttle:10,1');

        Route::get("changePassword/{id}", [ForgetPasswordController::class, "changePassword"])->name("changePassword.get");
        Route::post("changePassword/{id}", [ForgetPasswordController::class, "UpdatePassword"])->name("changePassword.post");
    });


// ----------------------------------------------------------------------
// 2. AUTHENTICATED USER ROUTES
// ----------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get("logout", [LogOutController::class, "logout"])->name("logout");
    Route::post('/user_character', [ProfileController::class, 'setUserCharacter'])->name('user.character.store'); // Suggested name change for POST
    Route::get('/user_character', [ProfileController::class, 'index'])->name('user.character');
});

// ----------------------------------------------------------------------
// 3. HOME ROUTE
// ----------------------------------------------------------------------

Route::get('/', [HomeController::class, 'index'])->name('user.home');
Route::get('/about', [AboutController::class, 'index'])->name('user.about');
