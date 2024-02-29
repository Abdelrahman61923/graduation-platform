@extends('layouts.master')
@section('title')
    Edit Tag
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Edit Tag</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"> <i
                                    data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Edit Tag</li>
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
                            <form method="post" action="{{ route('tags.update', $tag->id) }}"
                                id="jquery-val-form" class="needs-validation">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                @include('admins.tags.partials.form', ['tag' => $tag])
                                <div class="col-12  mt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
