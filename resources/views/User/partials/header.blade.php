<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Maak Services</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('user/assets')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('user/assets')}}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset('user/assets')}}/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{asset('user/assets')}}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{asset('user/assets')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{asset('user/assets')}}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Tailwind (IMPORTANT) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Main CSS File -->
    <link href="{{asset('user/assets')}}/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Clinic
  * Template URL: https://bootstrapmade.com/clinic-bootstrap-template/
  * Updated: Jul 23 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header fixed-top">



        <div class="branding d-flex align-items-cente">

            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="{{asset('user/assets')}}/img/logo.webp" alt=""> -->
                    <h1 class="sitename">Maak</h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul class="flex items-center gap-1">

                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('about') }}">About</a></li>
                        <li><a href="{{ url('hospitals') }}">Hospitals</a></li>
                        @auth

                        {{-- CUSTOMER NAV --}}
                        @if(Auth::user()->role === 'customer')

                        <li>
                            <a href="{{ url('services') }}">Services</a>
                        </li>

                        <li>
                            <a href="{{ route('my.bookings') }}">My Bookings</a>
                        </li>

                        {{-- CAREGIVER NAV --}}
                        @elseif(Auth::user()->role === 'caregiver')

                        <li>
                            <a href="{{ route('caregiver.bookings') }}">
                                My Bookings
                            </a>
                        </li>

                        @endif

                        @endauth

                        {{-- GUEST --}}
                        @guest
                        <li>
                            <a href="{{ url('services') }}">Services</a>
                        </li>
                        @endguest
                        <li><a href="{{ url('contact') }}">Contact</a></li>

                        @auth
                        <li class="dropdown">
                            <a href="#">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>

                            <ul>
                                <li>
                                    <a href="{{ route('profile') }}">Profile</a>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit"
                                            style="border: none; background: none; padding: 10px 20px; width: 100%; text-align: left;color:red;">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endauth

                        @guest
                        <li>
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">
                                Log in
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-gray-900">
                                Register
                            </a>
                        </li>
                        @endguest

                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>

        </div>

    </header>