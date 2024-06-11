@extends('layouts.master')
@section('title')
    {{ __('Settings') }}
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{ __('Settings') }}</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"> <i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('Settings') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('admins.settings.store') }}" id="jquery-val-form"
                                class="needs-validation">
                                {{ csrf_field() }}
                                <input value="{{ old('id', $setting->id) }}" class="form-control" type="hidden"
                                    name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">{{ __('Min Team Member') }}<span class="redstar">*</span></label>
                                        <input value="{{ old('min_team_member', $setting->min_team_member) }}"
                                            class="form-control shadow-none" type="number" name="min_team_member"
                                            placeholder="{{ __('Please Enter Value') }}">
                                        @error('min_team_member')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="title">{{ __('Max Team Member') }}<span class="redstar">*</span></label>
                                        <input value="{{ old('max_team_member', $setting->max_team_member) }}"
                                            class="form-control shadow-none" type="number" name="max_team_member"
                                            placeholder="{{ __('Please Enter Value') }}">
                                        @error('max_team_member')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="title">{{ __('Max Group Teacher') }}<span class="redstar">*</span></label>
                                        <input value="{{ old('max_group_teacher', $setting->max_group_teacher) }}"
                                            class="form-control shadow-none" type="number" name="max_group_teacher"
                                            placeholder="{{ __('Please Enter Value') }}">
                                        @error('max_team_member')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12  mt-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
