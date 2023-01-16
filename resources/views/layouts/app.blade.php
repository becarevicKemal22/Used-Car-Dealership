<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Euro Centar</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script src="https://kit.fontawesome.com/8a54e0956e.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ Storage::disk('s3')->url('/assets/logoWide.webp') }}" height="90" class="d-inline-block align-top" alt="">
                  </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto" style="font-size: 1.25rem; font-weight: bold;">
                        <li class="nav-item px-2">
                            <a class="nav-link" href="/"> Početna </a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="/vozila"> Ponuda vozila </a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="/usluge"> Usluge </a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link side-border" href="/kontakt"> Kontakt </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"> Admin {{ __('login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle dropBtn" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        </nav>

        <main class="py-4">
            @auth
                @if (session('status'))
                    <h5 class="alert alert-success w-75">{{ session('status') }}</h4>
                @elseif(session('error'))
                    <h5 class="alert alert-danger w-75">{{ session('error') }}</h5>
                @endif
            @endauth

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="page-footer font-small blue pt-4 mt-auto">

            <!-- Footer Links -->
            <div class="container-fluid text-center text-md-left">

                <!-- Grid row -->
                <div class="row">

                    <div class="col-md-3 mb-md-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">Navigacija</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href=" {{ route('vozila.index') }}">Ponuda vozila</a>
                            </li>
                            <li>
                                <a href="#!">O nama</a>
                            </li>

                            {{-- Admin options --}}
                            @auth
                                <li>
                                    <a href="{{ route('vozila.create') }}">Dodaj vozilo</a>
                                </li>
                                <li>
                                    <a href="{{ route('manufacturers.create') }}">Dodaj marku</a>
                                </li>
                                <li>
                                    <a href="{{ route('vehicleModels.create') }}">Dodaj model auta</a>
                                </li>
                                <li>
                                    <a href="{{ route('vehicleTypes.create') }}">Dodaj tip auta</a>
                                </li>
                            @endauth
                        </ul>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 mb-md-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">Sarajevo</h5>

                        <ul class="list-unstyled">
                            <li>
                                <p class="mb-1">Ismeta Alajbegovića Šerbe br. 1 A</p>
                            </li>
                            <li class="mb-1">
                                <a href="tel:+38762800800">+387 62/800-800</a>
                            </li>
                            <li>
                                <a href="https://eurocentar.olx.ba/">OLX.ba</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->
                    <div class="col-md-6 mt-md-0 mt-3">

                        <!-- Content -->
                        <h5 class="text-uppercase">Footer Content</h5>
                        <p>Here you can use rows and columns to organize your footer content.</p>

                    </div>
                    <!-- Grid column -->

                    <hr class="clearfix w-100 d-md-none pb-3">

                    <!-- Grid column -->
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </div>
            <!-- Footer Links -->
        </footer>
        <!-- Footer -->

    </div>

</body>

<style>
    .navbar{
        background-image: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('https://www.hdcarwallpapers.com/walls/6th_gear_racing_cars-wide.jpg') !important;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center center;
    }

    .nav-link{
        color: white !important;
    }

    .side-border{
        padding-left: 1em !important;
        border-left: 3px solid #8a1820;
    }
</style>

</html>
