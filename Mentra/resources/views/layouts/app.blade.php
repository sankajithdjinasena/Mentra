<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}


        <nav class="navbar navbar-expand-lg bg-body-tertiary ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="{{ asset('img/logo-png.png') }}" class="logo-nav"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('/') ? 'active' : '' }}"
                            href="{{ route('/') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('studyinfo.index') ? 'active' : '' }}"
                            href="{{ route('studyinfo.index') }}">Start Study</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('todolist.index') ? 'active' : '' }}"
                            href="{{ route('todolist.index') }}">To do list</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reminders.index') ? 'active' : '' }}"
                            href="{{ route('reminders.index') }}">Reminders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('study_progress.index') ? 'active' : '' }}"
                            href="{{ route('study_progress.index') }}">Study Progress</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('music.index', 'chatbot.index', 'youtube_video', 'sleepredict', 'articals.index') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->routeIs('community') ? 'active' : '' }}"
                                    href="{{ route('community') }}">Study community</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('music.index') ? 'active' : '' }}"
                                    href="{{ route('music.index') }}">FocusZen Music</a></li>
                            {{-- <li><a class="dropdown-item {{ request()->routeIs('chatbot.index') ? 'active' : '' }}"
                                    href="{{ route('chatbot.index') }}">Chatbot</a></li> --}}
                            <li><a class="dropdown-item {{ request()->routeIs('youtube_video') ? 'active' : '' }}"
                                    href="{{ route('youtube_video') }}">YouTube Video Analyzer</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('sleepredict') ? 'active' : '' }}"
                                    href="{{ route('sleepredict') }}">Sleep Predictor</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('articals.index') ? 'active' : '' }}"
                                    href="{{ route('articals.index') }}">Study Article</a></li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('topfocuzers.index') ? 'active' : '' }}"
                                    href="{{ route('topfocuzers.index') }}">Top Focuzers</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('challenges.index') ? 'active' : '' }}"
                                    href="{{ route('userchallenges.index') }}">Study Challenges</a>
                            </li>

                        </ul>
                    </li>

                    </ul>
                    <ul class="d-flex navbar-nav right-ul" role="search">
                        <li class="nav-item">
                            @guest
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            @else
                                <a class="nav-link" href="{{ route('logout') }}" title="Logout From your FocusZen account"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </li>
                        <li class="nav-item">
                            <a class="nav-link reg-btn" href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
