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
    <link rel="shortcut icon" href="{{ asset('ww.css/css.admin/assets/media/logos/logo-new.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('ww.css/css.admin/assets/media/logos/logo-new.png') }}"/>

    <link rel="stylesheet" href="{{ asset('ww.css/css.login/vendor/bootstrap-4.5.3/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ww.css/css.login/icons/material-design-icons/css/mdi.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ww.css/css.admin/vendor/fonts/font-awesome-4.7.0/css/font-awesome.css') }}" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('ww.css/css.login/css/latform-style-7.min.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('ww.css/css.admin/dist/css/preload.min.css') }}" />

    @yield('style')
    @livewireStyles
</head>

<body id="kt_body" class="bg-body">

    @include('layouts.preload')

    <div class="form-shape"></div>
    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                    <div class="col d-none d-lg-flex" style="background: url({{ asset('ww.css/css.login/images/cover-login.png') }})">
                        <div class="logo">
                            <img src="{{ asset('ww.css/css.login/images/logo-alm.png') }}" alt="logo">
                        </div>
                        <div>
                            <h3 class="font-weight-bold">Perlindungan yang Amanah dan Terpercaya</h3>
                            <p class="my-5" align="justify"><b>PT. Asuransi Jiwa Syariah AL AMIN</b> merupakan perusahaan asuransi jiwa murni syariah yang menaruh perhatian bagi perkembangan perasuransian di Indonesia khususnya perkembangan dan kebutuhan masyarakat untuk dapat bermuamalah berdasarkan syariah Islam. Pemilihan nama Perusahaan didasarkan atas pertimbangan dan pengetahuan kami mengenai karakteristik industri perasuransian sebagai "bisnis kepercayaan". Komitmen kami untuk memenuhi perjanjian perlindungan asuransi syariah kepada Peserta Yang Diasuransikan dan/atau Pemegang Polis telah menjadi filosofi kami untuk berpegang teguh kepada prinsip-prinsip syariah Islam dan prinsip-prinsp asuransi terutama prinsip utmost good faith. Dengan komitmen kami yang dilandasi oleh itikad baik untuk menjalankan fungsinya dan kegiatan usaha secara sehat sesuai dengan ketentuan yang berlaku telah menjadi konsep dasar yang melatar belakangi nama Perusahaan, yaitu "AL AMIN" yang berarti "Terpercaya".</p>
                        </div>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('ww.css/css.login/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('ww.css/css.login/vendor/bootstrap-4.5.3/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ww.css/css.login/js/latform.min.js') }}"></script>
    <script src="{{ asset('ww.css/css.admin/dist/js/preloader.js') }}"></script>
    @yield('script')
    @livewireScripts
</body>

</html>
