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
        <nav class="navbar navbar-expand-lg bg-white navbar-laravel border-bottom flex-shrink-0">
            <div class="container-fluid">
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
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            <li class="mx-2"><a class="nav-link text-dark" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li class="mx-2"><a class="nav-link text-dark" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="mx-2">
                                <!-- Search Icon -->
                                <input class="p-1 pr-4" placeholder="Search" />
                            </li>
                            <router-link tag="li" to="/gigs/new">
                                <a class="nav-link text-dark mx-3 py-1 px-0">Post a Gig</a>
                            </router-link>
                            <router-link tag="li" to="/gigs">
                                <a class="nav-link text-dark mx-3 py-1 px-0">Find a Gig</a>
                            </router-link>
                            <router-link tag="li" to="/">
                                <a class="nav-link text-dark mx-3 py-1 px-0">Company Impact</a>
                            </router-link>
                            <li class="nav-item dropdown flex-shrink-0 d-flex flex-row">
                                <div class="ml-3 mr-2 nav-avatar">
                                    <img src="{{ Auth::user()->picture }}" class="img-fluid" />
                                </div>
                                <a id="navbarDropdown" class="dropdown-toggle mr-3 py-1 text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item small" href="">My Profile</a>
                                    <a class="dropdown-item small" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <!-- <li class="nav-item dropdown flex-shrink-0">
                                <a class="dropdown-toggle mr-3 py-1 text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="text-danger"><font-awesome-icon icon="bell"/></span>
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right notifications">
                                    <a class="dropdown-item d-flex flex-row border-bottom p-2" href="#">
                                        <div class="flex-shrink-0 pr-2">
                                            <span class="text-danger"><font-awesome-icon icon="bell"/></span>
                                        </div>
                                        <div>
                                            Notification 1<br />
                                            <small>
                                                This notification is informing you that lorem ipsum sic dolor set amet.
                                            </small>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex flex-row p-2" href="#">
                                        <div class="flex-shrink-0 pr-2">
                                            <span class="text-secondary"><font-awesome-icon icon="bell"/></span>
                                        </div>
                                        <div>
                                            Notification 2<br />
                                            <small>
                                                This notification is informing you that lorem ipsum sic dolor set amet.
                                            </small>
                                        </div>
                                    </a>
                                </div>
                            </li> -->
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
                    <div class="col-xs-12 col-md-3 ml-auto text-right">
                        <ul class="p-0 m-0 small">
                            <li><a class="text-dark" href="#">Privacy Policy</a></li>
                            <li><a class="text-dark" href="#">Terms and Conditions</a></li>
                            <li>&nbsp;</li>
                            <li class="text-dark">&copy; 2018 Gigatize</li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
