@extends('layouts.master')
@section('title')
    @if (auth()->user()->team->leader_id == auth()->user()->id)
        {{ __('Upload Documentation') }}
    @else
        {{ __('Show Documentation') }}
    @endif
@endsection
@section('styles')
    <style>
        .media .para {
            font-size: 16px;
        }
    </style>
@endsection
@section('content')
    <div class="page-body">

        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        @if (auth()->user()->team->leader_id == auth()->user()->id)
                            <h3>{{ __('Upload Documentation') }}</h3>
                        @else
                            <h3>{{ __('Show Documentation') }}</h3>
                        @endif
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('students.dashboard') }}"> <i
                                        data-feather="home"></i></a>
                            </li>
                            @if (auth()->user()->team->leader_id == auth()->user()->id)
                                <li class="breadcrumb-item">{{ __('Upload Documentation') }}</li>
                            @else
                                <li class="breadcrumb-item">{{ __('Show Documentation') }}</li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                @if (auth()->user()->team->leader_id == auth()->user()->id)
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('students.book.store', $team->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputUsername5" class="form-label">{{ __('Upload Documentation') }}</label>
                                        <input class="form-control @error('book') is-invalid @enderror" type="file"
                                            name="book" aria-label="file example">
                                        @error('book')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername5" class="form-label">{{ __('Upload Presentation') }}</label>
                                        <input class="form-control" type="file" name="presentation"
                                            aria-label="file example">
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-primary" type="submit">{{ __('Save Change') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xl-12">
                        <div class="card">
                            {{-- <div class="card-header" style="padding: 10px !important;">
                                <h5 class="card-title mb-0"></h5>
                            </div> --}}
                            <div class="card-body" style="padding: 20px !important;">
                                <div class="row mb-2">
                                    <div class="profile-title">
                                        <div class="media">
                                            <p class="para">
                                                {{ __('The documentation and presentation can be uploaded and modified through the leader only. Here, click on download button to download the documentation for your project.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header" style="padding: 10px !important;">
                            <h5 class="card-title mb-0">{{ __('Documentation') }}</h5>
                        </div>
                        <div class="card-body" style="padding: 20px !important;">
                            <div class="row mb-2">
                                @if (auth()->user()->team->book)
                                    <div class="profile-title">
                                        <div class="media">
                                            <div class="media-body">
                                                <a href="{{ !empty(auth()->user()->team) ? url('assets/upload/docs/' . auth()->user()->team->book) : 'null' }}"
                                                    class="btn btn-primary" download>{{ __('Download Documentation') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="profile-title">
                                        <div class="media" style="text-align: center;">
                                            {{ __('No Documentation Uploaded Yet!') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header" style="padding: 10px !important;">
                            <h5 class="card-title mb-0">{{ __('Presentation') }}</h5>
                        </div>
                        <div class="card-body" style="padding: 20px !important;">
                            <div class="row mb-2">
                                @if (auth()->user()->team->presentation)
                                    <div class="profile-title">
                                        <div class="media">
                                            <div class="media-body">
                                                <a href="{{ !empty(auth()->user()->team) ? url('assets/upload/docs/' . auth()->user()->team->presentation) : 'null' }}"
                                                    class="btn btn-primary" download>{{ __('Download Presentation') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="profile-title">
                                        <div class="media" style="text-align: center;">
                                            {{ __('No Presentation Uploaded Yet!') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
