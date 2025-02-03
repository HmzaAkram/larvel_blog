<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controller\AuthController;
use app\Http\Controller\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes

