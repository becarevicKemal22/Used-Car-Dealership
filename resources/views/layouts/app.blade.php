<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sale of used cars. We are located in Sarajevo and we're open Monday-Saturday from 9AM to 5PM.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Used car dealership</title>

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
                        class="d-inline-block align-top" alt="Dealership logo">
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
                            <a class="nav-link {{ Request::url() == url('/')  ? 'current-page' : '' }}" href="/"> Home </a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link {{ Request::url() == url('/vehicles')  ? 'current-page' : '' }}" href="/vehicles"> Cars for sale </a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link {{ Request::url() == url('/about')  ? 'current-page' : '' }}" href="/about"> About us </a>
                        </li>
                        <li class="nav-item px-2 {{ Request::url() == url('/contact')  ? 'current-page' : '' }}">
                            <a class="nav-link" href="/contact"> Contact us </a>
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
                    <h5 class="alert alert-success w-75">{{ session('status') }}</h5>
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
                        <h5 class="text-uppercase mb-3">Navigation</h5>

                        <ul class="list-unstyled d-flex flex-column gap-2">
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>
                                <a href=" {{ route('vehicles.index') }} ">Cars for sale</a>
                            </li>
                            <li>
                                <a href="/about">About us</a>
                            </li>

                            {{-- Admin options --}}
                            @auth
                                <li>
                                    <a href="{{ route('vehicles.create') }}">Add vehicle</a>
                                </li>
                                <li>
                                    <a href="{{ route('manufacturers.create') }}">Add manufacturer</a>
                                </li>
                                <li>
                                    <a href="{{ route('vehicleModels.create') }}">Add model</a>
                                </li>
                                <li>
                                    <a href="{{ route('vehicleTypes.create') }}">Add vehicle type</a>
                                </li>
                            @endauth
                        </ul>

                    </div>
                    <!-- Grid column -->
                    <div class="col-lg-2 mb-lg-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase mb-3">Contact</h5>

                        <ul class="list-unstyled d-flex flex-column gap-3">
                            <li class="mb-1">
                                <a href="tel:+387602202205" style="font-weight: bold;">+387 22/022-005</a>
                            </li>
                            <li>
                                <a href="https://olx.ba" style="font-weight: bold;">Our site on OLX</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->
                    <div class="col-lg-2 mb-lg-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">Working hours</h5>

                        <ul class="list-unstyled">
                            <li>
                                <p class="mb-1">Mon-Sat 09:00 - 17:00</p>
                            </li>
                            <li>
                                <p class="mb-1">Sarajevo, Koševsko brdo</p>
                            </li>
                            <li>
                                <p class="mb-1">Some random address no. 22</p>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->
                    <div class="col-lg-2 mt-lg-0 mt-3">
                        <!-- Content -->
                        <div class="d-flex gap-4 align-items-center justify-content-start">
                            <a href="https://instagram.com" style="font-size: 2.5em" alt="Instagram"><i class="fa-brands fa-instagram" name="Instagram"></i></a>
                            <a href="https://facebook.com"style="font-size: 2.5em" name="Facebook"><i
                                    class="fa-brands fa-facebook"  alt="Facebook"></i></a>
                            <img src="{{ Storage::disk('s3')->url('/assets/logoWide.webp') }}" height="65" alt="Company logo">
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
