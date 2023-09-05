<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" ></script>
    <script src="https://kit.fontawesome.com/551bd3e2f2.js" crossorigin="anonymous"></script> <!-- icons at fontawesome -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar {{--navbar-expand-md--}} navbar-dark shadow-sm " style="background-color: #2980b9;" >
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ asset('/img/logo/Logo.png') }}" width="50" height="50" alt="logo" style="background-color: transparent;">
                    <span class="ms-3 fs-3">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" data-bs-scroll="true" id="navbarSupportedContent">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title fs-3" id="offcanvasNavbarLabel">{{ config('app.name', 'Laravel') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                        <!-- Left Side Of Navbar -->
                        {{-- <ul class="navbar-nav me-auto">     <!--manual add -->
                        <li class="nav-item">
                            @auth
                            <a class="nav-link text-light ms-3  fs-4"
                                href="{{ url('/articles/add')}}">  <!--manual link add -->
                                + Add Article
                            </a>
                            @endauth
                        </li>
                        </ul> --}}

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto justify-content-end flex-grow-1 pe-3">
                        <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="fs-5 nav-link active text-dark" href="{{ url('/articles/add')}}">
                                        + Add Article
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="#" class="fs-5 nav-link dropdown-toggle text-dark"role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                        @foreach ($categories as $category)

                                            <a href="{{url("/categories/$category->id")}}" class="dropdown-item me-3">{{$category->name}}
                                            <span>({{count($category->articles)}})</span></a>
                                        @endforeach
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle fs-5 text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a href="{{url('/profile')}}" class="dropdown-item">Profile</a>

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
            </div>
        </nav>

        <main class="py-4 bg-light">
            @yield('content')
        </main>

        <footer class="bg-dark text-light py-5">
            <div class="container my-3">
                <div class="row">
                    <div class="col-lg-3 pb-3">
                        <img src="{{ asset('/img/logo/Logo.png') }}" class="float-start me-2" width="50" height="50" alt="logo" style="background-color: transparent;">
                        <h3 class="fw-bold">MY BLOG</h3>
                    </div>
                    <div class="col-lg-3 col-md-4 pb-3">
                        <ul style="list-style: square" class="ps-0">
                            <span class="fw-bold fs-3">About Us</span>
                            <li>This is a practice project of using Laravel Framework.</li>
                            <li>Developed by Novex21.</li>
                            <li>More Features coming...</li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 pb-3">
                        <ul style="list-style: none" class="ps-0">
                            <span class="fw-bold fs-3">Contact Information</span>
                            <li>Phone: +353-588-6644</li>
                            <li>Office Address: Malibu</li>
                            <li>Email: nlinnhtun6@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 pb-3">
                        <ul style="list-style: none" class="ps-0">
                            <span class="fw-bold fs-3">Terms & Conditions</span>
                            <li><a class="text-white" href="#">Legal Stuffs</a></li>
                            <li><a class="text-white" href="#">Privacy Policy</a></li>
                            <li><a class="text-white" href="#">Security</a></li>
                            <li><a class="text-white" href="#">Accessibility</a></li>
                        </ul>
                    </div>
                </div>
                <div class="text-center" >
                    <a href="#" class="me-3" style="text-decoration: none" >
                        <i class="fa-brands fa-facebook fa-xl" style="color: #ffffff;"></i>
                    </a>
                    <a href="#" class="me-3" style="text-decoration: none">
                        <i class="fa-brands fa-instagram fa-xl" style="color: #ffffff;"></i>
                    </a>
                    <a href="#" class="me-3" style="text-decoration: none">
                        <i class="fa-brands fa-linkedin fa-xl" style="color: #ffffff;"></i>
                    </a>
                    <a href="#" class="me-3" style="text-decoration: none">
                        <i class="fa-brands fa-youtube fa-xl" style="color: #ffffff;"></i>
                    </a>
                </div>
                <hr>
                <div class="text-center fs-5">
                    &copy;Copyright to NOVEX21, 2023
                </div>
            </div>


        </footer>
    </div>
</body>
</html>
