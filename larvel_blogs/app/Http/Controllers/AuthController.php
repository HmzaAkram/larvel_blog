<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(Request $request){
        $data = [
            'pageTitle' => 'Login'
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
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType === 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5'
            ], [
                'login_id.required' => 'Enter your email or username',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'No account found with this email',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 5 characters'
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5'
            ], [
                'login_id.required' => 'Enter your email or username',
                'login_id.exists' => 'No account found with this username',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 5 characters'
            ]);
        }
        
        // Assuming you want to handle login logic here
        if (Auth::attempt([$fieldType => $request->login_id, 'password' => $request->password])) {
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors(['loginError' => 'Invalid credentials. Please try again.']);
        }

        $creds=array(
            $fieldType=>$request->login_id,
            'password'=>$request->password,
        );
        if (Auth::attempt($creds)) {
            //return redirect()->intended('dashboard');
            if(auth()->user())
        } else {
            // return back()->withErrors(['loginError' => 'Invalid credentials. Please try again.']);
            return redirect()->route('admin.login')->withInput()->with('fail','Incorrect password');
        }
    }
}
