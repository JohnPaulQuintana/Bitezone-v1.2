<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900"
        rel="stylesheet">
    <title>{{ config('app.name') }}</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Additional CSS Files -->
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome"
        href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-grad-school.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">

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
            background: #e7291b;
            cursor: pointer;
        }

    </style>
</head>

<body>


    <!--header-->
    <header class="main-header clearfix" role="header">
        <div class="logo">
            <a href="#" class="flex items-center gap-2">
                <img class="w-12 h-12" src="{{ asset('images/logo2.png') }}" alt="" srcset="">
                <em class="text-[30px]">BITEZONE</em>
            </a>
        </div>
        <a class="menu-link hover:cursor-pointer"><i class="fa fa-bars"></i></a>
        <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('login') }}">Login</a>
                    {{-- <ul class="sub-menu">
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>

                    </ul> --}}
                </li>
                <li><a class="" href="{{ route('register') }}">Register Now</a></li>
            </ul>
        </nav>
    </header>

    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <img class="mt-21" id="bg-video" src="{{ asset('images/Pet-PNG-File.png') }}" alt="">
        {{-- <video autoplay muted loop id="bg-video">
            <source src="assets/images/course-video.mp4" type="video/mp4" />
        </video> --}}

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Bitezone Application</h6>
                <h6 class="mt-3">for the</h6>
                <h2 class="mt-0"><em>Anti-Rabies Program</em> </h2>
                <div class="main-button">
                    <div class="scroll-to-section"><a href="{{ route('guest') }}" class="b-r hover:cursor-pointer">Guest Access</a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> Copyright 2024 by BITEZONE

                    </p>
                </div>
            </div>
        </div>
    </footer>

    {{-- @include('popup.requirement') --}}
    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/js/bootstrap.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            //according to loftblog tut
            $('.nav li:first').addClass('active');

        })
    </script>
</body>

</html>
