@extends('frontend.layouts.app-front')
@section('content')

    <style>
        :root {
            --primary-color: #CE181E;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-light: #F9FAFB;
            --image-bg: #F3F4F6;
            --card-radius: 16px;
            --transition: all 0.3s ease;
        }

        body {
            background-color: var(--bg-light);
        }

        /* --- Slider Container --- */
        .intro-slider-container {
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        /* =========================================
           NEW: MODERN SECTION HEADERS (From Screenshot)
           ========================================= */
        .section-header-modern {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
            padding-bottom: 0.5rem;
        }

        .sh-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sh-title {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0;
            line-height: 1.2;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .sh-count {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .sh-right {
            margin-bottom: 4px;
        }

        .sh-link {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            text-decoration: none !important;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            background: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }

        .sh-link:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        /* =========================================
           MODERN PRODUCT CARD (With Quick View Hover)
           ========================================= */
        .cls_card_item {
            background: #fff;
            border: 1px solid #f3f4f6;
            border-radius: var(--card-radius);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            height: 100%;
            overflow: hidden; 
            padding: 0; 
        }

        .cls_card_item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .product-media-wrap {
            position: relative;
            background-color: var(--image-bg);
            padding: 2.5rem 1rem 1.5rem 1rem; 
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden; 
        }

        .size-image {
            width: 100%;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .size-image img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
            mix-blend-mode: multiply; 
        }

        .cls_card_item:hover .size-image img {
            transform: scale(1.05); 
        }

        .product-badges {
            position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            z-index: 2;
        }

        .custom-badge {
            background: #374151; 
            color: #fff;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 6px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .wishlist-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 32px;
            height: 32px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4b5563;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: var(--transition);
            z-index: 2;
            text-decoration: none !important;
        }

        .wishlist-btn:hover {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .quick-view-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%; 
            background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 12px;
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.3s ease;
            z-index: 3;
            pointer-events: none; 
        }

        .quick-view-text {
            font-weight: 800;
            font-size: 0.95rem;
            color: var(--text-dark);
            text-decoration: none !important;
            pointer-events: auto; 
            transition: var(--transition);
        }

        .quick-view-text:hover {
            color: var(--primary-color);
        }

        .cls_card_item:hover .quick-view-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .card-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            background-color: #fff;
            position: relative;
            z-index: 4;
        }

        .card-title {
            font-size: 1.05rem;
            font-weight: 800; 
            color: var(--text-dark);
            margin-bottom: 0.4rem;
            line-height: 1.4;
            transition: var(--transition);
            font-family: "Kantumruy Pro", sans-serif;
            
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .cls_card_item:hover .card-title {
            color: var(--primary-color);
        }

        .card-text {
            color: var(--text-muted);
            font-size: 0.85rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            flex-grow: 1; 
            font-family: "Kantumruy Pro", sans-serif;
            
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-footer-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            border-top: 1px solid #f3f4f6; 
            padding-top: 1rem;
        }

        .cls_price {
            display: flex;
            flex-direction: column;
            margin-bottom: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .cls_price b {
            color: var(--primary-color);
            font-size: 1.25rem; 
            font-weight: 700; 
            line-height: 1.1;
            letter-spacing: -0.5px; 
        }

        .cls_price s {
            color: #9ca3af;
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 2px;
            text-decoration: line-through;
        }

        .cart-btn {
            background-color: #111827; 
            color: #fff;
            border: none;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            cursor: pointer;
            font-size: 1.1rem;
        }

        .cart-btn:hover {
            background-color: var(--primary-color);
            transform: scale(1.05);
        }
    </style>

    <main class="main">
        
        <!-- TOP SLIDER -->
        <div class="container mt-4">
            <div class="intro-slider-container mb-5">
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl"
                    data-owl-options='{
                        "dots": true,
                        "nav": false, 
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    @foreach ($sliders as $slider)
                        <div class="intro-slide"
                            style="background-image: url({{ url($slider->name == '' ? 'backend/assets/img/slider.png' : '/slider/' . $slider->name) }});">
                            <div class="container intro-content">
                                <div class="row justify-content-end">
                                    <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <span class="slider-loader"></span>
            </div>
        </div>

        <!-- NEW ARRIVAL SECTION -->
        <div class="blog-posts pt-4 pb-5">
            <div class="container">
                
                <!-- Modern Section Header -->
                <div class="section-header-modern">
                    <div class="sh-left">
                        <h2 class="sh-title">New Arrival</h2>
                        <span class="sh-count">{{ count($NEW_ARRIVALS) }} results</span>
                    </div>
                    <div class="sh-right">
                        <!-- Add your link to the full New Arrival page here if you have one -->
                        <a href="#" class="sh-link">View All <i class="icon-angle-right"></i></a>
                    </div>
                </div>
                
                <div class="row justify-content-start">
                    @foreach ($NEW_ARRIVALS->take(8) as $item) <!-- .take(8) keeps home page clean -->
                        <div class="col-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                            <div class="card cls_card_item w-100">
                                
                                <div class="product-media-wrap">
                                    <div class="product-badges">
                                        <span class="custom-badge">NEW</span>
                                    </div>
                                    
                                    <a href="#" class="wishlist-btn" title="Add to Wishlist">
                                        <i class="icon-heart-o"></i>
                                    </a>

                                    <a href="{{ url('product-detail/'.encrypt($item->id)) }}" class="w-100">
                                        <div class="size-image">
                                            <img src="{{ url('/productImages/' . $item->thumbnail) }}" alt="{{ $item->product_name }}">
                                        </div>
                                    </a>

                                    <div class="quick-view-overlay">
                                        <a href="{{ url('product-detail/'.encrypt($item->id)) }}" class="quick-view-text">Quick view</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <a href="{{ url('product-detail/'.encrypt($item->id)) }}" style="text-decoration: none;">
                                        <h5 class="card-title">{{ $item->product_name }}</h5>
                                    </a>
                                    
                                    <div class="card-text">
                                        {{ strip_tags($item->details) }}
                                    </div>
                                    
                                    <div class="card-footer-custom">
                                        <p class="cls_price">
                                            <?php 
                                                $price_after = number_format((float)$item->price_after_discount, 2);
                                                $price_orig = number_format((float)$item->original_price, 2);
                                            ?>
                                            <b>${{ $price_after != 0.00 ? $price_after : $price_orig }}</b>
                                            @if($price_after != 0.00)
                                                <s>${{ $price_orig }}</s>
                                            @endif
                                        </p>
                                        
                                        <button class="cart-btn" title="Add to Cart">
                                            <i class="icon-shopping-cart"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- HOT SALE SECTION -->
        <div class="blog-posts pt-3 pb-5">
            <div class="container">
                
                <!-- Modern Section Header -->
                <div class="section-header-modern">
                    <div class="sh-left">
                        <h2 class="sh-title">Hot Sale</h2>
                        <span class="sh-count">{{ count($HOT_SALES) }} results</span>
                    </div>
                    <div class="sh-right">
                        <!-- Add your link to the full Hot Sale page here if you have one -->
                        <a href="#" class="sh-link">View All <i class="icon-angle-right"></i></a>
                    </div>
                </div>
                
                <div class="row justify-content-start">
                    @foreach ($HOT_SALES->take(8) as $item)
                        <div class="col-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                            <div class="card cls_card_item w-100">
                                
                                <div class="product-media-wrap">
                                    <div class="product-badges">
                                        <span class="custom-badge" style="background-color: var(--primary-color);">SALE</span>
                                    </div>
                                    
                                    <a href="#" class="wishlist-btn" title="Add to Wishlist">
                                        <i class="icon-heart-o"></i>
                                    </a>

                                    <a href="{{ url('product-detail/'.encrypt($item->id)) }}" class="w-100">
                                        <div class="size-image">
                                            <img src="{{ url('/productImages/' . $item->thumbnail) }}" alt="{{ $item->product_name }}">
                                        </div>
                                    </a>

                                    <div class="quick-view-overlay">
                                        <a href="{{ url('product-detail/'.encrypt($item->id)) }}" class="quick-view-text">Quick view</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <a href="{{ url('product-detail/'.encrypt($item->id)) }}" style="text-decoration: none;">
                                        <h5 class="card-title">{{ $item->product_name }}</h5>
                                    </a>
                                    
                                    <div class="card-text">
                                        {{ strip_tags($item->details) }}
                                    </div>
                                    
                                    <div class="card-footer-custom">
                                        <p class="cls_price">
                                            <?php 
                                                $price_after = number_format((float)$item->price_after_discount, 2);
                                                $price_orig = number_format((float)$item->original_price, 2);
                                            ?>
                                            <b>${{ $price_after != 0.00 ? $price_after : $price_orig }}</b>
                                            @if($price_after != 0.00)
                                                <s>${{ $price_orig }}</s>
                                            @endif
                                        </p>
                                        
                                        <button class="cart-btn" title="Add to Cart">
                                            <i class="icon-shopping-cart"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection