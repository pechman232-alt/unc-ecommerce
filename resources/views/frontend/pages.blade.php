@extends('frontend.layouts.app-front')
@section('content')
    <style>
        /* --- Modern CSS Variables --- */
        :root {
            --primary-color: #CE181E;
            --primary-hover: #e53935;
            --text-dark: #2d3748;
            --text-muted: #718096;
            --bg-light: #f8f9fa;
            --border-light: #edf2f7;
            --card-radius: 12px;
            --transition-fast: all 0.2s ease;
            --transition-slow: all 0.4s ease;
        }

        body {
            background-color: var(--bg-light);
        }

        .title {
            margin-bottom: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            font-size: 2rem;
            position: relative;
            display: inline-block;
        }

        /* Red underline for the title */
        .title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50%;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        /* =========================================
           NEW MODERN SIDEBAR (From Image)
           ========================================= */
        .modern-sidebar {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--border-light);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .modern-sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }

        .ms-icon-wrap {
            width: 42px;
            height: 42px;
            background: #111827; /* Dark slate matching the image */
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
        }

        .ms-title-wrap {
            flex-grow: 1;
        }

        .ms-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 4px 0;
            line-height: 1.2;
        }

        .ms-subtitle {
            font-size: 0.85rem;
            color: #6b7280;
        }

        /* --- Search Bar --- */
        .ms-search-wrap {
            padding: 0 20px 15px 20px;
        }
        .ms-search {
            position: relative;
        }
        .ms-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .ms-search input {
            width: 100%;
            padding: 10px 12px 10px 38px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95rem;
            outline: none;
            transition: var(--transition-fast);
        }
        .ms-search input:focus {
            border-color: #111827;
            box-shadow: 0 0 0 2px rgba(17, 24, 39, 0.1);
        }

        /* --- Scrollable List --- */
        .ms-list {
            padding: 0 20px 10px 20px;
            max-height: 280px;
            overflow-y: auto;
        }
        .ms-list::-webkit-scrollbar {
            width: 6px;
        }
        .ms-list::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }

        /* Simulated Checkbox Item */
        .ms-list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0;
            cursor: pointer;
            text-decoration: none !important;
            transition: var(--transition-fast);
        }
        
        .ms-list-item:hover .ms-checkbox {
            border-color: #111827;
        }
        
        .ms-list-item:hover .brand-name-text {
            color: var(--primary-color);
        }

        .ms-checkbox-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            color: #111827;
        }

        .ms-checkbox {
            width: 20px;
            height: 20px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .ms-count {
            font-size: 0.85rem;
            color: #9ca3af;
        }

        /* --- Sticky Footer --- */
        .ms-footer {
            padding: 15px 20px;
            border-top: 1px solid #f3f4f6;
            background: #fff;
            display: flex;
            justify-content: flex-end;
        }
        .ms-btn {
            background: #e5e7eb;
            color: #9ca3af;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: not-allowed;
        }

        /* =========================================
           PRODUCT CARD WITH ANIMATIONS
           ========================================= */
        .product {
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: var(--card-radius);
            padding: 1.25rem;
            transition: var(--transition-slow);
            height: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
            /* Fade Up Animation Setup */
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s forwards ease-out;
        }

        .product:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border-color: transparent;
        }

        .product-media {
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .size-image {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
        }

        .size-image img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .product:hover .size-image img {
            transform: scale(1.1);
        }

        .product-body {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            background-color: #fff;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .product-title a {
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition-fast);
        }

        .product-title a:hover {
            color: var(--primary-color);
        }

        .my-card-text {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.3rem;
            margin-top: auto;
        }

        .product-price b {
            color: var(--primary-color);
            font-weight: 700;
        }

        .product-price s {
            color: #a0aec0;
            font-size: 0.95rem;
            font-weight: 400;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation delay */
        .products .col-6:nth-child(1) .product { animation-delay: 0.1s; }
        .products .col-6:nth-child(2) .product { animation-delay: 0.2s; }
        .products .col-6:nth-child(3) .product { animation-delay: 0.3s; }
        .products .col-6:nth-child(4) .product { animation-delay: 0.4s; }
        .products .col-6:nth-child(5) .product { animation-delay: 0.5s; }
        .products .col-6:nth-child(6) .product { animation-delay: 0.6s; }

        nav .pagination {
            justify-content: center;
            margin-top: 2rem;
        }
    </style>

    <main class="main">
        <div class="page-content" style="padding-top: 45px;">
            <div class="container">
                <h2 class="title">{{ $pages->name }}</h2>
                <div class="row">

                    <!-- =========================================
                         MODERN SIDEBAR (Filters)
                         ========================================= -->
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            @foreach ($productTypes as $ind => $productType)
                                @if(count($productType->brand_names) > 0)
                                
                                <div class="modern-sidebar">
                                    <!-- Header -->
                                    <div class="modern-sidebar-header" data-toggle="collapse" href="#widget-{{ $ind +1 }}" role="button" aria-expanded="true">
                                        <div class="ms-icon-wrap">
                                            <i class="icon-laptop"></i> <!-- Icon for category -->
                                        </div>
                                        <div class="ms-title-wrap">
                                            <h3 class="ms-title">{{ $productType->type_name }}</h3>
                                            <span class="ms-subtitle">{{ count($productType->brand_names) }} brands &middot; filter by brand</span>
                                        </div>
                                        <i class="icon-angle-down ms-chevron"></i>
                                    </div>
                    
                                    <div class="collapse show" id="widget-{{ $ind +1 }}">
                                        <!-- Search Input -->
                                        <div class="ms-search-wrap">
                                            <div class="ms-search">
                                                <i class="icon-search"></i>
                                                <input type="text" class="brand-search-input" placeholder="Find a brand" onkeyup="filterBrands(this)">
                                            </div>
                                        </div>
                    
                                        <!-- Scrollable Brand List -->
                                        <div class="ms-list">
                                            @foreach ($productType->brand_names as $item)
                                                <!-- Link acts exactly like your old one, but looks like a checkbox -->
                                                <a href="{{ url('brands', encrypt([$item->id, $productType->id, $pages->name])) }}" class="ms-list-item">
                                                    <div class="ms-checkbox-wrap">
                                                        <div class="ms-checkbox"></div>
                                                        <span class="brand-name-text">{{ $item->name }}</span>
                                                    </div>
                                                    <span class="ms-count"><i class="icon-angle-right"></i></span> 
                                                </a>
                                            @endforeach
                                        </div>
                    
                                        <!-- Footer Button -->
                                        <div class="ms-footer">
                                            <button class="ms-btn" disabled>Apply filters</button>
                                        </div>
                                    </div>
                                </div>
                    
                                @endif
                            @endforeach
                        </div>
                    </aside>

                    <!-- =========================================
                         ANIMATED PRODUCT GRID
                         ========================================= -->
                    <div class="col-lg-9">
                        <div class="products mb-3">
                            <div class="row justify-content-start">
                                @foreach ($getProducts as $item)
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3 d-flex align-items-stretch">
                                    <div class="product text-left w-100">
                                        <figure class="product-media">
                                            <a href="{{ url('product-detail/'.encrypt($item->id)) }}">
                                                <div class="size-image">
                                                    <img src="{{ url('/productImages/' . $item->thumbnail) }}" alt="{{ $item->product_name }}">
                                                </div>
                                            </a>
                                        </figure>
                                        <div class="product-body">
                                            <h3 class="product-title">
                                                <a href="{{ url('product-detail/'.encrypt($item->id)) }}">{!! Str::limit($item->product_name , 25) !!}</a>
                                            </h3>
                                            <div class="my-card-text">
                                                {!! Str::limit(strip_tags($item->details), 55) !!}
                                            </div>
                                            
                                            <div class="product-price">
                                                <?php 
                                                    $num_price = $item->price_after_discount;
                                                    $price_after_discounts = number_format((float)$num_price, 2);

                                                    $num_price_orig = $item->original_price;
                                                    $original_prices = number_format((float)$num_price_orig, 2);
                                                ?>
                                                <b>${{ $price_after_discounts != 0.00 ? $price_after_discounts : $original_prices }}</b>
                                                @if($price_after_discounts != 0.00)
                                                    <s>${{ $original_prices }}</s>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $getProducts->links('paginitaion') }}
                        </div>

                    </div>
                 
                </div>
            </div>
        </div>
    </main>

    <!-- Javascript for Live Brand Search -->
    <script>
        function filterBrands(inputElement) {
            // Get the search value typed by the user
            let filterValue = inputElement.value.toLowerCase();
            
            // Find the specific list of brands inside THIS widget only
            let listContainer = inputElement.closest('.modern-sidebar').querySelector('.ms-list');
            let brandItems = listContainer.querySelectorAll('.ms-list-item');
    
            // Loop through brands and hide the ones that don't match
            brandItems.forEach(function(item) {
                let brandName = item.querySelector('.brand-name-text').innerText.toLowerCase();
                if (brandName.indexOf(filterValue) > -1) {
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>
@endsection