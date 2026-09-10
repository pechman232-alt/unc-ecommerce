<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $SITE_NAMES->value }}</title>
    <meta name="description" content="UNC Technology">
    <link rel="icon" type="image/x-icon" href="{{ asset('/logos/' . $SITE_ICONS->value) }}" />
    
    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--<link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">-->
    {{-- EndFont --}}


    <!--<link rel="stylesheet" href="{{ asset('/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">-->
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/plugins/owl-carousel/owl.carousel.css') }}">

    <!--<link rel="stylesheet" href="{{ asset('/assets/css/plugins/jquery.countdown.css') }}">-->
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/skins/skin-demo-4.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/demos/demo-4.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/plugins/magnific-popup/magnific-popup.css') }}">

    {{-- Item Slider --}}
    <link rel='stylesheet' href="{{ asset('/item-slide-style/slick.css') }}">
    <!--<link rel='stylesheet' href="{{ asset('/item-slide-style/style.css') }}">-->


    <script src="{{ url('jquery/jquery.min.js') }}"></script>

    <style>
        .header-4 .header-bottom {
            background-color: {{ $mainColor }};
        }

        .footer {
            background-color: {{ $mainColor }};
        }

        .header-4.header-intro-clearance .header-search .header-search-wrapper {
            border-color: {{ $mainColor }};
            border-radius: 10px;
        }

        .header-4 .header-search-extended .btn {
            background-color: {{ $mainColor }};
            color: #fff;
            border-bottom-right-radius: 10px;
            border-top-right-radius: 10px;

        }

        .li.active>a {
            color: #fff;
        }

        .owl-theme.owl-light .owl-nav [class*='owl-']{
            border-color: {{ $mainColor }};
            background-color: {{ $mainColor }};
            color: white;
        }

        .owl-theme.owl-light .owl-nav [class*='owl-']:not(.disabled):hover {
            border-color: orange;
        }

        .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-'] {
            border: none;
            font-size: 3rem;
            color: #fff
        }

        .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-']:hover,
        .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-']:focus {
            color: #c96;
            background-color: transparent
        }

        .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-'] {
            border: none;
            font-size: 3rem;
            color: #fff;
        }

        .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-']:hover,
        .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-']:focus {
            color: {{ $mainColor }};
            background-color: transparent
        }

        .owl-theme.owl-light .owl-nav [class*='owl-']:hover {
            background-color: orange;
        }

        .uppercase-text {
            text-transform: uppercase;
        }

        .footer-copyright {
            color: #ffbcbc;
            font-size: 1.3rem;
        }

        .blog-posts .owl-stage .owl-item {
            background: #f7f7f7;
            border: 1px solid #ececec;
            padding: 12px;
        }

        @media only screen and (max-width: 991px) {
            .logo {
                margin-top: 0;
                margin-bottom: 0;
                width: 220px;
                margin-left: 10px;
            }
        }

        .cls_btn_search {
            background-color: {{ $mainColor }};
            color: #fff;
            border-bottom-right-radius: 10px;
            border-top-right-radius: 10px;
        }

        .mobile-menu-light .mobile-search .form-control {
            border-color: #e5e5e5;
            border-bottom-left-radius: 10px;
            border-top-left-radius: 10px;
        }

        .mobile-menu-light .mobile-search .form-control:focus {
            border-color: {{ $mainColor }};
        }

        .mobile-cats-lead {
            text-transform: uppercase;
            color: {{ $mainColor }} !important;
        }

        .owl-theme.owl-light .owl-dots .owl-dot.active span {
            border-color: #fff;
            background: {{ $mainColor }};
        }

        @media only screen and (max-width: 425px) and (min-width: 376px) {
            .blog-posts .entry {
                font-size: 1.3rem !important;
            }

            .blog-posts .entry-title {
                font-size: 1.6rem !important;
            }

            .title {
                font-size: 2.0rem !important;
            }

            .blog-posts .entry {
                font-size: 1.3rem !important;
            }

            .footer .widget-title {
                font-size: 1.5rem !important;
            }

            .footer {
                font-size: 1.2rem !important;
            }

            .footer-copyright {
                font-size: 1.1rem !important;
            }

            .entry-content p {
                font-size: 1.1rem !important;
            }
        }

        @media only screen and (max-width: 375px) {
            .blog-posts .entry {
                font-size: 1.2rem !important;
            }

            .blog-posts .entry-title {
                font-size: 1.4rem !important;
            }

            .title {
                font-size: 1.8rem !important;
            }

            .blog-posts .entry {
                font-size: 1.1rem !important;
            }

            .footer .widget-title {
                font-size: 1.3rem !important;
                margin-bottom: 1.5rem;
            }

            .footer {
                font-size: 1.1rem !important;
            }

            .footer-copyright {
                font-size: 1.0rem !important;
            }

            .entry-content p {
                font-size: 1.05rem !important;
            }

            .widget-list li:not(:last-child) {
                margin-bottom: 0.1rem;
            }
        }

        .slide-item:hover {
            box-shadow: 10px 10px 5px -8px rgba(28, 27, 27, 0.23);
            -webkit-box-shadow: 10px 10px 5px -8px rgba(28, 27, 27, 0.23);
            -moz-box-shadow: 10px 10px 5px -8px rgba(28, 27, 27, 0.23);
        }

        .cls_myStyle:last-child {
            margin-right: -300px !important;
        }

        .cls_myStyle nav {
            margin-right: 1.5rem;
        }

        .cls_myStyle nav:last-child {
            margin-right: 0rem;
        }

        .fab-container {
            position: fixed;
            bottom: 25px;
            left: 24px;
            cursor: pointer;
        }

        .iconbutton {
            width: 50px;
            height: 50px;
            border-radius: 100%;
            background: #FF4F79;
        }

        .button {
            width: 60px;
            height: 60px;
            background: white;
            border-style: solid;
            border-color: orange;
        }

        .iconbutton i{
            display:flex;
            align-items:center;
            justify-content:center;
            height: 100%;
            color:orange;
            font-size: 20px;
            
        }

        .options{
            list-style-type: none;
            position:absolute;
            bottom: 50px;
            **right:0;**
        }

        .options li{
            display:flex;
            justify-content:flex-end;
            padding-left: 6px;
            padding-top: 5px;
        }

        .inner-fabs.show + .fab-container:hover .button {
            transform: rotate(135deg);
        }

        /* .fab-container:hover .button {
            transform: rotate(135deg);
        } */

        /* ----------------------------- */

        .fab-wrapper {
            position: fixed;
            bottom: 3rem;
            left: 7rem;
            z-index: 1 !important;
        }

        .fab-checkbox {
            display: none;
        }

        .fab {
            position: absolute;
            bottom: -1rem;
            right: -1rem;
            width: 5rem;
            height: 5rem;
            /* background: orange; */
            border-radius: 50%;
            background: orange;
            /* box-shadow: 0px 5px 20px orange; */
            transition: all 0.3s ease;
            z-index: 1;
            border-bottom-right-radius: 6px;
            border: 1px solid orange;
        }

        .fab:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .fab-checkbox:checked ~ .fab:before {
            width: 90%;
            height: 90%;
            left: 5%;
            top: 5%;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .fab:hover {
            background: rgb(231, 151, 1);
            /* box-shadow: 0px 5px 20px 5px rgb(202, 132, 1); */
        }

        .fab-dots {
            position: absolute;
            height: 5px;
            width: 5px;
            background-color: white;
            border-radius: 50%;
            top: 50%;
            transform: translateX(0%) translateY(-50%) rotate(0deg);
            opacity: 1;
            animation: blink 3s ease infinite;
            transition: all 0.3s ease;
        }

        .fab-dots-1 {
            left: 15px;
            animation-delay: 0s;
        }

        .fab-dots-2 {
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            animation-delay: 0.4s;
        }

        .fab-dots-3 {
            right: 15px;
            animation-delay: 0.8s;
        }

        .fab-checkbox:checked ~ .fab .fab-dots {
            height: 6px;
        }

        .fab .fab-dots-2 {
            transform: translateX(-50%) translateY(-50%) rotate(0deg);
        }

        .fab-checkbox:checked ~ .fab .fab-dots-1 {
            width: 30px;
            border-radius: 10px;
            left: 50%;
            transform: translateX(-50%) translateY(-50%) rotate(45deg);
        }
        
        .fab-checkbox:checked ~ .fab .fab-dots-3 {
            width: 30px;
            border-radius: 10px;
            right: 50%;
            transform: translateX(50%) translateY(-50%) rotate(-45deg);
        }

        @keyframes blink {
            50% {
                opacity: 0.25;
            }
        }

        .fab-checkbox:checked ~ .fab .fab-dots {
            animation: none;
        }

        .fab-wheel {
            position: absolute;
            bottom: 0;
            right: 0;
            border: 1px solid #;
            width: 10rem;
            height: 10rem;
            transition: all 0.3s ease;
            transform-origin: bottom right;
            transform: scale(0);
        }

        .fab-checkbox:checked ~ .fab-wheel {
            transform: scale(1);
        }

        .fab-action {
            position: absolute;
            /* background: #0f1941; */
            background: radial-gradient(circle farthest-corner at 25% 98%, #0078ff 5%, #4b69ff 25%, #af37f0 55%, #ff557d 78%, #fa696e 83%);
            width: 5rem;
            height: 5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: White;
            /* box-shadow: 0 0.1rem 1rem rgba(24, 66, 154, 0.82); */
            transition: all 1s ease;
            opacity: 0;
        }


        .fab-checkbox:checked ~ .fab-wheel .fab-action {
            opacity: 1;
        }

        .fab-action:hover {
            background-color: #f16100;
        }

        .fab-wheel .fab-action-1 {
            left: 60px;
            bottom: 80px;
        }

        .fab-wheel .fab-action-2 {
            left: 60px;
            bottom: 140px;
        }

        #scroll-top {
            background: orange !important;
            color: white !important;
            border-radius: 50px !important;
            font-size: 2rem !important;
        }

        #scroll-top:hover {
            background: rgb(223, 146, 2) !important
        }

        /* My Custome */
        @media only screen and (max-width: 430px){
            .ml-5 {
                margin-left: 0rem !important;
            }

            .mt-5 {
                margin-top: 0rem;
            }

            .title {
                font-size: 2.0rem !important;
            }

            .card-body p {
                font-size: 1.2rem;
            }

            .fab {
                width: 5rem;
                height: 5rem;
            }

            .fab-dots {
                width: 5px;
                height: 5px;
            }

            .fab-wrapper {
                bottom: 2rem;
                left: 6rem;
            }

            .product-gallery {
                margin-bottom: 0rem;
            }

            .card-title {
                font-size: 1.2rem !important;
            }

            .sidebar {
                margin-top: 0rem;
            }

        }

        @media only screen and (max-width: 375px){
            .ml-5 {
                margin-left: 0rem !important;
            }

            .title {
                font-size: 2.0rem !important;
            }
            .product-details .product-cat {
                font-size: 1.2rem !important;
            }

            .entry-title {
                font-size: 1.4rem !important;
            }

            .card-body p {
                font-size: 1.1rem;
            }

            .card-title {
                font-size: 1.1rem !important;
            }

        }


        @media only screen and (max-width: 360px){
            .ml-5 {
                margin-left: 0rem !important;
            }

            .title {
                font-size: 2.0rem !important;
            }
            .product-details .product-cat {
                font-size: 1.2rem !important;
            }

            .entry-title {
                font-size: 1.4rem !important;
            }

            .card-body p {
                font-size: 0.9rem;
            }

            .card-title {
                font-size: 1rem !important;
            }

            .cls_price {
                font-size: 1.2rem;
            }

        }

        @media only screen and (max-width: 320px){
            .ml-5 {
                margin-left: 0rem !important;
            }

            .title {
                font-size: 2.0rem !important;
            }
            .product-details .product-cat {
                font-size: 1.2rem !important;
            }

            .entry-title {
                font-size: 1.1rem !important;
            }

            .card-body p {
                font-size: 0.8rem;
            }

            .card-title {
                font-size: 0.9rem !important;
            }

        }

        .mobile-cats-menu {
            color: orange !important;
        }

        .mobile-cats-menu a:hover {
            color: orange !important;
        }

    </style>
