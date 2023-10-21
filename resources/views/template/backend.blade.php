<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{ env('WEB_DESKRIPSI') }}">
    <meta name="keywords" content="{{ env('WEB_KEYWORDS') }}">
    <meta name="author" content="{{ env('WEB_AUTHOR') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') | {{ env('WEB_NAMA') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('template/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/ui/prism.min.css') }}">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/vendors/css/forms/select/select2.min.css">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/my_style.css?time=') . time() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/my_sidebar.css?time=') . time() }}">
    @yield('style')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center"></div>
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name">{{ Auth::user()->name }}</span><span class="user-status">{{ Auth::user()->role->nama }}</span></div><span><img class="round" src="{{ asset(Auth::user()->foto) }}" onerror="this.src='{{ asset('img/default.png') }}'" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('profil') }}"><i class="bx bx-user mr-50"></i> Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="event.preventDefault();logout(this);" href="{{ route('login.logout') }}"><i class="bx bx-power-off mr-50"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">{{ env('WEB_NICKNAME') }}</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary-sidebar" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        {{-- <div class="shadow-bottom"></div> --}}
        <div class="main-menu-content">
            @if (Auth::user()->role_id == 1)
                @include('template.sidebarAdmin')
            @elseif (Auth::user()->role_id == 2)
                @include('template.sidebarUsers')
            @endif
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper p-1 p-md-2">
            <div class="content-header row">
                <div class="content-header-left col-12 my-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12 d-block d-md-flex justify-content-between">
                            <h5 class="content-header-title pr-1 mb-0">@yield('header')</h5>
                            <div>@yield('tombol')</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @yield('konten')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">{{ date('Y') }} &copy; {{ env('WEB_AUTHOR') }}</span>
            <span class="float-right d-sm-inline-block d-none">{{ env('WEB_NAMA') }}</span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->

    <div id="modal_custom" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px);">
        <div id="modal_custom_size" class="modal-dialog modal-xl">
            <div style="border: 0;" class="modal-content shadow1">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title mt-0 text-white fw-600">JUDUL</h3>
                    <button type="button" class="close" onclick="$('#modal_custom').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, saepe esse sit nihil aperiam quae porro eveniet in recusandae consequatur reiciendis voluptatibus blanditiis magni! Aliquid ex minima distinctio at quod.
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="modal_custom_2" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, .5);">
        <div id="modal_custom_size_2" class="modal-dialog modal-xl">
            <div style="border: 0;" class="modal-content shadow1">
                <div class="modal-header bg-info">
                    <h3 class="modal-title mt-0 text-white fw-600">JUDUL</h3>
                    <button type="button" class="close" onclick="$('#modal_custom_2').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, saepe esse sit nihil aperiam quae porro eveniet in recusandae consequatur reiciendis voluptatibus blanditiis magni! Aliquid ex minima distinctio at quod.
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        const APP_URL = "{{ env('APP_URL') }}/";
    </script>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('template/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js') }}"></script>
    <script src="{{ asset('template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
    <script src="{{ asset('template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
    <script src="{{ asset('template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('template/app-assets/vendors/js/ui/prism.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('template/app-assets/js/scripts/configs/vertical-menu-light.js') }}"></script>
    <script src="{{ asset('template/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('template/app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- datatable -->
    <script src="{{ asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('template/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/app-assets/js/scripts/datatables/datatable.js') }}"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- select2 -->
    <script src="{{ asset('template') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>

    <script src="{{ asset('assets/my_app.js?time=') . time() }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    </script>
    @yield('script')
</body>
<!-- END: Body-->

</html>
