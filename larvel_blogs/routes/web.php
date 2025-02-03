<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controller\AuthController;
use app\Http\Controller\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes

Route::prefix('admin')->name('admin')->group(function (Request $request){
    Route::middleware([])->group(function(){
           Route::controller(AuthController::class)->group(function(){
            Route::get('/login','loginForm')->name(login);
            Route::get('/forgot-Password')->name(forgot);
           }
    );
    });
    Route::middleware([])->group(function(){
        Route::controller(AdminController::class)->group(function(){
            Route::get('/dashboard','adminDashboard')->name(dashboard);
        }); 
    });
});