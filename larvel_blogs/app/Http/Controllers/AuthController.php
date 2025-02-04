<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UserStatus;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(Request $request){
        $data = [
            'pageTitle' => 'login'
        ];
        return view('back.pages.auth.login', $data);

    }
   
    public function forgotPassword(Request $request) {
        $data = [
            'pageTitle' => 'Forgot Password'
        ];
        return view('back.pages.auth.forgot', $data);
    }
    
    public function loginHandler(Request $request){
         $fieldType = ilter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         dd($fieldType);
    }
}
