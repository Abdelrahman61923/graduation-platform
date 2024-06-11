@extends('layouts.master')
@section('title')
    {{ __('Projects') }}
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{ __('Projects') }}</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"> <i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('Projects') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row default-according style-1 faq-accordion" id="accordionoc">
                        <div class="card" style="margin-bottom: 20px;">
                            <div class="card-header" style="padding: 30px !important;">
                                <div class="d-flex justify-content-start">
                                    <h4 class="card-title mb-0">{{ __('All Projects') }}</h4>
                                </div>
                                <div class="d-flex justify-content-end" style="margin-top: -30px;">
                                    <a href="{{ route('projects.create') }}" class="btn btn-primary">
                                        {{ __('Add') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @foreach ($projects as $project)
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                                data-bs-target="#{{ 'collapseicon' . $project->id }}" aria-expanded="false"
                                                aria-controls="{{ 'collapseicon' . $project->id }}"><i
                                                    data-feather="help-circle"></i>
                                                {{ $project->name }}</button>
                                        </h5>
                                    </div>
                                    <div class="collapse" id="{{ 'collapseicon' . $project->id }}"
                                        aria-labelledby="{{ 'collapseicon' . $project->id }}"
                                        data-bs-parent="#accordionoc">
                                        <div class="card-body">{{ $project->description }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
