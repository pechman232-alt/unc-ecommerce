@extends('frontend.layouts.app-front')
@section('content')
    <style>
        .card {
            padding: 1rem 1.25rem !important;
            /* border: 1px solid rgba(0,0,0,.125); */
            border-left: 1px solid rgba(0, 0, 0, .125);
            border-right: 1px solid rgba(0, 0, 0, .125);
            background-color: #fff;
        }

        .card {
            &:first-child {
                border-top: 1px solid rgba(0, 0, 0, .125);
            }

            &:last-child {
                border-bottom: 1px solid rgba(0, 0, 0, .125);
            }
        }

        .card:first-of-type {
            border-top-left-radius: 0.45rem;
            border-top-right-radius: 0.45rem;
        }

        .card:last-of-type {
            border-bottom-left-radius: 0.45rem;
            border-bottom-right-radius: 0.45rem;
        }

        .card-body {
            border-top: 1px solid rgba(0, 0, 0, .125);
            list-style: none;
            padding: 1rem 1.25rem !important;
        }

        .card-body a {
            color: black !important;
            font-size: 15px;
        }

        .card-body a:hover {
            color: orange !important;
        }

        .btn-link {
            padding: 0.4rem 1rem;
            min-width: 0;
            color: #CE181E;
            text-decoration: none;
            border: none;
            border-bottom: 0.1rem solid transparent;
            letter-spacing: 0;
            font-size: 1.4rem;
        }

        .btn-link:hover,
        .btn-link:focus {
            color: orange !important;
            border-color: #fff !important;
        }

        .product {

            justify-content: center;
            background: #f7f7f7;
            border: 1px solid #ececec;
            padding: 10px;
            /* margin-right: 12px; */
        }

        .product-price {
            margin-top: 10px;
            margin-bottom: 0.1rem !important;
            color: #CE181E;
            font-size: 16px;
            font-weight: bold;
        }

        .product-title {
            font-size: 15px;
        }

        .product {
            padding: 0 !important;
            border-radius: 5px !important;
        }

        .filter-item {
            list-style: none;
        }

        .sidebar-shop .widget-title {
            color: orange;
            padding-left: 10px;
            padding-top: 15px;
            font-size: 16px;
        }

        /* .widget-body {
            border-radius: 5px;
            border: 1px solid rgb(211, 211, 211);
        } */

        .sidebar {
            border-left: 1px solid rgba(0, 0, 0, .125);
            border-right: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px;
            background-color: #fff;
        }

        .sidebar {
            &:first-child {
                border-top: 1px solid rgba(0, 0, 0, .125);
            }

            &:last-child {
                border-bottom: 1px solid rgba(0, 0, 0, .125);
            }
        }

        .filter-items {
            border-top: 1px solid rgba(0, 0, 0, .125);
            padding-top: 10px;
        }

        .size-image {
            width: auto;
            height: 20vh;
            overflow: hidden;
            display: flex;
        }

        .size-image img {
            max-width: inherit !important;
            max-height: inherit !important;
            height: inherit !important;
            width: inherit !important;
            object-fit: cover !important;
        }
    </style>

    <main class="main">

        <div class="page-content" style="padding-top: 45px;">
            <div class="container">
                <h2 class="title">{{ $getBrands->pro_type_id }}</h2>
                <div class="row">
                    {{-- <div class="col-lg-9">
                        <div class="products mb-3">
                            <div class="row justify-content-left">
                                @foreach ($getProduct as $item)
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    <div class="product product-7 text-left">
                                        <figure class="product-media">
                                            <a href="">
                                                <div class="size-image">
                                                    <img src="{{ url('/productImages/' . $item->thumbnail) }}">
                                                </div>
                                            </a>
                                        </figure>
                                        <div class="product-body">
                                            <h3 class="product-title">
                                                <a href="">{!! Str::limit($item->product_name ,13) !!}</a>
                                            </h3>
                                            <div class="product-price">
                                                ${{ $item->price_after_discount == '' ? $item->original_price : $item->price_after_discount }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{ $getProduct->links('paginitaion') }}

                    </div> --}}

                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="false"
                                        aria-controls="widget-1">{{ $getBrands->name }}</a>
                                </h3>
                                <div class="collapse" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    @foreach ($brands as $brand)
                                                        <li>
                                                            <a href="{{ url('product-type-detail', encrypt($brand->product_type_id)) }}">{{ $brand->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection
