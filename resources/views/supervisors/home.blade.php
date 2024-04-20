@extends('layouts.master')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>{{ __('Dashboard') }}</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('supervisors.dashboard')}}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row second-chart-list third-news-update">
            <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
                <div class="card profile-greeting">
                    <div class="card-body pb-0">
                        <div class="media">
                            <div class="media-body">
                                <div class="greeting-user">
                                    <h4 class="f-w-600 font-primary" id="greeting">{{ __('Good Morning') }}</h4>
                                    <p>{{ __('Here whats happing in your account today') }}</p>
                                    <div class="whatsnew-btn"><a class="btn btn-primary">{{ __('Whats New !') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="badge-groups">
                                <div class="badge f-10"><i class="me-1" data-feather="clock"></i><span
                                        id="txt"></span></div>
                            </div>
                        </div>
                        <div class="cartoon"><img class="img-fluid"
                                src="{{asset('assets/images/dashboard/cartoon.png')}}" alt=""></div>
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
                                    class="dots dots8 dot-small-semi"></span><span
                                    class="dots dots9 dot-small"> </span></span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
