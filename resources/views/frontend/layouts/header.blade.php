<header class="header header-intro-clearance header-4">
    <style>
        /* --- Modern CSS Variables --- */
        :root {
            --primary-color: #CE181E;
            --primary-hover: #e53935;
            --text-dark: #2d3748;
            --text-muted: #718096;
            --bg-light: #f8f9fa;
            --border-light: #edf2f7;
            --border-radius: 8px;
            --transition: all 0.2s ease;
        }

        /* --- Header Top --- */
        .header-top {
            background-color: var(--bg-light);
            border-bottom: 1px solid var(--border-light);
            font-size: 0.85rem;
            padding: 8px 0;
        }

        .top-menu-contacts {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .top-menu-contacts a {
            display: flex;
            align-items: center;
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .top-menu-contacts a:hover {
            color: var(--primary-color);
        }

        .top-menu-contacts i {
            margin-right: 8px;
            font-size: 16px;
            opacity: 0.7;
            transition: var(--transition);
        }

        .top-menu-contacts a:hover i {
            opacity: 1;
        }

        /* --- Header Middle --- */
        .header-middle {
            padding: 20px 0;
            border-bottom: 1px solid var(--border-light);
        }

        /* Search Bar Modernization */
        .header-search-wrapper {
            border-radius: 50px !important; /* Pill shape search */
            border: 1px solid #d1d5db !important;
            overflow: hidden;
            display: flex;
            background: #fff;
            transition: var(--transition);
        }

        .header-search-wrapper:focus-within {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 3px rgba(206, 24, 30, 0.1);
        }

        .header-search-wrapper input {
            border: none !important;
            padding-left: 25px !important;
            font-size: 0.95rem;
        }

        .header-search-wrapper .btn {
            background-color: var(--primary-color) !important;
            color: #fff !important;
            border-radius: 0 50px 50px 0 !important;
            min-width: 60px;
            transition: var(--transition);
        }

        .header-search-wrapper .btn:hover {
            background-color: var(--primary-hover) !important;
        }

        /* Live Search Dropdown */
        .dropdown-content {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            right: 0;
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid var(--border-light);
            z-index: 1000;
            overflow: hidden;
            max-height: 400px;
            overflow-y: auto;
        }

        .dropdown-content.show {
            display: block;
            animation: slideDown 0.2s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #cls_search_title {
            padding: 12px 20px;
            margin: 0;
            font-size: 0.85rem;
            background-color: var(--bg-light);
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid var(--border-light);
        }

        .search-result-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            text-decoration: none !important;
            border-bottom: 1px solid var(--border-light);
            transition: var(--transition);
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background-color: #fff5f5;
        }

        .search-result-img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            margin-right: 15px;
            border-radius: 4px;
        }

        .search-result-info h6 {
            margin: 0 0 5px 0;
            font-size: 0.95rem;
            color: var(--text-dark);
            font-weight: 600;
            line-height: 1.3;
        }

        .cls_price {
            color: var(--primary-color);
            font-size: 1rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cls_price b {
            font-weight: 700;
        }
        
        .cls_price s {
            color: #a0aec0;
            font-size: 0.85rem;
        }

        #no_pro {
            text-align: center;
            padding: 20px;
            margin: 0;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* --- Header About Us Links --- */
        .about-us-nav {
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .about-us-nav a {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .about-us-nav a:hover {
            color: var(--primary-color);
        }

        /* --- Header Bottom (Sticky Nav) with Red Background --- */
        .header-bottom {
            background: var(--primary-color); /* Makes the bar red */
            box-shadow: 0 4px 10px rgba(206, 24, 30, 0.2);
        }

        .cls_myStyle {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            padding: 10px 0;
        }

        .nav-item-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .nav-item-wrap img {
            transition: transform 0.3s ease;
            filter: brightness(0) invert(1); /* Forces the black icons to turn pure white! */
        }

        .nav-item-wrap:hover img {
            transform: scale(1.1);
        }

        .main-nav .menu > li > a {
            padding: 5px 0 !important;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff !important; /* Makes the text pure white */
            transition: var(--transition);
            position: relative;
        }

        /* Hover effect */
        .main-nav .menu > li > a:hover, 
        .main-nav .menu > li > a.active_menu {
            color: #ffffff !important;
            opacity: 0.8;
        }

        /* Bottom border animation now uses white */
        .main-nav .menu > li > a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #ffffff; /* White underline */
            transition: width 0.3s ease;
        }

        .main-nav .menu > li > a:hover::after,
        .main-nav .menu > li > a.active_menu::after {
            width: 100%;
        }

        @media only screen and (max-width: 990px){
            .header-right .about-us-nav { display: none; }
            .cls_myStyle { gap: 15px; }
        }
    </style>

    <!-- Top Bar -->
    <div class="header-top mt-1">
        <div class="container">
            <div class="header-left">
                <!-- Empty as requested -->
            </div>
            <div class="header-right">
                <ul class="top-menu-contacts">
                    <li>
                        <a href="tel:{{ $SITE_PHONENUMBER->value }}">
                            <i class="icon-phone"></i>
                            {{ $SITE_PHONENUMBER->value }}
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $SITE_MAIL->value }}">
                            <i class="icon-envelope"></i>
                            {{ $SITE_MAIL->value }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Middle Bar -->
    <div class="header-middle">
        <div class="container">
            <!-- Logo -->
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ url('/logos/' . $HEADER_LOGOS->value) }}" width="290" alt="UNC Computer">
                </a>
            </div>

            <!-- Modern Live Search -->
            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="myInputSearch" id="myInputSearch" placeholder="Search for laptops, components, brands..." autocomplete="off">
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div>
                        <!-- Dropdown Results -->
                        <div id="myDropdown" class="dropdown-content search-wrapper-wide"></div>
                    </form>
                </div>
            </div>

            <!-- About Us Links -->
            <div class="header-right">
                <ul class="about-us-nav">
                    @foreach ($GET_ABOUT_US as $item)
                        <li><a href="{{ url('page', encrypt($item->id)) }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Bar (Nav Menu) -->
    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-center cls_myStyle">
                
                @foreach ($SITE_MENUS as $SITE_MENU)
                    <div class="nav-item-wrap">
                        <a href="{{ url('pages', encrypt($SITE_MENU->id)) }}">
                            <img src="{{ url($SITE_MENU->icon == '' ? 'backend/assets/img/avatars/1.png' : '/icons/' . $SITE_MENU->icon) }}" width="23" alt="Icon">
                        </a>
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container active">
                                    <a class="{{ request()->is('pages/*') && decrypt(session()->get('activeMenuId')) == $SITE_MENU->id ? 'active_menu' : '' }}" href="{{ url('pages', encrypt($SITE_MENU->id)) }}">
                                        {{ $SITE_MENU->name }}
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>

    <!-- Live Search JavaScript -->
    <script>
        var typingTimer;                
        var doneTypingInterval = 400; 
        var $input = $('#myInputSearch');

        $input.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(onChangeSearch, doneTypingInterval);
        });

        $input.on('keydown', function () {
            clearTimeout(typingTimer);
        });

        function onChangeSearch() {
            var searchValue = document.getElementById("myInputSearch").value;
            var dropdown = $('#myDropdown');

            if (searchValue.trim() !== "") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ url('search-product') }}",
                    dataType: "json",
                    data: {
                        searchVal: searchValue
                    },
                    success: function(data) {
                        dropdown.empty();
                        var html = "";
                        
                        if (data.length > 0) {
                            html += `<p id="cls_search_title">Search Results (${data.length}):</p>`;
                            
                            for (var i = 0; i < data.length; i++) {
                                var priceAfter = data[i]['price_after_discount'];
                                var priceOrig = data[i]['original_price'];
                                
                                var currentPrice = priceAfter ? "$" + priceAfter : "$" + priceOrig;
                                var oldPrice = priceAfter ? "$" + priceOrig : "";
                                
                                html += `
                                <a href="{{ url('product-detail/') }}/` + data[i]['id_en'] + `" class="search-result-item">
                                    <img src="{{ url('/productImages') }}/` + data[i]['thumbnail'] + `" class="search-result-img">
                                    <div class="search-result-info">
                                        <h6>` + data[i]['product_name'] + `</h6>
                                        <p class="cls_price">
                                            <b>` + currentPrice + `</b>
                                            <s>` + oldPrice + `</s>
                                        </p>
                                    </div>
                                </a>`;
                            }
                            
                            dropdown.addClass("show").append(html);
                        } else {
                            dropdown.empty().addClass("show").append('<p id="no_pro">No Products Found!</p>');
                        }
                    }
                });
            } else {
                dropdown.removeClass("show").empty();
            }
        }
        
        // Close dropdown when clicking outside
        $(document).on('click', function (e) {
            if ($(e.target).closest(".header-search-extended").length === 0) {
                $("#myDropdown").removeClass("show");
            }
        });
    </script>
</header>