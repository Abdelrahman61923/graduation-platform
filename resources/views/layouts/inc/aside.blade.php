<div class="sidebar-wrapper">
    @if(auth()->user()->role == \App\Models\User::ROLE_USER)
        <div>
            <div class="logo-wrapper"><a href="{{ route('students.dashboard') }}"><img class="img-fluid for-light"
                        src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                        src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
                <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
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

                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('students.dashboard') }}"><i data-feather="home"></i><span>
                                    Dashboard</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('students.my-team') }}"><i data-feather="users"></i><span>
                                    My Team</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('students.instructions') }}"><i data-feather="users"></i><span>
                                    Instructions</span></a>
                        </li>
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
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
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

                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('supervisors.dashboard') }}"><i data-feather="home"></i><span>
                                    Dashboard</span></a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('supervisors.my-teams') }}"><i data-feather="users"></i><span>
                                My Teams</span>
                            </a>
                        </li>
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
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
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

                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('admins.dashboard') }}"><i data-feather="home"></i><span>
                                    Dashboard</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('users.index') }}"><i data-feather="users"></i><span>
                                Users</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('departments.index') }}"><i data-feather="check-square"></i><span>
                                Department</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('tags.index') }}"><i data-feather="shopping-bag"></i><span>
                                Tag</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('admins.teams') }}"><i data-feather="box"></i><span>
                                Teams</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('admins.settings') }}"><i data-feather="settings"></i><span>
                                Settings</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('admins.instructions') }}"><i data-feather="settings"></i><span>
                                Instructions</span></a>
                        </li>

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    @endif
</div>
