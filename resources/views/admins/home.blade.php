@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admins.dashboard')}}"> <i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="f-w-500 font-roboto">Total Supervisor<span
                                            class="badge pill-badge-primary ms-3">Count</span></p>
                                    <div class="progress-box">
                                        <h4 class="f-w-500 mb-0 f-20"><span class="counter">{{ $total_supervisor }}</span>
                                        </h4>
                                        <div
                                            class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
                                            <div class="progress-gradient-primary" role="progressbar"
                                                style="width: {{ $total_supervisor_precantage }}%" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"><span
                                                    class="font-primary">{{ $total_supervisor_precantage }}%</span><span
                                                    class="animate-circle"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="f-w-500 font-roboto">Total Students<span
                                            class="badge pill-badge-primary ms-3">Count</span></p>
                                    <div class="progress-box">
                                        <h4 class="f-w-500 mb-0 f-20"><span class="counter">{{ $total_students }}</span>
                                        </h4>
                                        <div
                                            class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
                                            <div class="progress-gradient-primary" role="progressbar"
                                                style="width: {{ $total_student_precantage }}%" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"><span
                                                    class="font-primary">{{ $total_student_precantage }}%</span><span
                                                    class="animate-circle"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="f-w-500 font-roboto">Total Teams<span
                                            class="badge pill-badge-primary ms-3">Count</span></p>
                                    <div class="progress-box">
                                        <h4 class="f-w-500 mb-0 f-20"><span class="counter">{{ $total_teams }}</span></h4>
                                        <div
                                            class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
                                            <div class="progress-gradient-primary" role="progressbar" style="width: 100%"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span
                                                    class="font-primary">100%</span><span class="animate-circle"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="f-w-500 font-roboto">Total Members In Teams<span
                                            class="badge pill-badge-primary ms-3">Count</span></p>
                                    <div class="progress-box">
                                        <h4 class="f-w-500 mb-0 f-20"><span
                                                class="counter">{{ $number_of_members_in_teams }}</span></h4>
                                        <div
                                            class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
                                            <div class="progress-gradient-primary" role="progressbar"
                                                style="width: {{ $number_of_members_in_teams_precantage }}%"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span
                                                    class="font-primary">{{ $number_of_members_in_teams_precantage }}%</span><span
                                                    class="animate-circle"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row second-chart-list third-news-update">
                <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
                    <div class="card profile-greeting">
                        <div class="card-body pb-0">
                            <div class="media">
                                <div class="media-body">
                                    <div class="greeting-user">
                                        <h4 class="f-w-600 font-primary" id="greeting">Good Morning</h4>
                                        <p>Here whats happing in your account today</p>
                                        <div class="whatsnew-btn"><a class="btn btn-primary">Whats New !</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="badge-groups">
                                    <div class="badge f-10"><i class="me-1" data-feather="clock"></i><span
                                            id="txt"></span></div>
                                </div>
                            </div>
                            <div class="cartoon"><img class="img-fluid" src="../assets/images/dashboard/cartoon.png"
                                    alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 xl-50 calendar-sec box-col-6">
                    <div class="card gradient-primary o-hidden">
                        <div class="card-body">
                            <div class="setting-dot">
                                <div class="setting-bg-primary date-picker-setting pull-right">
                                    <div class="icon-box"><i data-feather="more-horizontal"></i></div>
                                </div>
                            </div>
                            <div class="default-datepicker">
                                <div class="datepicker-here" data-language="en"></div>
                            </div><span class="default-dots-stay overview-dots full-width-dots"><span
                                    class="dots-group"><span class="dots dots1"></span><span
                                        class="dots dots2 dot-small"></span><span
                                        class="dots dots3 dot-small"></span><span
                                        class="dots dots4 dot-medium"></span><span
                                        class="dots dots5 dot-small"></span><span
                                        class="dots dots6 dot-small"></span><span
                                        class="dots dots7 dot-small-semi"></span><span
                                        class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">
                                    </span></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
