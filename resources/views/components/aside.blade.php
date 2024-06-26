<div class="sidebar-wrapper">
    @if (auth()->user()->role == \App\Models\User::ROLE_USER)
        <div>
            <div class="logo-wrapper"><a href="{{ route('students.dashboard') }}"><img class="img-fluid for-light"
                        src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                        src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
                <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                </div>
            </div>
            <div class="logo-icon-wrapper"><a href="{{ route('students.dashboard') }}"><img class="img-fluid"
                        src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn"><a href="{{ route('students.dashboard') }}"><img class="img-fluid"
                                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>

                        @foreach ($items["student"] as $item)
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::is($item['active'])? 'active' : '' }}"
                                    href="{{ route($item['route']) }}"><i data-feather="{{ $item['icon'] }}"></i><span>
                                        {{ __($item['title']) }}
                                    </span></a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    @elseif(auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
        <div>
            <div class="logo-wrapper"><a href="{{ route('supervisors.dashboard') }}"><img class="img-fluid for-light"
                        src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                        src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
                <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                </div>
            </div>
            <div class="logo-icon-wrapper"><a href="{{ route('supervisors.dashboard') }}"><img class="img-fluid"
                        src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn"><a href="{{ route('supervisors.dashboard') }}"><img class="img-fluid"
                                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>

                        @foreach ($items["supervisor"] as $item)
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::is($item['active'])? 'active' : '' }}"
                                    href="{{ route($item['route']) }}"><i data-feather="{{ $item['icon'] }}"></i><span>
                                        {{ __($item['title']) }}
                                    </span></a>
                            </li>
                        @endforeach


                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    @elseif(auth()->user()->role == \App\Models\User::ROLE_ADMIN)
        <div>
            <div class="logo-wrapper"><a href="{{ route('admins.dashboard') }}"><img class="img-fluid for-light"
                        src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                        src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
                <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                </div>
            </div>
            <div class="logo-icon-wrapper"><a href="{{ route('admins.dashboard') }}"><img class="img-fluid"
                        src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn"><a href="{{ route('admins.dashboard') }}"><img class="img-fluid"
                                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>

                        @foreach ($items["admin"] as $item)
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::is($item['active'])? 'active' : '' }}"
                                    href="{{ route($item['route']) }}"><i data-feather="{{ $item['icon'] }}"></i><span>
                                        {{ __($item['title']) }}
                                    </span></a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    @endif
</div>
