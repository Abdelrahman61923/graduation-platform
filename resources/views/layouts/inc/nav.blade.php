<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo.png"
                        alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">
        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">

                <li> <span class="header-search"><i data-feather="search"></i></span></li>
                <li class="onhover-dropdown">
                    <div class="notification-box"><i data-feather="bell"> </i><span
                            class="badge rounded-pill badge-secondary">{{ Auth::User()->unreadNotifications()->count() }}
                        </span></div>
                    <div class="onhover-show-div notification-dropdown">
                        <h6 class="f-18 mb-0 dropdown-title">Notitications </h6>
                        <ul>

                            @foreach (Auth::User()->Notifications as $notification)
                                <li class="b-l-primary border-4 ">
                                    @if (auth()->user()->role == \App\Models\User::ROLE_USER)
                                        <a href="{{ route('students.my-team', ['notify_id' => $notification->id]) }}"
                                            class="text-decoration-none">
                                            <p
                                                class="text-lowercase @if ($notification->unread()) font-dark @endif">
                                                {{ $notification->data['body'] }} <span
                                                    class="font-danger ">{{ $notification->created_at->diffForHumans() }}</span>
                                            </p>
                                        </a>
                                    @elseif(auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                                        <a href="{{ route('supervisors.my-teams', ['notify_id' => $notification->id]) }}"
                                            class="text-decoration-none">
                                            <p
                                                class="text-lowercase @if ($notification->unread()) font-dark @endif">
                                                {{ $notification->data['body'] }} <span
                                                    class="font-danger ">{{ $notification->created_at->diffForHumans() }}</span>
                                            </p>
                                        </a>
                                    @endif
                                </li>
                            @endforeach

                            <li><a class="f-w-700" href="#">Check all</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>
                <li class="onhover-dropdown"><i data-feather="message-square"></i>
                    <div class="chat-dropdown onhover-show-div">
                        <h6 class="f-18 mb-0 dropdown-title">Messages</h6>
                        <ul class="py-0">
                            @foreach (Auth::User()->Notifications as $notification)
                                <li>
                                    <div class="media"><img class="img-fluid b-r-5 me-2"
                                            src="{{ asset($notification->data['photo']) }}" alt="">
                                        <div class="media-body">
                                            @if (auth()->user()->role == \App\Models\User::ROLE_USER)
                                                <a href="{{ route('students.my-team', ['notify_id' => $notification->id]) }}"
                                                    class="text-decoration-none">
                                                    <h6 class="text-lowercase">{{ $notification->data['name'] }}</h6>
                                                    <p class="text-lowercase">{{ $notification->data['body'] }}
                                                    </p>
                                                    <p class="f-8 font-primary mb-0 text-lowercase">
                                                        {{ $notification->created_at->diffForHumans() }}</p>
                                                </a>
                                            @elseif(auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                                                <a href="{{ route('supervisors.my-teams', ['notify_id' => $notification->id]) }}"
                                                    class="text-decoration-none">
                                                    <h6 class="text-lowercase">{{ $notification->data['name'] }}
                                                    </h6>
                                                    <p class="text-lowercase">{{ $notification->data['body'] }}
                                                    </p>
                                                    <p class="f-8 font-primary mb-0 text-lowercase">
                                                        {{ $notification->created_at->diffForHumans() }}</p>
                                                </a>
                                            @endif
                                        </div><span
                                            class="badge rounded-circle @if ($notification->unread()) badge-primary @endif badge-danger">1</span>
                                    </div>
                                </li>
                            @endforeach
                            <li class="text-center"> <a class="f-w-700" href="#">View All </a></li>
                        </ul>
                    </div>
                </li>

                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="media profile-media"><img style="border-radius: 4px;width: 33px !important;"
                            src="{{ auth()->user()->photo ? url('assets/upload/student_images/' . auth()->user()->photo) : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->full_name }}"
                            alt="">
                        <div class="media-body"><span>{{ auth()->user()->full_name }}</span>
                            <p class="mb-0 font-roboto">{{ auth()->user()->role }} <i
                                    class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                                <a href="{{ route('supervisors.profile') }}">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            @elseif(auth()->user()->role == \App\Models\User::ROLE_USER)
                                <a href="{{ route('students.profile') }}">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            @elseif(auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                                <a href="{{ route('admins.profile') }}">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            @endif
                        </li>
                        @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                            <li><a href="{{ route('admins.settings') }}"><i
                                        data-feather="settings"></i><span>Settings</span></a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    <i data-feather="log-in"> </i>
                                    <span>Log out</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
                <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                <div class="ProfileCard-details">
                    <div class="ProfileCard-realName"></div>
                </div>
            </div>
        </script>
        <script class="empty-template" type="text/x-handlebars-template">
            <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
        </script>
    </div>
</div>
