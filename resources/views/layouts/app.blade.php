<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Eurocentar</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Montserrat" rel="stylesheet">

    <script src="https://kit.fontawesome.com/8a54e0956e.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100 overflow-hidden">
        <nav
            class="navbar navbar-expand-md navbar-dark {{ Request::url() == url('/') ? 'transparent fixed-top' : 'bg-white shadow-sm' }}">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ Storage::disk('s3')->url('/assets/logoWide.webp') }}" height="90"
                        class="d-inline-block align-top" alt="Eurocentar logo">
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
                            <a class="nav-link {{ Request::url() == url('/')  ? 'current-page' : '' }}" href="/"> Početna </a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link {{ Request::url() == url('/vozila')  ? 'current-page' : '' }}" href="/vozila"> Ponuda vozila </a>
                        </li>
                        <li class="nav-item px-2 {{ Request::url() == url('/usluge')  ? 'current-page' : '' }}">
                            <a class="nav-link" href="/usluge"> Usluge </a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link {{ Request::url() == url('/about')  ? 'current-page' : '' }}" href="/about"> O nama </a>
                        </li>
                        <li class="nav-item px-2 {{ Request::url() == url('/kontakt')  ? 'current-page' : '' }}">
                            <a class="nav-link" href="/kontakt"> Kontakt </a>
                        </li>
                        <!-- Authentication Links -->

                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle dropBtn" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
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
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="{{ Request::url() == url('/') ? 'pb-4' : 'py-4' }}">
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
        <footer class="page-footer font-small text-white blue pt-4 mt-auto"
            style="background-color:rgba(60, 60, 60, 1)">

            <!-- Footer Links -->
            <div class="container-fluid text-center text-md-left mt-4">

                <!-- Grid row -->
                <div class="row">
                    <div class="col-lg-1 mb-lg-0 mb-3">

                    </div>
                    <div class="col-lg-2 mb-lg-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase mb-3">Navigacija</h5>

                        <ul class="list-unstyled d-flex flex-column gap-2">
                            <li>
                                <a href="/">Početna</a>
                            </li>
                            <li>
                                <a href=" {{ route('vozila.index') }} ">Ponuda vozila</a>
                            </li>
                            <li>
                                <a href="/usluge">Usluge</a>
                            </li>
                            <li>
                                <a href="/about">O nama</a>
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
                    <div class="col-lg-2 mb-lg-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase mb-3">Kontakt</h5>

                        <ul class="list-unstyled d-flex flex-column gap-3">
                            <li class="mb-1">
                                <a href="tel:+38762800800" style="font-weight: bold;">+387 62/800-800</a>
                            </li>
                            <li>
                                <a href="https://eurocentar.olx.ba/" style="font-weight: bold;">eurocentar.olx.ba</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->
                    <div class="col-lg-2 mb-lg-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">Radno vrijeme</h5>

                        <ul class="list-unstyled">
                            <li>
                                <p class="mb-1">Pon-Sub 09:00 - 17:00</p>
                            </li>
                            <li>
                                <p class="mb-1">Sarajevo, Ilidža</p>
                            </li>
                            <li>
                                <p class="mb-1">Ismeta Alajbegovića Šerbe br. 1 A</p>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->
                    <div class="col-lg-2 mt-lg-0 mt-3">

                        <!-- Content -->
                        <div class="d-flex gap-4 align-items-center justify-content-start">
                            <a href="" style="font-size: 2.5em"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.facebook.com/eurocentar.sarajevo/"style="font-size: 2.5em"><i
                                    class="fa-brands fa-facebook"></i></a>
                            <img src="{{ Storage::disk('s3')->url('/assets/logoWide.webp') }}" height="65">
                        </div>

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
    .navbar:not(.transparent) {
        background-image: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('{{ Storage::disk('s3')->url('assets/banner.webp') }}') !important;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .transparent {
        background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.0));
    }

    .nav-link {
        color: white !important;
    }

    .page-footer a {
        color: white !important;
    }
</style>

</html>
