@extends('auth.layouts.app')
@section('title')
    Login
@endsection
@section('content')
<div class="container col-md-4">
    <h1 class="name">Graduation Platform</h1>
    <div class="page">
        <form action="{{ route('login') }}" method="POST" class="my-form">
            @csrf
            <div class="circle">
                <img src="{{ asset('images/loo.png') }}" alt="grade">
            </div>
            <div class="form-group mb-5">
                <div class="form-outline">
                    <div class="input-group">
                        <span class="input-group-text" style="order: 1;">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input id="email" type="email" class="form-control shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus style="width: calc(100% - 50px); order: 2;">
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="form-outline">
                    <div class="input-group">
                        <span class="input-group-text" style="order: 1;">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input id="password" type="password" class="form-control shadow-none @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" style="width: calc(100% - 50px); order: 2;">
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-1">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" style="margin-top: 6px; margin-right : 2px;">
                    <label class="form-check-label" for="remember" style="margin-top: 3px; margin-right: 2px;">
                        Remember Me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="admin-link ms-3">Forgot Password?</a>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3 me-5 mb-3 fw-bold login-button">Login</button>
            <p class="dont-have-account me-2" style="margin-left: 20px;" >
                Don't have an account? <a href="{{ route('register') }}" class="ms-2">Register</a>
            </p>
        </form>
    </div>
</div>
@endsection
