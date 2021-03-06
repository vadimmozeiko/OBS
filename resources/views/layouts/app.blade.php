<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OBS</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body style="background-image: url({{asset('assets/img/bg.jpg')}});">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light white-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
            <div class="logo"></div></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link menu hover-blue {{ request()->is('/') ? 'bg-blue' : '' }}" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link menu hover-blue {{ request()->is('products*') ? 'bg-blue' : '' }}" href="{{route('products')}}">Products</a></li>
                    <li class="nav-item"><a class="nav-link menu hover-blue {{ request()->is('faq*') ? 'bg-blue' : '' }}" href="{{route('faq')}}">FAQ's</a></li>
                    <li class="nav-item"><a class="nav-link menu hover-blue {{ request()->is('contact*') ? 'bg-blue' : '' }}" href="{{route('contact')}}">Contact Us</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link menu hover-blue {{ request()->is('login') ? 'bg-blue' : '' }}" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link menu hover-blue {{ request()->is('register') ? 'bg-blue' : '' }}" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->isAdmin)
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i></i> {{ __('Admin Dashboard') }}
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('user.orders', auth()->user()->id) }}">
                                    <i class="fas fa-list"></i> {{ __('My bookings') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('user.index') }}">
                                    <i class="fas fa-user"></i> {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
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
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if(session()->has('success_message'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('success_message')}}
                        </div>
                    @endif

                    @if(session()->has('info_message'))
                        <div class="alert alert-info" role="alert">
                            {{session()->get('info_message')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="triangle-right"></div>
        @yield('content')
    </main>
</div>
</body>
<script>
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        weekStartDay: 1,
        minDate: function() {
            const date = new Date();
            date.setDate(date.getDate()+1);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
        },
        maxDate: function() {
            const date = new Date();
            date.setDate(date.getDate()+90);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
        },
        uiLibrary: 'bootstrap4',
        showRightIcon: false
    });
</script>
<script src="{{ asset('js/app.js') }}"></script>
</html>
