@extends('auth.layouts.app')
@section('title')
    Forget Password
@endsection
@section('content')
<div class="page">
    <h1>graduation platform</h1>
    <form method="POST" action="{{ route('password.email') }}" style="height: auto;">
        @csrf
        <img src="{{ asset('images/loo.png') }}" alt="grade">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <i class="fa-solid fa-user icon"></i>
            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" name="submit" style="width: auto;font-size: 12px;">Send Password Reset Link</button>
        <div class="link">
            <p>Remember your account?</p>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </form>
</div>
@endsection
