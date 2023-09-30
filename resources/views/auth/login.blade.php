<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="{{ env('WEB_DESKRIPSI') }}">
    <meta name="keywords" content="{{ env('WEB_KEYWORDS') }}">
    <meta name="author" content="{{ env('WEB_AUTHOR') }}">
    <title>{{ $title }} | {{ env('WEB_NAMA') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('template') }}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template') }}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/assets/css/style.css">
    <!-- END: Custom CSS-->
    <style>
        @media screen and (max-width: 450px) {
            /* html body.blank-page .content-wrapper .flexbox-container {
                height: 65vh !important;
            } */
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <div class="text-center d-block d-md-none">
                                                    <img src="{{ asset('img/bg-login.jpg') }}" style="width: 100px;" alt="foto header" class="rounded-circle mb-1">
                                                </div>
                                                <h4 class="text-center mb-2">LOGIN - {{ env('WEB_NAMA') }}</h4>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p>
                                                <small> Masukkan username dan password sesuai akun anda</small>
                                            </p>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form action="#" method="POST" onsubmit="event.preventDefault();doSubmit(this);">
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">Username</label>
                                                        <input type="text" class="form-control" placeholder="Username" name="username">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="text-bold-600">Password</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-transparent" id="showPassword" onclick="showPassword();"><i class="fa fa-eye-slash"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary glow position-relative w-100">LOGIN<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                                {{-- <hr> --}}
                                                {{-- <div class="text-center"><small class="mr-25">Belum punya akun?</small><a href="#"><small>Daftar disini</small> </a></div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- image section right -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <img class="img-fluid rounded" src="{{ asset('img/bg-login.jpg') }}" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- register section endss -->
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <script>
        const APP_URL = "{{ env('APP_URL') }}/";
    </script>

    <script src="{{ asset('template') }}/app-assets/vendors/js/vendors.min.js"></script>
    <script src="{{ asset('template') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="{{ asset('template') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="{{ asset('template') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>

    <script src="{{ asset('template') }}/app-assets/js/scripts/configs/vertical-menu-light.js"></script>
    <script src="{{ asset('template') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('template') }}/app-assets/js/core/app.js"></script>
    <script src="{{ asset('template') }}/app-assets/js/scripts/components.js"></script>
    <script src="{{ asset('template') }}/app-assets/js/scripts/footer.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function doSubmit(dt) {
            $.ajax({
                type: "POST",
                url: "{{ route('login.store') }}",
                data: new FormData(dt),
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: function(res) {
                    Swal.fire({
                        title: 'Loading ...',
                        html: '<i style="font-size:25px;" class="fa fa-spinner fa-spin"></i>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                error: function(res) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal',
                        text: res.responseJSON.msg ?? res.responseJSON.message,
                        showConfirmButton: true,
                    })
                },
                success: function(res) {
                    Swal.fire({
                            icon: 'success',
                            title: 'Login Berhasil',
                            showConfirmButton: true,
                        })
                        .then(() => {
                            location.href = res.link;
                        })
                }
            });
        }

        var counter = 1;

        function showPassword() {
            if (counter % 2 == 0) {
                $('#showPassword').html('<i class="fa fa-eye-slash"></i>');
                $('#password').attr('type', 'password');
            } else {
                $('#showPassword').html('<i class="fa fa-eye"></i>');
                $('#password').attr('type', 'text');
            }
            counter++;
        }
    </script>

</body>

</html>
