<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Corrected User model import
use App\UserStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Helpers\CMail; // Corrected Mail facade import

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
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

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

     public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required','email','exists:users,email'],
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email address',
            'email.exists' => "No account found with this email",
        ]);

        $user = User::where('email', $request->email)->first();

        $token = Hash::make(Str::random(64));


    //     // Corrected table name to 'password_reset_tokens'
        $oldToken = DB::table('password_reset_tokens')->where('email', $user->email)->first();
        
        if ($oldToken) {
            DB::table('password_reset_tokens')
                ->where('email', $user->email)->update([
                'token' => $token,
                'created_at' => Carbon::now() 
            ]);
        }
     else {
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
        }

       $actionLink = route('admin.reset_password_from', ['token' => $token]);

     $data = array(
            'actionLink' => $actionLink,
            'user' => $user
        );

        $mail_body = view('email-templates.forgot-template', $data)->render();
        $mailConfig = array(
            'recipient_address' => $user->email,
           'recipient_name' => $user->name,
           'subject' => 'Reset Password',
            'body' => $mail_body
        );
        if( CMail::send($mailConfig)){
            return redirect()->route('admin.forgot')->with('success','Password reset link has been sent to your email address.');
        }
        else{
            return redirect()->route('admin.forgot')->with('fail','Failed to send password reset link. Please try again.');
        }
    }

}