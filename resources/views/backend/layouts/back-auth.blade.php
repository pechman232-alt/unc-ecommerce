<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $SITE_NAMES->value }}</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ url('/logos/' . $SITE_ICONS->value) }}" />

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
     {{-- EndFont --}}
    
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>

    <style>
        .btn-red {
            color: #fff;
            line-height: 2.5;
            background-color: {{ $mainColor }};
            border-color: {{ $mainColor }};
            /* box-shadow: 0 0.125rem 0.25rem 0 rgba(105, 108, 255, 0.4); */
        }

        .btn-red:hover {
            color: #fff;
            background-color: #FAA61A;
            border-color: #FAA61A;
            transform: translateY(-1px);
        }

        .form-control {
            line-height: 2.5;
        }
    </style>

</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                @include('alert')

                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('backend/assets/img/logo/logoUNC.png') }}" alt=""
                                        width="135px" style="padding-top: 35px; padding-bottom: 20px;">
                                </span>
                            </a>
                        </div>
                        <h4 class="mb-2">Welcome to UNC Computer</h4>
                        <p class="mb-4">Unicorn Technology Center</p>

                        <form id="formAuthentication" class="mb-3" action="{{ url('admin-login') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}"
                                    placeholder="username" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3" style="padding-top: 25px">
                                <button class="btn btn-red d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
