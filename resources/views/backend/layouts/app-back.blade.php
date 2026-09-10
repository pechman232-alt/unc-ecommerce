<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ $SITE_NAMES->value }}</title>
    <meta name="description" content="UNC Computer" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/logos/'.$SITE_ICONS->value) }}" />

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
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>
    <script src="{{ url('/jquery/jquery.min.js') }}"></script>

    <link href="{{ asset('/datatable/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ url('/datatable/datatables.min.js') }}"></script>

    <script src="{{ url('/jquery/ckeditor.js') }}"></script>
</head>

    <style>
        .btn-group .btn-outline-secondary {
            padding: 0.3rem 0.6rem !important;
        }
    </style>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('backend.layouts.navbar')
            <div class="layout-page">
                @include('backend.layouts.header')
                <div class="content-wrapper">

                    @yield('content')

                </div>
                @include('backend.layouts.footer')
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('backend/assets/js/dashboards-analytics.js') }}"></script>

    <script async defer src="{{ url('/jquery/buttons.js') }}"></script>

    <script>
        function checkSessionExpiration() {
        // Make an AJAX request to the server to check if the session is still active
            $.ajax({
                url: "{{ url('check-session') }}",
                method: 'GET',
                success: function(response) {
                    if (response.session_expired) {
                        // Session has expired, perform logout action
                        logout();
                    } else {
                        // Session still active, reset timer
                        setTimeout(checkSessionExpiration, 60000); // Check every minute
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error checking session status:', error);
                }
            });
        }

        // Function to perform logout action
        function logout() {
            // Redirect the user to the login page or perform other logout actions
            window.location.href = "{{ url('logout') }}";
        }

        // Start checking session expiration
        checkSessionExpiration();
    </script>

</body>

</html>
