<div class="sidebar-wrapper">
    @if (auth()->user()->role == \App\Models\User::ROLE_USER)
        <div>
            <div class="logo-wrapper"><a href="{{ route('students.dashboard') }}"><img class="img-fluid for-light"
                        src="{{ asset('assets/images/logo/logo2.png') }}" alt=""><img class="img-fluid for-dark"
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

                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('students.dashboard') }}"><i data-feather="home"></i><span>
                                    {{ __('Dashboard') }}</span></a>
                        </li>
                        <li class="sidebar-list">
                            @if (auth()->user()->team?->supervisor &&
                                    auth()->user()->team->is_all_members_accepted &&
                                    auth()->user()->team->status == \App\Models\Team::STATUS_APPROVED)
                                <label id="new-badge" class="badge badge-light-secondary">New</label>
                            @endif
                            <a id="instructions-link1" class="sidebar-link sidebar-title link-nav"
                                href="{{ route('students.instruction') }}">
                                <i data-feather="list"></i><span>{{ __('Instructions') }}</span></a>
                        </li>

                        <li class="sidebar-list">
                            <a id="my-team-link" class="sidebar-link sidebar-title link-nav"
                                href="{{ route('students.my-team') }}">
                                <i data-feather="users"></i>
                                <span>{{ __('My Team') }}</span>
                            </a>
                        </li>
                        @if (auth()->user()->team?->supervisor &&
                                auth()->user()->team->is_all_members_accepted &&
                                auth()->user()->team->status == \App\Models\Team::STATUS_APPROVED)
                            @if (auth()->user()->team->leader_id == auth()->user()->id)
                                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('students.upload-book', auth()->user()->team->id) }}"><i
                                            data-feather="map"></i><span>
                                            {{ __('Upload Book') }}</span></a>
                                </li>
                            @else
                                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('students.upload-book', auth()->user()->team->id) }}"><i
                                            data-feather="map"></i><span>
                                            {{ __('Show Book') }}</span></a>
                                </li>
                            @endif
                        @endif

                        <li class="sidebar-list">
                            <a id="my-team-link" class="sidebar-link sidebar-title link-nav"
                                href="{{ route('students.project') }}">
                                <i data-feather="box"></i>
                                <span>{{ __('Projects') }}</span>
                            </a>
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

                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('supervisors.dashboard') }}"><i data-feather="home"></i><span>
                                    {{ __('Dashboard') }}</span></a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('supervisors.my-teams') }}"><i data-feather="users"></i><span>
                                    {{ __('My Teams') }}</span>
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
                        src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img
                        class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                        alt=""></a>
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

                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('admins.dashboard') }}"><i data-feather="home"></i><span>
                                    {{ __('Dashboard') }}</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('users.index') }}"><i data-feather="users"></i><span>
                                    {{ __('Users') }} </span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('departments.index') }}"><i data-feather="check-square"></i><span>
                                    {{ __('Departments') }}</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('tags.index') }}"><i data-feather="shopping-bag"></i><span>
                                    {{ __('Tags') }}</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('admins.teams') }}"><i data-feather="box"></i><span>
                                    {{ __('Teams') }} </span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('admins.settings') }}"><i data-feather="settings"></i><span>
                                    {{ __('Settings') }}</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('instructions.index') }}"><i data-feather="list"> </i><span>
                                    {{ __('Instructions') }}</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('projects.index') }}"><i
                                    data-feather="box"></i><span>
                                    {{ __('Projects') }}</span></a>
                        </li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('projects.index') }}"><i
                                    data-feather="box"></i><span>
                                    {{ __('Projects') }}</span></a>
                        </li>

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var instructionsLink = document.getElementById('instructions-link');
        var newBadge = document.getElementById('new-badge');

        if (!instructionsLink || !newBadge) {
            console.error('Elements not found:', {
                instructionsLink,
                newBadge
            });
            return;
        }

        if (localStorage.getItem('instructionsLinkClicked')) {
            newBadge.style.display = 'none';
        }

        instructionsLink.addEventListener('click', function() {
            newBadge.style.display = 'none';
            localStorage.setItem('instructionsLinkClicked', 'true');
        });
    });
</script>
