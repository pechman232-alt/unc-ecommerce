<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $SITE_NAMES->value }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/logos/' . $SITE_ICONS->value) }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/pages/page-misc.css') }}" />

    <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>
</head>

<style>
    .btn-primary {
        color: #fff;
        background-color: #CE181E;
        border-color: #CE181E;
        box-shadow: none;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: orange;
        border-color: orange;
        transform: translateY(-1px);
    }

    #clock{
      width: 100%;
      font-size: 4vw;
      font-weight: 500;
      color: #566a7f;
      text-align: center;
      font-family: 'Kantumruy Pro';
  }
</style>

<body onload="realtimeClock()">

    <!--Under Maintenance -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">Coming Soon!</h2>
            <div id="clock"></div>
            <div class="mt-4">
                <img src="{{ asset('backend/assets/img/illustrations/girl-doing-yoga-light.png') }}"
                    alt="girl-doing-yoga-light" width="500" class="img-fluid"
                    data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
                    data-app-light-img="illustrations/girl-doing-yoga-light.png" />
            </div>
        </div>
    </div>

    <script>
        function realtimeClock() {
    
            var rtClock = new Date();

            var hours = rtClock.getHours();
            var minutes = rtClock.getMinutes();
            var seconds = rtClock.getSeconds();

            var amPm = ( hours < 12 ) ? "AM" : "PM";

            hours = (hours > 12) ? hours - 12 : hours;

            hours = ("0" + hours).slice(-2);
            minutes = ("0" + minutes).slice(-2);
            seconds = ("0" + seconds).slice(-2);

            document.getElementById('clock').innerHTML = 
                hours + "  :  " + minutes + "  :  " + seconds + " " + amPm;
            var t = setTimeout(realtimeClock, 500);

        }
    </script>

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
