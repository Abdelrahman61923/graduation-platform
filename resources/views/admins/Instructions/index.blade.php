@extends('layouts.master')
@section('title')
    {{ __('Instructions') }}
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{ __('Instructions') }}</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"> <i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('Instructions') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header" style="padding: 30px !important;">
                            <div class="d-flex justify-content-start">
                                <h4 class="card-title mb-0">{{ __('All Instructions') }}</h4>
                            </div>
                            <div class="d-flex justify-content-end" style="margin-top: -30px;">
                                <a href="{{ route('instructions.create') }}" class="btn btn-primary">
                                    {{ __('Add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Create New Team</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordernone table-xl">
                                <tbody>
                                    @if ($create_teams && count($create_teams) > 0)
                                        @foreach ($create_teams as $key => $create_team)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('instructions.edit', ['instruction' => $create_team->id]) }}">
                                                        {{ $key + 1 }}
                                                    </a>- {{ $create_team->instruction }}
                                                </td>
                                                <td style="text-align: right;">
                                                    <a href="#" class="btn delete-confirm"
                                                        style="color: blue; font-size: 18px;"
                                                        data-url="{{ route('instructions.delete', ['id' => $create_team->id]) }}">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" style="text-align: center;">
                                                {{ __('No Instructions Yet!') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Project1</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordernone table-xl">
                                <tbody>
                                    @if ($projects1 && count($projects1) > 0)
                                        @foreach ($projects1 as $key => $project1)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('instructions.edit', ['instruction' => $project1->id]) }}">
                                                        {{ $key + 1 }}
                                                    </a>- {{ $project1->instruction }}
                                                </td>
                                                <td style="text-align: right;">
                                                    <a href="#" class="btn delete-confirm"
                                                        style="color: blue; font-size: 18px;"
                                                        data-url="{{ route('instructions.delete', ['id' => $project1->id]) }}">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" style="text-align: center;">
                                                {{ __('No Instructions Yet!') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Project2</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordernone table-xl">
                                <tbody>
                                    @if ($projects2 && count($projects2) > 0)
                                        @foreach ($projects2 as $key => $project2)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('instructions.edit', ['instruction' => $project2->id]) }}">
                                                        {{ $key + 1 }}
                                                    </a>- {{ $project2->instruction }}
                                                </td>
                                                <td style="text-align: right;">
                                                    <a href="#" class="btn delete-confirm"
                                                        style="color: blue; font-size: 18px;"
                                                        data-url="{{ route('instructions.delete', ['id' => $project2->id]) }}">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" style="text-align: center;">
                                                {{ __('No Instructions Yet!') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
