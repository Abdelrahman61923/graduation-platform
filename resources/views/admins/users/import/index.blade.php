@extends('layouts.master')
@section('title')
    {{ __('Import Users') }}
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{ __('Import Users') }}</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active"> {{ __('Import Users') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="row g-3 needs-validation" method="post" action="{{ route('users.import') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 position-relative">
                                    <label for="">{{ __('Xlsx File Import') }}</label>
                                    <input class="form-control" name="import_file" id="import_file" type="file">
                                </div>
                                <div class="text-end mt-4">
                                    <button class="btn btn-primary" type="submit">{{ __('Upload') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
