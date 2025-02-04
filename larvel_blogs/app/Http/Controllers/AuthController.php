<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserStatus;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        return view('back.pages.auth.login', ['pageTitle' => 'Login']);
    }

    public function forgotPassword(Request $request)
    {
        return view('back.pages.auth.forgot', ['pageTitle' => 'Forgot Password']);
    }

    public function loginHandler(Request $request)
    {
        // Determine if input is email or username
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Validate login credentials
        $request->validate([
            'login_id' => ['required', $fieldType === 'email' ? 'email' : '', "exists:users,$fieldType"],
            'password' => ['required', 'min:5'],
        ], [
            'login_id.required' => 'Enter your email or username',
            'login_id.email' => 'Invalid email address',
            'login_id.exists' => "No account found with this $fieldType",
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 5 characters',
        ]);

        // Attempt login
        if (Auth::attempt([$fieldType => $request->login_id, 'password' => $request->password])) {
            $user = auth()->user();

            if ($user->status == UserStatus::Inactive) {
                Auth::logout();
                return $this->logoutWithMessage($request, 'Your account is currently inactive. Please contact Support at support@127.0.0.1:8000 for assistance.');
            }

            if ($user->status == UserStatus::Pending) {
                Auth::logout();
                return $this->logoutWithMessage($request, 'Your account is pending approval. Please check your email for instructions or contact Support at support@127.0.0.1:8000.');
            }

            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->withInput()->with('fail', 'Incorrect password');
    }

    private function logoutWithMessage(Request $request, $message)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('fail', $message);
    }
}
