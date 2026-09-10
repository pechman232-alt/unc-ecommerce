@extends('backend.layouts.app-back')
@section('content')
    <style>
        .navbar.bg-light {
            /* background-color: #fde9e9 !important; */
            background-color: #fde9e9 !important;
            border-radius: 10px;
            margin-top: 15px;
            margin-left: 15px;
            margin-right: 15px;
        }

        .navbar-expand-lg .navbar-collapse {
            display: flex !important;
            flex-basis: auto;
        }
        .dataTables_filter{
            margin-bottom: 20px;
        }
        .dataTables_paginate, .dataTables_info{
            margin-top: 20px;
        }
        table#datatable{
            border: 1px solid #ccc;
        }
        table.dataTable thead>tr>th.sorting:after, table.dataTable thead>tr>th.sorting_asc:after{
            display: none;
        }
        table.dataTable thead>tr>th.sorting:before, table.dataTable thead>tr>th.sorting_asc:before{
            display: none;
        }
        #datatable thead tr th{
            height: 35px;
            background-color: #fde9e9;
        }
        #datatable thead tr th, #datatable tbody tr td{
            text-align: center;
        }
        #cls_bg_icon{
            background: #fff2d6;
            max-width: 80px;
        }

        .badge {
            vertical-align: middle;
            padding: 7px 12px;
            font-weight: 500;
            border-radius: 30px;
            font-size: 11px;
        }

        .bg_red {
            background-color: #CE181E;
        }

        .bg_yellow {
            background-color: #FAA61A;
        }

    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="card">
            <nav class="navbar navbar-example navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                        <div class="navbar-nav me-auto">
                            <a class="nav-item nav-link active" href="" style="font-size: 18px;"> <i class='bx bx-package'></i> Product</a>
                        </div>
                        <a href="{{ url('add-product') }}" class="btn btn-outline-primary">Add Product</a>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-example navbar-expand-lg bg-light" style="background-color: white !important;">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                        <div class="navbar-nav me-auto">
                            <a class="nav-item nav-link active" href="" style="font-size: 18px;"></a>
                        </div>
                        <form action="{{ route('search.product') }}" method="GET">
                            @csrf
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search..." name="keyword" value="{{ request()->input('keyword') }}">
                                @if(request()->input('keyword') !="")
                                <a class="cls_btn_clear" href="{{ url('view-product') }}">X</a>
                                @endif
                                <button type="submit" class="btn btn-outline-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="posts" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width:20px;">No</th>
                                <th>ProductName</th>
                                <th style="width: 40px;">Thumbnail</th>
                                <th>Branch</th>
                                <th>ProductType</th>
                                <th>Highlight</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count())
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td>{{ $products->firstItem() + $index  }}</td>
                                        <td>{!! Str::limit($product->product_name, 20) !!}</td>
                                        <td>
                                            <img src="{{ url($product->thumbnail == '' ? 'backend/assets/img/avatars/1.png' : '/productImages/' . $product->thumbnail) }}" alt="image" width="40">
                                        </td>
                                        <td>{{ $product->brand_name }}</td>
                                        <td>{{ $product->pro_type_name }}</td>
                                        <td>
                                            @foreach ($getProductSales as $item)
                                                @if ($product->id == $item->product_id && $item->type == "newArrival")
                                                    <span class="badge bg_red">NewArrival</span>
                                                @endif

                                                @if ($product->id == $item->product_id && $item->type == "hotSale")
                                                    <span class="badge bg_yellow">HotSale</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td style="width: 100px">
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a href="{{ url('edit-product', encrypt($product->id)) }}" class="btn btn-outline-secondary"><i class="tf-icons bx bx-edit"></i></a>
                                                <a onclick="return confirm('Are you sure, you want to delete ?')" title="Delete user" href="{{ url('delete-product', encrypt($product->id)) }}" class="btn btn-outline-secondary" style="background-color: red; color:white"><i class="tf-icons bx bx-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" style="text-align: center">
                                        Result not found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
                <div>
                    Showing
                    {{ $products->firstItem() }}
                    to
                    {{ $products->lastItem() }}
                    of
                    {{ $countProduct }}
                    entries
                </div>
                <div>
                    {{  $products->appends(request()->input())->links('paginitaion_backend') }}
                </div>
            </div>

        </div>
    </div>

@endsection