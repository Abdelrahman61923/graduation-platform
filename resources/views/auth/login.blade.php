@extends('auth.layouts.app')
@section('title')
    {{ __('Login') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center position-relative">
                    <h1 class="mt-0 text-light" style="margin-bottom: 90px">Graduation Platform</h1>
                    <form action="{{ route('login') }}" method="POST" class="circle bg-white mb-5"
                        style="border-radius: 20px;padding-bottom: 20px;">
                        @csrf
                        <img src="{{ asset('images/loo.png') }}" alt="grade" class="mb-4">
                        <div class="container">
                            <div class="row  px-md-40">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" autocomplete="email" placeholder="Email" autofocus>
                                        @error('email')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="remember">{{ __('Remember Me') }}</label>
                                            </div>
                                            <div>
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}"> Forgot Password?</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <button type="submit" class="btn btn-primary fw-bold fs-6 w-100" name="submit">{{ __('Login') }}</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('auth.socilaite.redirect', 'google') }}" class="btn btn-lg btn-light fs-6 w-100"><i class="fa-brands fa-google me-2" style="color: #7366ff;"></i><small class="text-muted">Or Sign In with Google</small></a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <p class="me-2">Don't have account?</p>
                            <a href="{{ route('register') }}" class="text-decoration-none">Create Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
