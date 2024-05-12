<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap core CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css" /> --}}
    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- font awesome --}}
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome"
        href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <style>
        /* select[name=rejected-table_length]:not([size]) {
            background-image: none;
        }

        select[name=accepted-table_length]:not([size]) {
            background-image: none;
        }

        select[name=department-table_length]:not([size]) {
            background-image: none;
        } */

        /* Hide the default scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #e46953;
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #cc1212;
            cursor: pointer;
        }

    </style>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900"
        rel="stylesheet">

        {{-- Check if the current URL contains 'reset-password' --}}
        @if (Str::contains(Request::url(), 'reset-password'))
            <link rel="stylesheet" href="{{ asset(str_replace('reset-password/', '', 'assets/css/templatemo-grad-school.css')) }}">
            <link rel="stylesheet" href="{{ asset(str_replace('reset-password/', '', 'assets/css/owl.css')) }}">
            <link rel="stylesheet" href="{{ asset(str_replace('reset-password/', '', 'assets/css/lightbox.css')) }}">
        @else
            <link rel="stylesheet" href="{{ asset('assets/css/templatemo-grad-school.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
        @endif 
</head>

<body class="font-sans">
    {{-- <h1>{{ Str::contains(Request::url(), 'reset-password') }}</h1> --}}
    {{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div> --}}
    <!--header-->
    <header class="main-header clearfix" role="header">
        <div class="logo">
            <a href="#" class="flex items-center gap-2">
                @if (Str::contains(Request::url(), 'reset-password'))
                    <img class="w-12 h-12" src="{{ asset(str_replace('reset-password/', '', './assets/images/logo.png')) }}" alt="" srcset="">
                @else

                    <img class="w-12 h-12" src="{{ asset('images/logo2.png') }}" alt="" srcset="">
                @endif
                
                <em class="text-[30px]">BITEZONE</em>
            </a>
        </div>
        <a class="menu-link hover:cursor-pointer"><i class="fa fa-bars"></i></a>
        <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="has-submenu">
                    <li><a href="{{ route('login') }}">Login</a></li>
                </li>
                <li><a class="" href="{{ route('register') }}">Register Now</a></li>
            </ul>
        </nav>
    </header>
    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <img id="bg-video" class="mt-21" src="{{ asset('images/bg-5.png') }}" alt="" srcset="">
        {{-- <video autoplay muted loop id="bg-video">
            <source src="assets/images/course-video.mp4" type="video/mp4" />
        </video> --}}

    </section>
    <!-- ***** Main Banner Area End ***** -->
    <main class="flex items-center justify-center">
        <div class="video-overlay header-text grid grid-cols-1 md:grid-cols-2">
            <div class="flex flex-col justify-center items-center mt-29">
                <h6 class="font-bold text-xl md:text-2xl text-red-500">Bitezone Application</h6>
                <h6 class="font-bold text-xl sm:text-md md:text-2xl text-red-500 mt-3">for the</h6>
                <h2 class="mt-1 font-bold text-center text-4xl md:text-6xl text-red-500 uppercase not-italic">Anti-Rabies Program</h2>
                <div class="main-button mt-3">
                    <div class="scroll-to-section"><a href="{{ route('guest') }}" class="b-r hover:cursor-pointer hover:bg-red-800">Guest Access</a></div>
                </div>
            </div>
            <div class="flex justify-center items-center">
                {{ $slot }}
            </div>
        </div>
    </main>

    {{-- @include('popup.requirement') --}}

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/js/bootstrap.min.js"></script>

    @if (Str::contains(Request::url(), 'reset-password'))
        <script src="{{ asset(str_replace('reset-password/', '', 'assets/js/isotope.min.js'))}}"></script>
        <script src="{{ asset(str_replace('reset-password/', '', 'assets/js/owl-carousel.js')) }}"></script>
        <script src="{{ asset(str_replace('reset-password/', '', 'assets/js/lightbox.js')) }}"></script>
        <script src="{{ asset(str_replace('reset-password/', '', 'assets/js/tabs.js')) }}"></script>
        <script src="{{ asset(str_replace('reset-password/', '', 'assets/js/video.js')) }}"></script>
        <script src="{{ asset(str_replace('reset-password/', '', 'assets/js/slick-slider.js')) }}"></script>
        <script src="{{ asset(str_replace('reset-password/', '', 'assets/js/custom.js')) }}"></script>
    @else
        <script src="assets/js/isotope.min.js"></script>
        <script src="assets/js/owl-carousel.js"></script>
        <script src="assets/js/lightbox.js"></script>
        <script src="assets/js/tabs.js"></script>
        <script src="assets/js/video.js"></script>
        <script src="assets/js/slick-slider.js"></script>
        <script src="assets/js/custom.js"></script>
    @endif
    
    <script>
        $(document).ready(function() {
            //according to loftblog tut
            $('.nav li:first').addClass('active');
 
        })
    </script>
</body>


</html>
