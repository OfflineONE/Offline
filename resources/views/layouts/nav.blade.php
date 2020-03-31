    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
                    <button type="button"
                            class="navbar-toggler"
                            data-toggle="collapse"
                            data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>

        <!-- Branding Image -->

                <a class="navbar-nav mr-auto" href="{{ url('/') }}">
                    <svg height="40px" viewBox="0 0 1920 1080" xmlns="http://www.w3.org/2000/svg"
                    >
                        <g id="Layer_2">
                            <path class="st0" d="M862.9 159.5h30v761.7h-30zM980.5 159.5h30v761.7h-30z"/>
                            <path transform="rotate(-90 1249.168 367.704)" class="st0" d="M1234.2-57.8h30v851h-30z"/>
                            <path transform="rotate(-90 910.694 174.527)" class="st0" d="M895.7 153.1h30V196h-30z"/>
                            <path transform="rotate(-90 1029.09 174.527)" class="st0" d="M1014.1 153.9h30v41.2h-30z"/>
                            <path class="st0"
                                  d="M1098.4 393.5h30v319.3h-30zM1518.3 393.5h30v319.3h-30zM1308.4 393.5h30v319.3h-30zM1203.4 393.5h30v319.3h-30zM1442.5 492.5h30v220.3h-30z"/>
                            <path transform="rotate(-90 1605.675 697.78)" class="st0" d="M1590.7 628.8h30v138h-30z"/>
                            <path transform="rotate(-90 1592.469 408.49)" class="st0" d="M1577.5 358.3h30v100.3h-30z"/>
                            <path transform="rotate(-90 1566.031 492.517)" class="st0" d="M1551 468.8h30v47.4h-30z"/>
                            <path transform="rotate(-90 1354.484 423.494)" class="st0" d="M1339.5 397.9h30v51.3h-30z"/>
                            <path class="st0" d="M1338.4 408.5h49.9c46.5 0 84.2 24 84.2 53.6v91.1"/>
                            <path transform="rotate(-90 1145.187 697.78)" class="st0" d="M1130.2 680.9h30v33.8h-30z"/>
                            <path class="st0"
                                  d="M625.5 282.8l-14.7 26.1c80.4 45.8 134.6 132.3 134.6 231.5 0 147-119.2 266.2-266.2 266.2S212.9 687.4 212.9 540.4c0-99.2 54.2-185.6 134.6-231.5l-14.7-26.1c-89.5 51-149.9 147.2-149.9 257.6 0 163.6 132.6 296.2 296.2 296.2S775.4 704 775.4 540.4c0-110.4-60.4-206.6-149.9-257.6z"/>
                            <path class="st0" d="M464.2 229h30v222.7h-30z"/>
                        </g>
                    </svg>
                </a>

        </div>

                <div class="collapse navbar-collapse"
                     id="app-navbar-collapse">

        <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav mx-auto">
{{--                //mx auto = center align--}}

                <li class="mr-5">
                    <a href="/threads/create">New Thread</a>
                </li>

                <li class="dropdown mr-5">

                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false">
                        Browse <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li><a href="/threads">All Threads</a></li>

                        @if (auth()->check())
                            <li><a href="/threads?by={{ auth()->user()->name }}">My Threads</a></li>
                        @endif

                        <li><a href="/threads?popular=1">Popular Threads</a></li>
                        <li><a href="/threads?unanswered=1">Unanswered Threads</a></li>
                    </ul>
                </li>
                <channel-dropdown :channels="{{ $channels }}"></channel-dropdown>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

{{--                <img src="{{ Auth::user()->avatar_path }}" alt="test" width="50" height="50" class="mt-4 rounded-b-full">--}}
{{--    TODO there is no avatar folder und storage app public--}}
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <user-notifications></user-notifications>

                    @if (Auth::user()->isAdmin())
                        <li><a href="/admin"><span class="phpdebugbar-fa-magic" aria-hidden="true"></span></a></li>
                    @endif

                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('profile.show', Auth::user()) }}">My Profile</a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
