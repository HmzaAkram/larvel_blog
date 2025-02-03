<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm(Request $request){
        $data = [
            'pageTitle' => 'login'
        ];
        return view('back.pages.auth.login', $data);

    }
    public function forgotPassword(Request $request){
        $data = [
            'pageTitle' => 'forgotPassword'
        ];
        return view('back.pages.auth.forgot', $data);
    }
}
