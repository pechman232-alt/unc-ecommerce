@extends('frontend.layouts.app-front')
@section('content')

    <style>
        :root {
            --primary-color: #CE181E;
            --secondary-color: #111827;
            --danger-color: #ef4444;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --bg-light: #F9FAFB;
            --image-bg: #f8f9fa;
            --card-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background-color: var(--bg-light);
        }

        /* --- Section Titles --- */
        .section-title {
            text-align: left;
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--text-dark);
            margin-bottom: 2rem;
            position: relative;
            font-family: "Kantumruy Pro", sans-serif;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        /* --- Slider Container --- */
        .intro-slider-container {
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        /* =========================================
           MODERN PRODUCT CARD
           ========================================= */
        .cls_card_item {
            background: #fff;
            border: 1px solid #f3f4f6;
            border-radius: var(--card-radius);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            height: 100%;
            overflow: hidden; 
            padding: 0; 
            text-decoration: none;
        }

        .cls_card_item:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: transparent;
        }

        /* Top Image Area */
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
            height: 180px; /* រាងខ្ពស់បន្តិចដើម្បីបង្ហាញរូបកុំព្យូទ័របានច្បាស់ */
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
            transform: scale(1.08); 
        }

        /* Floating Badges */
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
            background: var(--secondary-color); 
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .badge-discount {
            background: var(--danger-color);
        }

        /* Wishlist Heart Button */
        .wishlist-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 34px;
            height: 34px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: var(--transition);
            z-index: 2;
            text-decoration: none !important;
            font-size: 1.1rem;
        }

        .wishlist-btn:hover {
            color: var(--danger-color);
            transform: scale(1.15);
        }

        /* Quick View Overlay Animation */
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
            padding-bottom: 15px;
            opacity: 0;
            transform: translateY(20px);
            transition: var(--transition);
            z-index: 3;
            pointer-events: none; 
        }

        .quick-view-text {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--secondary-color);
            text-decoration: underline !important;
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

        /* --- Card Body & Modern Typography --- */
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
            font-weight: 700; 
            color: var(--text-dark);
            margin-bottom: 0.5rem;
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
    background-color: #f8fafc; /* ពណ៌ផ្ទៃខាងក្រោយប្រផេះលាយខៀវស្រាល (ស្លេក) */
    border: 1px solid #f1f5f9; /* ស៊ុមស្តើងៗ */
    padding: 10px 12px;
    border-radius: 10px; /* គែមមូលស្អាត */
    color: #475569; /* ពណ៌អក្សរប្រផេះចាស់ ងាយស្រួលអាន */
    font-size: 0.82rem;
    line-height: 1.6;
    margin-bottom: 1.25rem;
    flex-grow: 1; 
    font-family: "Kantumruy Pro", sans-serif;
    
    /* កាត់អក្សរបើវែងពេក ត្រឹម ២ បន្ទាត់ */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    
    transition: all 0.3s ease;
}
.cls_card_item:hover .card-text {
    background-color: #f1f5f9;
    color: #1e293b;
}

