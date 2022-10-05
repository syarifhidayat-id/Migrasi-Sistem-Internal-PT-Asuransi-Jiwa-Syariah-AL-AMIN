<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'PT. Asuransi Jiwa Syariah AL AMIN') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="PT. Asuransi Jiwa Syariah AL AMIN" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/logo-new.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/logo-new.png') }}"/>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/css/preload.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="bg-body">

    @include('layouts.preload')

    {{-- <div id="app"> --}}
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="/">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                    <form class="d-flex">
                        <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav> --}}

        <div class="d-flex flex-column flex-root">

            <div class="d-flex flex-column flex-lg-row flex-column-fluid">

                <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #171f30">

                    <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">

                        <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">

                            <a href="/" class="py-9 mb-5">
                                <img alt="Logo" src="{{ asset('assets/media/logos/logo-new.png') }}" class="h-60px" />
                            </a>

                            <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #fff;">Welcome to Al-Amin</h1>

                            {{-- <p class="fw-bold fs-2" style="color: #986923;">Discover Amazing Metronic
                            <br />with great build tools</p> --}}

                            <p style="color: #fff;">Selamat datang di Official Website Online kami. Website ini berfungsi untuk melayani Semua Rekanan, Pemegang polis dan Kantor Cabang Pemasaran <br>PT. Asuransi Jiwa Syariah AL AMIN, adapun kemudahan yang di berikan dengan Website ini antara lain :  Kemudahan Pengajuan Peserta Asuransi, Pendaftaran Agen Asuransi, Pengajuan Klaim, Download Polis Asuransi,Tanya/Jawab tentang Produk Asuransi, Laporan Kepesertaan Asuransi dan Lain-lain. Jika ingin mendapatkan informasi lebih tentang kami, silahkan Email kami ke  alamat tanya@alamin.co.id atau Whatsapp di nomor 081-222-999-109.</p>

                        </div>

                        {{-- <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({{ asset('assets/media/illustrations/sketchy-1/13.png') }})"></div> --}}

                    </div>

                </div>

                <div class="d-flex flex-column flex-lg-row-fluid py-10">
                    <div class="d-flex flex-center flex-column flex-column-fluid">
                        <div class="w-lg-500px p-10 p-lg-15 mx-auto" id="kt_body">
                            @yield('content')
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                        <div class="d-flex flex-center fw-bold fs-6">
                            <a href="#" class="text-muted text-hover-primary px-2" target="_blank">About</a>
                            <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
                            <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- </div> --}}

    {{-- <script src="{{ asset('dist/js/jquery-3.6.1.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/bootstrap-4.6.2/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('dist/js/preloader.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/password-reset/password-reset.js') }}"></script> --}}
</body>

</html>
