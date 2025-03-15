<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

//user routes
Route::get('/', function () {
    return view('front.pages.index');
});

Route::get('/about', function () {
    return view('front.pages.about');
});

Route::get('/contact', function () {
    return view('front.pages.contact');
});

Route::get('/features', function () {
    return view('front.pages.features');
});

Route::get('/blog', function () {
    return view('front.pages.blog');
});

Route::get('/login', function () {
    return view('front.pages.auth.login');
});

// Teating routes
Route::view('example-page','example-page');
Route::view('example-auth','example-auth');





// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
            Route::get('/forgotPassword', 'forgotPassword')->name('forgot');
            Route::post('/send_password_reset_link', 'sendPasswordResetLink')->name('send_password_reset_link');
            Route::get('/Password/reset/{token}', 'resetForm')->name('reset_password_form');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::get('/logout', 'logoutHandler')->name('logout');
        });
    });
});
