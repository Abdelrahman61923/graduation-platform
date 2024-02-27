@extends('auth.layouts.app')
@section('title')
    Reset Password
@endsection
@section('content')
<div class="page">
    <h1>graduation platform</h1>
    <form method="POST" action="{{ route('password.update') }}" style="height: auto;">
        @csrf
        <img src="{{ asset('images/loo.png') }}" alt="grade">
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <i class="fa-solid fa-user icon"></i>
            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div>
            <i class="fa-solid fa-lock icon"></i>
            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div>
            <i class="fa-solid fa-lock icon"></i>
            <input placeholder="Password Confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" name="submit" style="width: auto;font-size: 15px;">Reset Password</button>
        <div class="link">
            <p>Remember your account?</p>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </form>
</div>

@endsection
