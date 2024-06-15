@extends('layouts.master')
@section('title')
    {{ __('Instructions') }}
@endsection
@section('styles')
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
                            <li class="breadcrumb-item"><a href="{{ route('students.dashboard') }}"> <i
                                        data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item">{{ __('Instructions') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                @if (!$user->team?->supervisor || $user->team->status != \App\Models\Team::STATUS_APPROVED)
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>How To Create New Team?</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordernone table-xl">
                                    <tbody>
                                        @if ($create_teams && count($create_teams) > 0)
                                            @foreach ($create_teams as $key => $create_team)
                                                <tr>
                                                    <td>
                                                        <span style="color: blue">{{ $key + 1 }}</span>
                                                        - {{ $create_team->instruction }}
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
                @else
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
                                                    <span style="color: blue">{{ $key + 1 }}</span>
                                                    - {{ $project1->instruction }}
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
                                                    <span style="color: blue">{{ $key + 1 }}</span>
                                                    - {{ $project2->instruction }}
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
                @endif
            </div>
        </div>

    </div>
@endsection
