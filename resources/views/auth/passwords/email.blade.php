@extends('auth.layouts.app')
@section('title')
    {{ __('Forget Password') }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="text-center position-relative">
                <h1 class="text-light" style="margin-bottom: 90px">Graduation Platform</h1>
                <form method="POST" action="{{ route('password.email') }}" class="circle bg-white" style="border-radius: 20px;padding-bottom: 20px;">
                    @csrf
                    <img src="{{ asset('images/loo.png') }}" alt="grade" class="mb-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="row px-md-40">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-75 fw-bold">Send Password Reset Link</button>
                    <div class="mt-3 d-flex justify-content-center">
                        <p class="me-2">Remember your account?</p>
                        <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
