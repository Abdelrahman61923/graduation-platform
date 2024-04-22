@extends('auth.layouts.app')

@section('title')
    Register
@endsection

@section('content')
<div class="container col-md-4 position-relative" style="height: 565px;">
<div class="circle">
        <img src="{{ asset('images/loo.png') }}" alt="Logo">
    </div>
    <div class="page" style="margin-top: -45px;">
        <h1 class="name">Graduation Platform</h1>
        <form action="{{ route('register') }}" method="POST" class="my-form">
            @csrf
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input id="first_name" type="text" class="form-control shadow-none @error('first_name') is-invalid @enderror"
                        placeholder="First Name" name="first_name" value="{{ old('first_name') }}" autocomplete="First Name" autofocus style="width: 65%;">
                </div>
                @error('first_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input id="last_name" type="text" class="form-control shadow-none @error('last_name') is-invalid @enderror"
                        placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" autocomplete="Last Name" autofocus style="width: 65%;">
                </div>
                @error('last_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input id="email" type="email" class="form-control shadow-none @error('email') is-invalid @enderror"
                        placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="email" style="width: 65%;">
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input id="password" type="password" class="form-control shadow-none @error('password') is-invalid @enderror"
                        placeholder="Password" name="password" autocomplete="new-password" style="width: 65%;">
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input id="password_confirmation" placeholder="Confirm Password" type="password" 
                        name="password_confirmation" autocomplete="new-password" class="form-control shadow-none" style="width: 65%;">
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    <input id="phone" type="text" class="form-control shadow-none @error('phone') is-invalid @enderror"
                        placeholder="Phone" name="phone" value="{{ old('phone') }}" autocomplete="Phone" autofocus style="width: 65%;">
                </div>
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <select class="form-select form-control shadow-none @error('department_id') is-invalid @enderror" name="department_id" id="department" style="width: 65%;">
                    <option selected disabled> Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary  mb-3 fw-bold login-button">{{ __('Register') }}</button>
            <p class="dont-have-account me-2">Already have an account? <a href="{{ route('login') }}" class="ms-2">Login</a></p>
        </form>
    </div>
</div>
@endsection
