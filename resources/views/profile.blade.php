@extends('layouts.master')
@section('title')
    {{ __('Profile') }}
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{ __('Profile') }}</h3>
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
                            <li class="breadcrumb-item">{{ __('Dashboard') }} </li>
                            <li class="breadcrumb-item active">{{ __('Profile') }} </li>
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
                                                    src="{{ !empty(auth()->user()->photo) ? url('assets/upload/student_images/' . auth()->user()->photo) : "https://eu.ui-avatars.com/api/?name=".auth()->user()->full_name }}">
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
                        <form class="card" method="POST" action="{{ route('profile.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4 class="card-title mb-0">{{ __('Edit Profile') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">{{ __('First Name') }}</label>
                                        <input type="text" name="first_name" class="form-control"
                                            id="exampleInputUsername1" autocomplete="off"
                                            value="{{ auth()->user()->first_name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername2" class="form-label">{{ __('Last Name') }}</label>
                                        <input type="text" name="last_name" class="form-control"
                                            id="exampleInputUsername2" autocomplete="off"
                                            value="{{ auth()->user()->last_name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername4" class="form-label">{{ __('Email') }}</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputUsername4"
                                            autocomplete="off" value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername5" class="form-label">{{ __('Phone') }}</label>
                                        <input type="text" name="phone" class="form-control"
                                            id="exampleInputUsername5" autocomplete="off"
                                            value="{{ auth()->user()->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername6" class="form-label">{{ __('Address') }}</label>
                                        <input type="text" name="address" class="form-control"
                                            id="exampleInputUsername6" autocomplete="off"
                                            value="{{ auth()->user()->address }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername7" class="form-label">{{ __('Photo') }}</label>
                                        <input class="form-control" type="file" name="photo" id="image">
                                    </div>

                                    <div class="media">
                                        <label for="exampleInputUsername1" class="form-label"></label>
                                        <img id="showImage" class="img-80 rounded-circle" alt=""
                                            src="{{ !empty(auth()->user()->photo) ? url('assets/upload/student_images/' . auth()->user()->photo) : url('assets/upload/no_image.jpg') }}">
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
