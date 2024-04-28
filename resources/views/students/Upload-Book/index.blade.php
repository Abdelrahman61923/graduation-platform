@extends('layouts.master')
@section('title')
    {{ __('Upload Book') }}
@endsection
@section('content')
<div class="page-body">

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>{{ __('Upload Book') }}</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('students.dashboard')}}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">{{ __('Upload Book') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
