@extends('auth.layouts.app')
@section('title')
    Register
@endsection
@section('styles')
    <style>
        .select2-container {
            text-align: initial !important;
        }

        .select2-container--default .select2-selection--single {
            border: none;
            border-bottom: 1px solid #ede8e8 !important;
            border-radius: 0px !important;
        }
    </style>
@endsection
@section('content')
    <div class="page">
        <h1>graduation platform</h1>
        <form action="{{ route('register') }}" method="POST" style="height: auto;">
            @csrf
            <img src="{{ asset('images/loo.png') }}" alt="grade">
            <div>
                <i class="fa-solid fa-user icon"></i>
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                    placeholder="First Name" name="first_name" value="{{ old('first_name') }}"
                    autocomplete="First Name" autofocus>
                @error('first_name')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <i class="fa-solid fa-user icon"></i>
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                    placeholder="Last Name" name="last_name" value="{{ old('last_name') }}"
                    autocomplete="Last Name" autofocus>
                @error('last_name')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <i class="fa-solid fa-envelope icon"></i>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="email">
                @error('email')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <i class="fa-solid fa-lock icon"></i>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" name="password" autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <i class="fa-solid fa-lock icon"></i>
                <input id="password_confirmation" placeholder="Confirm Password" type="password"
                    name="password_confirmation" autocomplete="new-password">
            </div>
            <div>
                <i class="fa-solid fa-phone icon"></i>
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                    placeholder="Phone" name="phone" value="{{ old('phone') }}" autocomplete="Phone" autofocus>
                @error('phone')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <select
                    class="js-example-placeholder-single form-select form-control @error('department_id') is-invalid @enderror"
                    name="department_id" id="department">
                    <option selected disabled></option>
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
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
            <div class="link" style="margin-top: 10px;">
                <p>have an account?</p>
                <a style="margin-top: -15px;font-size: 14px;" href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
@endsection
