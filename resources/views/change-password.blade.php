@extends('layouts.master')
@section('title')
    {{ __('Change Password') }}
@endsection
@section('styles')
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/webfonts') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{ __('Change Password') }}</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                                    <a href="{{ route('supervisors.dashboard') }}"> <i data-feather="home"></i>
                                    @elseif(auth()->user()->role == \App\Models\User::ROLE_USER)
                                        <a href="{{ route('students.dashboard') }}"> <i data-feather="home"></i>
                                        @elseif(auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                                            <a href="{{ route('admins.dashboard') }}"> <i data-feather="home"></i>
                                @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Change Password') }} </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">{{ __('My Profile') }}</h4>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row mb-2">
                                        <div class="profile-title">
                                            <div class="media">
                                                <img class="img-80 rounded-circle" alt=""
                                                    src="{{ !empty(auth()->user()->photo) ? url('assets/upload/student_images/' . auth()->user()->photo) : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->full_name }}">
                                                <div class="media-body">
                                                    <h5 class="mb-1">{{ auth()->user()->full_name }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="tx-11 fw-bolder mb-0 text-uppercase">{{ __('Full Name') }} </label>
                                        <p class="text-muted">{{ auth()->user()->username }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <label class="tx-11 fw-bolder mb-0 text-uppercase">{{ __('Email') }}</label>
                                        <p class="text-muted">{{ auth()->user()->email }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <label class="tx-11 fw-bolder mb-0 text-uppercase">{{ __('Phone') }}</label>
                                        <p class="text-muted">{{ auth()->user()->phone }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <label class="tx-11 fw-bolder mb-0 text-uppercase">{{ __('Address') }}</label>
                                        <p class="text-muted">{{ auth()->user()->address }}</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <form class="card" method="POST" action="{{ route('passwords.update') }}">
                            @csrf
                            <div class="card-header">
                                <h4 class="card-title mb-0">{{ __('Change Password') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="">{{ __('Old Password') }}<span
                                                class="redstar">*</span></label>
                                        <input type="password" name="old_password"
                                            class="form-control shadow-none @error('old_password') is-invalid @enderror"
                                            id="old_password">
                                        <span style="position: absolute; left: 91%; top: 57%;"
                                            onclick="password_show_hide('old_password', 'show_eye_old_password', 'hide_eye_old_password');">
                                            <i class="fas fa-eye" id="show_eye_old_password"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye_old_password"></i>
                                        </span>
                                        @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="">{{ __('New Password') }}<span
                                                class="redstar">*</span></label>
                                        <input type="password" name="password"
                                            class="form-control shadow-none @error('password') is-invalid @enderror"
                                            id="password">
                                        <span style="position: absolute; left: 91%; top: 57%;"
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

                                    <div class="mb-3">
                                        <label for="">{{ __('Confirm New Password') }}<span
                                                class="redstar">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control shadow-none"
                                            style="position: relative" id="password_confirmation">
                                        <span style="position: absolute; left: 91%; top: 57%;"
                                            onclick="password_show_hide('password_confirmation', 'show_eye_password_confirmation', 'hide_eye_password_confirmation');">
                                            <i class="fas fa-eye" id="show_eye_password_confirmation"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye_password_confirmation"></i>
                                        </span>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button class="btn btn-primary" type="submit">{{ __('Save Change') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
