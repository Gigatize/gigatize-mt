<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="d-flex flex-column">
        <nav class="navbar navbar-expand-md bg-white navbar-laravel border-bottom flex-shrink-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo.svg" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column flex-grow-1 scroll-y">
            <main class="py-4 flex-grow-1">
                @yield('content')
            </main>
            <footer class="px-4 py-2 bg-white border-top flex-shrink-0">
                <img src="/images/logo.svg" class="mb-2" width="120px" />
                <div class="row">
                    <div class="col-xs-12 col-md-3 col-lg-2">
                        <ul class="p-0 m-0 small">
                            <li><a class="text-dark" href="#">Home</a></li>
                            <li><a class="text-dark" href="#">My Profile</a></li>
                            <li><a class="text-dark" href="#">Company Impact</a></li>
                            <li><a class="text-dark" href="#">Find a Gig</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-2">
                        <ul class="p-0 m-0 small">
                            <li><a class="text-dark" href="#">About</a></li>
                            <li><a class="text-dark" href="#">Support</a></li>
                            <li><a class="text-dark" href="#">Contact Gigatize</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-2">
                        <ul class="p-0 m-0 small">
                            <li><a class="text-dark" href="#">Privacy Policy</a></li>
                            <li><a class="text-dark" href="#">Terms and Conditions</a></li>
                        </ul>
                    </div>
                    <div class="align-self-end ml-auto mt-1">
                        <ul class="p-0 m-0 small">
                            <li class="text-dark">&copy; 2018 Gigatize</li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