/* បន្ថែមសញ្ញា (Bullet) ខាងមុខអត្ថបទ ដើម្បីឱ្យដឹងថាជាការរៀបរាប់លក្ខណៈ */
.card-text::before {
    content: "•";
    color: var(--primary-color);
    font-weight: bold;
    margin-right: 6px;
    font-size: 1rem;
    line-height: 1;
}

        /* លាក់ Description នៅលើទូរស័ព្ទ ដើម្បីកុំឱ្យកាតវែងពេក */
        @media (max-width: 767px) {
            .card-text {
                display: none;
            }
            .card-body {
                padding: 1rem;
            }
            .size-image {
                height: 140px;
            }
        }

        /* --- Price & Cart Footer Row --- */
        .card-footer-custom {
            display: flex;
            justify-content: space-between;
            align-items: center; 
            margin-top: auto;
            border-top: 1px dashed #e5e7eb; 
            padding-top: 1rem;
        }

        .cls_price {
            display: flex;
            flex-direction: column;
            margin-bottom: 0;
            font-family: 'Inter', -apple-system, sans-serif;
        }

        .cls_price b {
            color: var(--primary-color);
            font-size: 1.3rem; 
            font-weight: 800; 
            line-height: 1;
            letter-spacing: -0.5px; 
        }

        .cls_price s {
            color: #9ca3af;
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 4px;
            text-decoration: line-through;
        }

        /* Cart Button */
        .cart-btn {
            background-color: var(--secondary-color); 
            color: #fff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            cursor: pointer;
            font-size: 1.2rem;
        }

        .cart-btn:hover {
            background-color: var(--primary-color);
            transform: scale(1.05) rotate(-5deg); /* បង្វិលបន្តិចពេល Hover មើលទៅរស់រវើក */
            box-shadow: 0 4px 12px rgba(206, 24, 30, 0.3);
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
                <h2 class="section-title">New Arrival</h2>
                
                <div class="row justify-content-start">
                    @foreach ($NEW_ARRIVALS as $item)
                        @php
                            $price_after = (float)$item->price_after_discount;
                            $price_orig = (float)$item->original_price;
                            $has_discount = $price_after > 0 && $price_after < $price_orig;
                            $discount_percent = $has_discount ? round((($price_orig - $price_after) / $price_orig) * 100) : 0;
                        @endphp
                        
                        <div class="col-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                            <div class="card cls_card_item w-100">
                                
                                <!-- Image & Badges Area -->
                                <div class="product-media-wrap">
                                    <div class="product-badges">
                                        <span class="custom-badge">NEW</span>
                                        @if($has_discount)
                                            <span class="custom-badge badge-discount">-{{ $discount_percent }}%</span>
                                        @endif
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

                                <!-- Text & Price Area -->
                                <div class="card-body">
                                    <a href="{{ url('product-detail/'.encrypt($item->id)) }}" style="text-decoration: none;">
                                        <h5 class="card-title">{{ $item->product_name }}</h5>
                                    </a>
                                    
                                    <div class="card-text">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->details), 80, '...') }}
                                    </div>
                                    
                                    <!-- Price & Cart Row -->
                                    <div class="card-footer-custom">
                                        <p class="cls_price">
                                            <b>${{ number_format($has_discount ? $price_after : $price_orig, 2) }}</b>
                                            @if($has_discount)
                                                <s>${{ number_format($price_orig, 2) }}</s>
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
                <h2 class="section-title">Hot Sale</h2>
                
                <div class="row justify-content-start">
                    @foreach ($HOT_SALES as $item)
                        @php
                            $price_after = (float)$item->price_after_discount;
                            $price_orig = (float)$item->original_price;
                            $has_discount = $price_after > 0 && $price_after < $price_orig;
                            $discount_percent = $has_discount ? round((($price_orig - $price_after) / $price_orig) * 100) : 0;
                        @endphp
                        
                        <div class="col-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                            <div class="card cls_card_item w-100">
                                
                                <!-- Image & Badges Area -->
                                <div class="product-media-wrap">
                                    <div class="product-badges">
                                        <span class="custom-badge" style="background-color: var(--primary-color);">SALE</span>
                                        @if($has_discount)
                                            <span class="custom-badge badge-discount">-{{ $discount_percent }}%</span>
                                        @endif
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

                                <!-- Text & Price Area -->
                                <div class="card-body">
                                    <a href="{{ url('product-detail/'.encrypt($item->id)) }}" style="text-decoration: none;">
                                        <h5 class="card-title">{{ $item->product_name }}</h5>
                                    </a>
                                    
                                    <div class="card-text">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->details), 80, '...') }}
                                    </div>
                                    
                                    <div class="card-footer-custom">
                                        <p class="cls_price">
                                            <b>${{ number_format($has_discount ? $price_after : $price_orig, 2) }}</b>
                                            @if($has_discount)
                                                <s>${{ number_format($price_orig, 2) }}</s>
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