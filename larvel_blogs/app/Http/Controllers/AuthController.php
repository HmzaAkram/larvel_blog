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
         $fieldType = filter_var($request->login_id,FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         if($fieldType == 'email'){
            $request->validate([
                'login_id' => 'required|email|exist:users,email',
                'password' => 'required|min:5'
            ],[
                'login_id.required' =>'Enter Your Email or Username',
                'login_id.email' =>'Invalid Email Address',
                'login_id.exists' =>'no account found in this email'
            ]);

         }else{
            $request->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5'
            ],[
                'login_id.required' =>'Enter Your Email or Username',
                'login_id.exists' =>'no account found in this username'
            ]);
         }
    }
}
