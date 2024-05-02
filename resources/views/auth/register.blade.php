@extends('auth.layouts.app')
@section('title')
    {{ __('Register') }}
@endsection
@section('styles')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center position-relative">
                    <h1 class="mt-4 text-light" style="margin-bottom: 90px">Graduation Platform</h1>
                    <form action="{{ route('register') }}" method="POST" class="circle bg-white mb-5"
                        style="border-radius: 20px;padding-bottom: 20px;">
                        @csrf
                        <img src="{{ asset('images/loo.png') }}" alt="grade" class="mb-4">
                        <div class="container">
                            <div class="row px-md-40">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        <input id="first_name" type="text"
                                            class="form-control shadow-none @error('first_name') is-invalid @enderror"
                                            placeholder="First Name" name="first_name" value="{{ old('first_name') }}"
                                            autocomplete="First Name" autofocus>
                                        @error('first_name')
                                            <div class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        <input id="last_name" type="text"
                                            class="form-control shadow-none @error('last_name') is-invalid @enderror"
                                            placeholder="Last Name" name="last_name" value="{{ old('last_name') }}"
                                            autocomplete="Last Name" autofocus>
                                        @error('last_name')
                                            <div class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                        <input id="email" type="email"
                                            class="form-control shadow-none @error('email') is-invalid @enderror" placeholder="Email"
                                            name="email" value="{{ old('email') }}" autocomplete="email">
                                        @error('email')
                                            <div class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                        <input id="password" type="password"
                                            class="form-control shadow-none @error('password') is-invalid @enderror"
                                            placeholder="Password" name="password" autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                        <input id="password_confirmation" class="form-control shadow-none"
                                            placeholder="Confirm Password" type="password" name="password_confirmation"
                                            autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                        <input id="phone" type="text"
                                            class="form-control shadow-none @error('phone') is-invalid @enderror" placeholder="Phone"
                                            name="phone" value="{{ old('phone') }}" autocomplete="Phone" autofocus>
                                        @error('phone')
                                            <div class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                                        <select
                                            class="js-example-placeholder-single form-select form-control shadow-none @error('department_id') is-invalid @enderror"
                                            name="department_id" id="department">
                                            <option selected disabled>Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <div class="invalid-feedback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <button type="submit" class="btn btn-primary w-100 fw-bold fs-6">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <a href="{{ route('auth.socilaite.redirect', 'google') }}" class="btn btn-lg btn-light fs-6 w-100"><i
                                                class="fa-brands fa-google me-2" style="color: #7366ff;"></i><small
                                                class="text-muted">Or Sign Up with Google</small></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <p class="me-2">have an account?</p>
                            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