</head>

<body>
    <div class="page-wrapper">
        @include('frontend.layouts.header')
        @yield('content')
        @include('frontend.layouts.footer')
    </div>

    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    {{-- Chart Messenger and Telegram --}}
    
    <div class="fab-wrapper">
        <input id="fabCheckbox" type="checkbox" class="fab-checkbox"/>
        <label class="fab" for="fabCheckbox">
            <span class="fab-dots fab-dots-1"></span>
            <span class="fab-dots fab-dots-2"></span>
            <span class="fab-dots fab-dots-3"></span>
        </label>

        <div class="fab-wheel">
            <div class="fab-action fab-action-1">
                <a href="{{ $SITE_LINK_TELEGRAM->link }}">
                    <svg style="width: 50px; height:50px;" enable-background="new 0 0 24 24" height="512"
                        viewBox="0 0 24 24" width="512">
                        <circle cx="12" cy="12" fill="#039be5" r="12"></circle>
                        <path
                            d="m5.491 11.74 11.57-4.461c.537-.194 1.006.131.832.943l.001-.001-1.97 9.281c-.146.658-.537.818-1.084.508l-3-2.211-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953z"
                            fill="#fff"></path>
                    </svg>
                </a>
            </div>

            <div class="fab-action fab-action-2">
                <a href="{{ $SITE_LINK_CHAT->link }}">
                    <svg style="width: 50px; height:50px;" viewBox='10 6 1000 1024' height="512">
                        <path id='lightning' d='M213.6,634.6l146-231.6c23.2-36.8,73-46,107.8-19.9l116.1,87.1c10.7,8,25.3,7.9,35.9-0.1
                        l156.8-119c20.9-15.9,48.3,9.2,34.2,31.4L664.5,614c-23.2,36.8-73,46-107.8,19.9l-116.1-87.1c-10.7-8-25.3-7.9-35.9,0.1L247.8,666
                        C226.9,681.9,199.5,656.8,213.6,634.6z' fill='#fff' />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    {{-- End Chart Messenger and Telegram --}}

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                
                    <label for="q" class="sr-only">Search</label>
                    <input type="text" class="form-control" name="myInputSearchMobile" id="myInputSearchMobile" placeholder="Search product ..." autocomplete="off" required>
                    <button class="btn cls_btn_search" type="submit"><i class="icon-search"></i></button>

                <div id="myDropdownMobile" class="dropdown-content-mobile search-wrapper-wide">
                </div>
                
                <style>
                    .dropdown-content-mobile {
                        position: absolute;
                        display: inline-block;
                        top: 90px;
                        left: 22px;
                    }

                    .dropdown-content-mobile {
                        display: none;
                        position: absolute;
                        background-color: #fff;
                        min-width: 230px;
                        overflow: auto;
                        border: 1px solid #ddd;
                        z-index: 2;
                    }

                    .dropdown-content-mobile a {
                        color: black;
                        padding: 12px 16px;
                        text-decoration: none;
                        display: block;
                        font-size: 12px;
                    }

                    .dropdown-content-mobile a:hover {
                        background-color: rgba(255, 99, 71, 0.08);
                    }

                    .show {
                        display: block;
                    }

                    #no_pro {
                        text-align: center;
                        padding-top: 8px;
                        padding-bottom: 8px;
                        font-size: 11px;
                        background-color: #f2f2f2;
                        font-weight: bold;
                    }

                    #myDropdownMobile {
                        border-radius: 0 0 10px 10px;
                    }

                    #cls_search_title {
                        padding-top: 5px;
                        padding-bottom: 5px;
                        font-size: 10px;
                        background-color: #f2f2f2;
                        padding-left: 15px;
                    }

                    .padding_left_mobile {
                        line-height: 0px;
                        padding-left: 0;
                    }

                    .cls_price_mobile {
                        color: #CE181E;
                        font-size: 1rem;
                        display: inline;
                    }

                    .cls_price_mobile b {
                        font-weight: 600;
                    }

                    .padding_left_mobile h6 {
                        font-size: 1.1rem;
                    }

                </style>
            </form>

            <div class="tab-content">
                <div class="tab-pane fade  show active" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            @foreach ($SITE_MENUS as $SITE_MENU)
                                <li>
                                    <a class="{{ request()->is('pages/*') && decrypt(session()->get('activeMenuId')) == $SITE_MENU->id  ? 'mobile-cats-menu' : '' }}" href="{{ url('pages', encrypt($SITE_MENU->id)) }}">{{ $SITE_MENU->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>    
            </div>
            
            <div class="social-icons" style="margin-bottom: 15px">
                <ul class="nav">
                    @foreach ($GET_ABOUT_US as $item)
                        <li style="margin-right: 15px;"><a href="{{ url('page', encrypt($item->id)) }}" style="color: black">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div> --}}
            
        </div>

    </div>

    <!-- onChangeSearchMobile -->
    <script>

        var typingTimer;                //timer identifier
        var doneTypingInterval = 500;  //time in ms, 5 seconds for example
        var $input = $('#myInputSearchMobile');

        //on keyup, start the countdown
        $input.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(onChangeSearchMobile, doneTypingInterval);
        });

        //on keydown, clear the countdown 
        $input.on('keydown', function () {
        });

        function onChangeSearchMobile() {
            var searchValue = document.getElementById("myInputSearchMobile");

            if (searchValue.value != "") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ url('search-product') }}",
                    dataType: "json",
                    data: {
                        searchVal: searchValue.value
                    },
                    success: function(data) {
                        var option = "";
                        $('#myDropdownMobile').empty();
                        if (data.length > 0) {
                            option = `<p id="cls_search_title">Search Result:</p>`;
                            for (var i = 0; i < data.length; i++) {
                                var price1 = data[i]['price_after_discount'] == null ? "$" + data[i][
                                    'original_price'
                                ] : "$" + data[i]['price_after_discount'];
                                var price2 = data[i]['price_after_discount'] != null ? "$" + data[i][
                                    'original_price'
                                ] : '';
                                option += `<a href="{{ url('product-detail/') }}/` + data[i]['id_en'] + `">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="{{ url('/productImages') }}/` + data[i]['thumbnail'] + `" width="55">
                                        </div>
                                        <div class="col-10 padding_left_mobile">
                                            <h6>` + data[i]['product_name'] + `</h6>
                                            <div>Price: 
                                                <p class="cls_price_mobile">
                                                    <b>` + price1 + `</b>
                                                    <s>` + price2 + `</s>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>`;
                            }
                            document.getElementById("myDropdownMobile").className += " show";
                            $('#myDropdownMobile').append(option);
                        } else {
                            $('#myDropdownMobile').empty();
                            document.getElementById("myDropdownMobile").className += " show";
                            option = '<p id="no_pro">No Product Found!</p>';
                            $('#myDropdownMobile').append(option);
                        }
                    }

                });
            } else {
                $('#myDropdownMobile').empty();
            }
        }
    </script>
    <!-- End onChangeSearch -->

    <!-- Plugins JS File -->
    <!--<script src="{{ url('/assets/js/jquery.min.js') }}"></script>-->
    <script src="{{ url('/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--<script src="{{ url('/assets/js/jquery.hoverIntent.min.js') }}"></script>-->
    <script src="{{ url('/assets/js/jquery.waypoints.min.js') }}"></script>
    <!--<script src="{{ url('/assets/js/superfish.min.js') }}"></script>-->
    <script src="{{ url('/assets/js/owl.carousel.min.js') }}"></script>
    <!--<script src="{{ url('/assets/js/bootstrap-input-spinner.js') }}"></script>-->
    <!--<script src="{{ url('/assets/js/jquery.plugin.min.js') }}"></script>-->
    <!-- delete -->
    <!--<script src="{{ url('/assets/js/jquery.countdown.min.js') }}"></script>-->
    <script src="{{ url('/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('/assets/js/jquery.elevateZoom.min.js') }}"></script>
     <!-- Main JS File  -->
    <script src="{{ url('/assets/js/main.js') }}"></script>
    <!--<script src="{{ url('/assets/js/demos/demo-4.js') }}"></script>-->

    <!-- Item slider-->
    <script src="{{ url('/item-slide-style/slick.js') }}"></script>
    <!--<script src="{{ url('/item-slide-style/script.js') }}"></script>-->

</body>
</html>
