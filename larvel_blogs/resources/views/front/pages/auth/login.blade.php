@extends('front.layout.app')

@section('title', 'Login')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa;">
    <div style="width: 350px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <div style="text-align: center; margin-bottom: 20px;">
            <h2 style="color: #007bff; margin: 0;">Login</h2>
        </div>
        <form action="{{ route('admin.login_handler') }}" method="POST">
            <x-form-alerts></x-form-alerts>
            @csrf
            
            <div style="margin-bottom: 15px;">
                <input type="text" name="login_id" value="{{ old('login_id') }}" 
                    placeholder="Username / Email" 
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
                @error('login_id')
                    <span style="color: red; font-size: 14px;">{{$message}}</span>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <input type="password" name="password" 
                    placeholder="**********" 
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
                @error('password')
                    <span style="color: red; font-size: 14px;">{{$message}}</span>
                @enderror
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <label style="display: flex; align-items: center;">
                    <input type="checkbox" id="customCheck1" style="margin-right: 5px;"> Remember
                </label>
                <a href="{{ route('admin.forgot') }}" style="color: #007bff; text-decoration: none;">Forgot Password?</a>
            </div>

            <button type="submit" 
                style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                Sign In
            </button>
        </form>
    </div>
</div>
@endsection
