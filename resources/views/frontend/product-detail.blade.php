@extends('frontend.layouts.app-front')
@section('content')

    <style>
        /* --- Modern CSS Variables --- */
        :root {
            --primary-color: #CE181E;
            --text-main: #111827;
            --text-muted: #6b7280;
            --bg-page: #F8F9FA;
            
            /* Premium Card Background */
            --img-bg-color: linear-gradient(135deg, #f6f5f8 0%, #ebe7ef 100%); 
            
            --border-light: #edf2f7;
            --card-radius: 14px;
            --transition: all 0.25s ease-in-out;
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: var(--bg-page);
            font-family: var(--font-family);
        }

        .page-content {
            padding-top: 40px;
            padding-bottom: 60px;
        }

        /* --- Main Product Image Gallery --- */
        .product-main-image {
            background: #fff;
            border-radius: var(--card-radius);
            padding: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-light);
            margin-bottom: 1rem;
            text-align: center;
        }

        .product-main-image img {
            max-height: 400px;
            object-fit: contain;
            width: 100%;
            border-radius: 8px;
        }

        /* --- Thumbnail Slider --- */
        #slide-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .my-arrow {
            width: 35px;
            height: 35px;
            cursor: pointer;
            transition: var(--transition);
            opacity: 0.5;
            background: #fff;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .my-arrow:hover { opacity: 1; transform: scale(1.1); }

        #product-zoom-gallery {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 10px;
            padding: 5px 0;
            width: 100%;
            max-width: 400px;
        }

        #product-zoom-gallery::-webkit-scrollbar { display: none; }

        .product-gallery-item img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background: #fff;
            border-radius: 8px;
            border: 2px solid var(--border-light);
            transition: var(--transition);
            padding: 5px;
        }

        .product-gallery-item.active img,
        .product-gallery-item:hover img {
            border-color: var(--primary-color);
            box-shadow: 0 4px 10px rgba(206, 24, 30, 0.15);
        }

        /* --- Product Details Section --- */
        .product-info-box {
            background: #fff;
            border-radius: var(--card-radius);
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-light);
            height: 100%;
        }

        .product-title-main {
            font-size: 2.2rem !important;
            font-weight: 800 !important;
            color: var(--text-main);
            margin-bottom: 1rem;
            line-height: 1.2 !important;
            font-family: var(--font-family);
        }

        .product-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        .product-meta a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        .price-container {
            background: var(--img-bg-color); /* Used premium background here too */
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .current-price {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
        }

        .original-price {
            font-size: 1.2rem;
            color: #a0aec0;
            text-decoration: line-through;
            font-weight: 500;
        }

        .content-header {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .my-details {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-muted);
        }

        /* --- Section Titles --- */
        .section-title {
            text-align: left;
            font-weight: 800;
            font-size: 1.85rem;
            color: var(--text-main);
            margin-top: 4rem;
            margin-bottom: 2rem;
            font-family: var(--font-family);
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 10px;
        }

        /* =========================================
           EXACT MATCH PRODUCT CARD (Premium Design)
           ========================================= */
        .cls_card_item {
            background: #fff;
            border: none; 
            border-radius: var(--card-radius);
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden; 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: var(--transition);
        }

        .cls_card_item:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }

        .product-media-wrap {
            position: relative;
            background: var(--img-bg-color);
            padding: 30px 20px 20px 20px; 
            display: flex;
            align-items: center;
            justify-content: center;
            height: 220px; 
            overflow: hidden; 
        }

        .size-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .size-image img {
            max-height: 130px; 
            object-fit: contain;
            mix-blend-mode: multiply; 
            transition: transform 0.4s ease;
        }

        .cls_card_item:hover .size-image img { transform: scale(1.03); }

        .product-badges {
            position: absolute;
            top: 12px;
            left: 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 2;
        }

        .custom-badge {
            background: #2b2b2b; 
            color: #ffffff;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 4px;
            letter-spacing: 0.2px;
            text-transform: uppercase;
        }

        .wishlist-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 28px;
            height: 28px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #111827;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            transition: var(--transition);
            z-index: 2;
            text-decoration: none !important;
        }

        .wishlist-btn:hover {
            color: var(--primary-color);
            transform: scale(1.05);
        }

        .quick-view-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 45%; 
            background: linear-gradient(to top, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0) 100%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 12px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.25s ease-out;
            z-index: 3;
        }

        .quick-view-text {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-main);
            text-decoration: none !important;
        }

        .cls_card_item:hover .quick-view-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .card-body-custom {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            background-color: #fff;
            z-index: 4;
        }

        .card-title-custom {
            font-size: 0.95rem;
            font-weight: 700; 
            color: var(--text-main);
            margin-bottom: 6px;
            line-height: 1.4;
            transition: var(--transition);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .cls_card_item:hover .card-title-custom { color: var(--primary-color); }

        .card-text-custom {
            color: var(--text-muted);
            font-size: 0.75rem;
            line-height: 1.5;
            margin-bottom: 16px;
            flex-grow: 1; 
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
            padding-top: 15px;
        }

        .cls_price {
            display: flex;
            flex-direction: column;
            margin-bottom: 0;
        }

        .cls_price b {
            color: var(--primary-color);
            font-size: 1.15rem; 
            font-weight: 700; 
            line-height: 1;
            letter-spacing: -0.3px; 
        }

        .cls_price s {
            color: #9ca3af;
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 2px;
            text-decoration: line-through;
        }

        .cart-btn {
            background-color: #111827; 
            color: #fff;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.9rem;
        }

        .cart-btn:hover {
            background-color: var(--primary-color);
            transform: scale(1.05);
        }

        /* Fix Owl Carousel heights */
        .owl-stage { display: flex; }
        .owl-item { display: flex; flex: 1 0 auto; }
    </style>

    <main class="main">
        <div class="page-content">
            <div class="container">
                
                <!-- TOP PRODUCT SECTION -->
                <div class="row">
                    <!-- LEFT COLUMN: Gallery -->
                    <div class="col-lg-5 col-md-6 mb-4">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="{{ url('/productImages/'.$productDetails->thumbnail) }}" data-zoom-image="{{ url('/productImages/'.$productDetails->thumbnail) }}" alt="{{ $productDetails->product_name }}">
                            </figure>

                            <div id="slide-wrapper">
                                <img id="slideLeft" class="my-arrow" src="{{ asset('/assets/images/arrow-left.png') }}" alt="Left">
                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @foreach ($product_images as $product_image)
                                        <a class="product-gallery-item {{ $loop->first ? 'active' : '' }}" href="#"
                                            data-image="{{ url($product_image->image_name == '' ? '':'/productDetails/'.$product_image->image_name) }}">
                                            <img src="{{ url($product_image->image_name == '' ? '':'/productDetails/'.$product_image->image_name) }}" alt="Thumbnail">
                                        </a>
                                    @endforeach
                                </div>
                                <img id="slideRight" class="my-arrow" src="{{ asset('/assets/images/arrow-right.png') }}" alt="Right">
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: Details -->
                    <div class="col-lg-7 col-md-6">
                        <div class="product-info-box">
                            <h1 class="product-title-main">{{ $productDetails->product_name }}</h1>
                            
                            <div class="product-meta">
                                <span>Brand: <a href="#">{{ $brands->name }}</a></span>
                                <span>|</span>
                                <span>Category: <a href="#">{{ $brands->type_name }}</a></span>
                            </div>

                            <!-- Price Box -->
                            <div class="price-container">
                                <?php 
                                    $price_after = floatval($productDetails->price_after_discount);
                                    $price_orig = floatval($productDetails->original_price);
                                ?>
                                <span class="current-price">
                                    ${{ number_format($price_after != 0 ? $price_after : $price_orig, 2) }}
                                </span>
                                @if($price_after != 0)
                                    <span class="original-price">
                                        ${{ number_format($price_orig, 2) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Description -->
                            <div class="product-content">
                                <div class="content-header">
                                    <i class="icon-info-circle"></i> Product Description
                                </div>
                                <hr class="mt-0 mb-3">
                                <div class="my-details">
                                    {!! $productDetails->details !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RELATED PRODUCTS SECTION (PREMIUM DESIGN) -->
                <h2 class="section-title">You May Also Like</h2>
                
                <div class="owl-carousel owl-simple" data-toggle="owl"
                    data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "items": 4,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": { "items": 2 },
                        "768": { "items": 3 },
                        "1200": { "items": 4, "nav": true, "dots": false }
                    }
                }'>
                    @foreach ($getProductbyBrands as $item)
                        <!-- Modern Premium Card Design -->
                        <div class="card cls_card_item w-100">
                            
                            <div class="product-media-wrap">
                                <div class="product-badges">
                                    <span class="custom-badge">RELATED</span>
                                </div>
                                
                                <a href="#" class="wishlist-btn" title="Add to Wishlist">
                                    <i class="icon-heart-o"></i>
                                </a>

                                <a href="{{ url('product-detail/'.encrypt($item->id)) }}" class="w-100">
                                    <div class="size-image">
                                        <img src="{{ url('/productImages/'.$item->thumbnail) }}" alt="{{ $item->product_name }}">
                                    </div>
                                </a>

                                <div class="quick-view-overlay">
                                    <a href="{{ url('product-detail/'.encrypt($item->id)) }}" class="quick-view-text">Quick view</a>
                                </div>
                            </div>

                            <div class="card-body-custom">
                                <a href="{{ url('product-detail/'.encrypt($item->id)) }}" style="text-decoration: none;">
                                    <h3 class="card-title-custom">{{ $item->product_name }}</h3>
                                </a>
                                
                                <div class="card-text-custom">
                                    {{ strip_tags($item->details) }}
                                </div>
                                
                                <div class="card-footer-custom">
                                    <div class="cls_price">
                                        <?php 
                                            $rel_price_after = floatval($item->price_after_discount);
                                            $rel_price_orig = floatval($item->original_price);
                                        ?>
                                        <b>${{ number_format($rel_price_after != 0 ? $rel_price_after : $rel_price_orig, 2) }}</b>
                                        @if($rel_price_after != 0)
                                            <s>${{ number_format($rel_price_orig, 2) }}</s>
                                        @endif
                                    </div>
                                    
                                    <button class="cart-btn" title="Add to Cart">
                                        <i class="icon-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main>

    <!-- Fixed JavaScript -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            let thumbnails = document.getElementsByClassName('product-gallery-item');
            let mainImage = document.getElementById('product-zoom');

            for (let i = 0; i < thumbnails.length; i++) {
                thumbnails[i].addEventListener('mouseover', function(e) {
                    e.preventDefault(); 
                    
                    for (let j = 0; j < thumbnails.length; j++) {
                        thumbnails[j].classList.remove('active');
                    }
                    
                    this.classList.add('active');
                    
                    let newImageSrc = this.getAttribute('data-image');
                    mainImage.src = newImageSrc;
                    
                    mainImage.setAttribute('data-zoom-image', newImageSrc);
                });
            }

            // Arrow Scrolling
            let buttonRight = document.getElementById('slideRight');
            let buttonLeft = document.getElementById('slideLeft');
            let galleryContainer = document.getElementById('product-zoom-gallery');

            if (buttonLeft && galleryContainer) {
                buttonLeft.addEventListener('click', function(){
                    galleryContainer.scrollBy({ left: -150, behavior: 'smooth' });
                });
            }

            if (buttonRight && galleryContainer) {
                buttonRight.addEventListener('click', function(){
                    galleryContainer.scrollBy({ left: 150, behavior: 'smooth' });
                });
            }
        });
    </script>

@endsection