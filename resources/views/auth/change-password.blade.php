@extends('auth.layouts.app')
@section('title')
    {{ __('Change Password') }}
@endsection
@section('styles')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center position-relative">
                    <h1 class="text-light" style="margin-bottom: 90px">Graduation Platform</h1>
                    <form method="POST" action="{{ route('passwords.update') }}" class="circle bg-white"
                        style="border-radius: 20px;padding-bottom: 20px;">
                        @csrf
                        <img src="{{ asset('assets/images/logo/loo.png') }}" alt="grade" class="mb-4">
                        <div class="container">
                            <div class="row px-md-40">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-lock icon"></i></span>
                                        <input id="old_password" type="password"
                                            class="form-control shadow-none @error('old_password') is-invalid @enderror"
                                            placeholder="Old Password" name="old_password" autocomplete="old-password">
                                        @error('old_password')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-lock icon"></i></span>
                                        <input id="password" type="password"
                                            class="form-control shadow-none @error('password') is-invalid @enderror"
                                            placeholder="New Password" name="password" autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-lock icon"></i></span>
                                        <input id="password_confirmation" class="form-control shadow-none"
                                            placeholder="Confirm Password" type="password" name="password_confirmation"
                                            autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-75 fw-bold fs-6">{{ __('Change') }}</button>
                        </div>
                    </form>

                    <div class="mt-3">
                        <form method="POST" action="{{ route('passwords.skip') }}">
                            @csrf
                            <a href="{{ route('passwords.skip') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                <span class="text-light">Skip</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
