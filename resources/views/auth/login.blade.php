@extends('auth.layouts.app')
@section('title')
    Login
@endsection
@section('content')
<div class="page">
    <h1>graduation platform</h1>
    <form action="{{ route('login') }}" method="POST" style="height: auto;">
        @csrf
        <img src="{{ asset('images/loo.png') }}" alt="grade">
        <div>
            <i class="fa-solid fa-user icon"></i>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div>
            <i class="fa-solid fa-lock icon"></i>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row mb-3">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="admin">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"> Forgot Password?</a>
            @endif
        </div>
        <button type="submit" name="submit">Login</button>
        <div class="link" style="margin-top: 10px;">
            <p>Don't have an account?</p>
            <a style="margin-top: -15px;font-size: 14px;" href="{{ route('register') }}">Register</a>
        </div>
    </form>
</div>
@endsection
