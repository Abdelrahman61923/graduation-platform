@extends('auth.layouts.app')
@section('title')
    Change Password
@endsection
@section('content')
    <div class="page">
        <h1>graduation platform</h1>
        <form  action="{{ route('passwords.update') }}" method="POST" style="height: auto;">
            @csrf
            <img src="{{ asset('images/loo.png') }}" alt="grade">
            <div>
                <i class="fa-solid fa-lock icon"></i>
                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror"
                    placeholder="Old Password" name="old_password" required autocomplete="old-password">
                @error('old_password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <i class="fa-solid fa-lock icon"></i>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="New Password" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <i class="fa-solid fa-lock icon"></i>
                <input id="password_confirmation" placeholder="Confirm Password" type="password"
                    name="password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit" class="btn btn-primary">
                {{ __('Change') }}
            </button>
        </form>
        <div>
            <form method="POST" action="{{ route('passwords.skip') }}">
                @csrf
                <a href="{{ route('passwords.skip') }}"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    <span>Skip</span>
                </a>
            </form>
        </div>
    </div>
@endsection
