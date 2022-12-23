<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') &raquo; Asuransi Jiwa Syariah AL AMIN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="PT. Asuransi Jiwa Syariah AL AMIN" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Asuransi Syariah" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/logo-new.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/logo-new.png') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/accordion.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/combobox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/combo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/datagrid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/datalist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/dialog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/drawer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/pagination.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/panel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/progressbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/propertygrid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/searchbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/spinner.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/textbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/timepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/tree.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/validatebox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/window.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/default/easyui.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/bootstrap/easyui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/jquery/themes/icon.css') }}"> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/custom/inputpicker/jquery.inputpicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/fontawesome-6.2.0/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/css/custom.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/sweetalert/sweetalert2-custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/css/preload.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('style')
    @livewireStyles
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

    @include('layouts.preload')

    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <a href="{{ route('dashboard') }}">
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo-alamin.png') }}" class="h-30px logo" />
                    </a>

                    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                                <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="aside-menu flex-column-fluid">

                    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">

                        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 main_menu" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

                        @if (Route::has('signin.store'))

                            <div class="menu-item">
                                <a class="menu-link {{ (Request::is('dashboard') or Request::is('dashboard')) ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <span class="menu-icon">
                                        {{-- <i class="fa-solid fa-house"></i> --}}
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">DASHBOARD</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <div class="menu-content pt-8 pb-0">
                                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Main Menu</span>
                                </div>
                            </div>

                            {{-- @if ((count($menulist) > 0))
                                @each('layouts.menu.main', $menulist, 'menu', 'empty')
                            @endif --}}

                            @livewire('utility.menu.main-livewire')
                        @endif

                        </div>

                    </div>

                </div>

            </div>


            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <div id="kt_header" style="" class="header align-items-stretch">

                    <div class="container-fluid d-flex align-items-stretch justify-content-between">

                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">

                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                                    </svg>
                                </span>

                            </div>
                        </div>


                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="../../demo1/dist/index.html" class="d-lg-none">
                                <img alt="Logo" src="{{ asset('assets/media/logos/logo-new.png') }}" class="h-30px" />
                            </a>
                        </div>


                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">

                            <div class="d-flex align-items-stretch" id="kt_header_nav"></div>


                            <div class="d-flex align-items-stretch flex-shrink-0">

                                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">

                                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        @if(file_exists( public_path().'/storage/utility/daftar-user/foto/'.Auth::user()->img_foto ))
                                            <img src="{{ asset('storage/utility/daftar-user/foto/'.Auth::user()->img_foto) }}" alt="user" />
                                        @else
                                            <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="user" />
                                        @endif
                                    </div>

                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-350px" data-kt-menu="true">

                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <div class="symbol symbol-50px me-5">
                                                    @if(file_exists( public_path().'/storage/utility/daftar-user/foto/'.Auth::user()->img_foto ))
                                                        <img src="{{ asset('storage/utility/daftar-user/foto/'.Auth::user()->img_foto) }}" alt="user" />
                                                    @else
                                                        <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="user" />
                                                    @endif
                                                </div>

                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                                        {{ Auth::user()->name }}
                                                        <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2"></span>
                                                    </div>
                                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->email_user }}</a>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="separator my-2"></div>

                                        <div class="menu-item px-5">
                                            <a href="../../demo1/dist/account/overview.html" class="menu-link px-5">My Profile</a>
                                        </div>

                                        <div class="menu-item px-5 my-1">
                                            <a href="../../demo1/dist/account/settings.html" class="menu-link px-5">Account Settings</a>
                                        </div>

                                        <div class="separator my-2"></div>

                                        <div class="menu-item px-5">
                                            <div class="menu-content px-5">
                                                <a href="{{ route('signout') }}" class="btn btn-danger d-block" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Sign Out') }}</a>
                                                <form id="logout-form" action="{{ route('signout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <div class="toolbar" id="kt_toolbar">

                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">

                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>

                                {{-- <span class="h-20px border-gray-300 border-start mx-4"></span>
                                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                                    </li>
                                    <li class="breadcrumb-item text-muted">Pages</li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                                    </li>
                                    <li class="breadcrumb-item text-dark">Our Team</li>
                                </ul> --}}
                            </div>

                            {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                                <div class="m-0">

                                    <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                                            </svg>
                                        </span>
                                        Filter
                                    </a>

                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_6207935a99e56">
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                        </div>

                                        <div class="separator border-gray-200"></div>
                                        <div class="px-7 py-5">
                                            <div class="mb-10">
                                                <label class="form-label fw-bold">Status:</label>
                                                <div>
                                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_6207935a99e56" data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-10">
                                                <label class="form-label fw-bold">Member Type:</label>
                                                <div class="d-flex">
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label fw-bold">Notifications:</label>
                                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="../../demo1/dist/.html" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>

                            </div> --}}
                        </div>
                    </div>

                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">

                            @yield('content')

                        </div>
                    </div>
                </div>

                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">

                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">

                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2022©</span>
                            <a href="https://almin.co.id" target="_blank" class="text-gray-800 text-hover-primary">PT. Asuransi Jiwa Syariah AL AMIN</a>
                        </div>

                        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            <li class="menu-item">
                                <a href="https://almin.co.id" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" target="_blank" class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" target="_blank" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>

                    </div>

                </div>

            </div>

        </div>

		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
		</div>

    </div>


    <script>var hostUrl = "assets/";</script>
    <script src="{{ asset('dist/js/jquery-3.6.1.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/custom/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/jquery/jquery.easyui.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/custom/inputpicker/jquery.inputpicker.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/datatables-serverside.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/global/formjs/formToJson.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/pdf-view/pdf.min.js') }}"></script>
    <script src="{{ asset('dist/js/preloader.js') }}"></script>
    <script src="{{ asset('dist/js/jquery-config.min.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.capitalize.js') }}"></script>

    <script>
        $('.menu-title').capitalize();
    </script>
    @yield('script')
    @livewireScripts
</body>
</html>
