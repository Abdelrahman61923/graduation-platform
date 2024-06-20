@extends('auth.layouts.app')
@section('title')
    {{ __('Reset Password') }}
@endsection
@section('styles')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center position-relative">
                    <h1 class="mt-0 text-light" style="margin-bottom: 90px">Graduation Platform</h1>
                    <form method="POST" action="{{ route('password.update') }}" class="circle bg-white"
                        style="border-radius: 20px;padding-bottom: 20px;">
                        @csrf
                        <img src="{{ asset('assets/images/logo/loo.png') }}" alt="grade" class="mb-4">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="container">
                            <div class="row px-md-40">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        <input id="email" type="email" placeholder="Email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                        <input id="password" type="password" placeholder="Password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        <span class="position-absolute end-0 top-50 translate-middle-y me-3"
                                            onclick="password_show_hide('password', 'show_eye_password', 'hide_eye_password');">
                                            <i class="fas fa-eye" id="show_eye_password"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye_password"></i>
                                        </span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                        <input id="password-confirm" type="password" placeholder="Password Confirmation"
                                            class="form-control" name="password_confirmation" required
                                            autocomplete="new-password">
                                        <span class="position-absolute end-0 top-50 translate-middle-y me-3"
                                            onclick="password_show_hide('password_confirmation', 'show_eye_confirmation', 'hide_eye_confirmation');">
                                            <i class="fas fa-eye" id="show_eye_confirmation"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye_confirmation"></i>
                                        </span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-75 fw-bold">Reset Password</button>
                        <div class="mt-3 d-flex justify-content-center">
                            <p class="me-2">Remember your account?</p>
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
