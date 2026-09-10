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

    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="card">
            <nav class="navbar navbar-example navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                        <div class="navbar-nav me-auto">
                            <a class="nav-item nav-link active" href="" style="font-size: 18px;"> <i class='bx bx-package'></i> ProductType</a>
                        </div>
                        <a href="{{ url('create-product-type') }}" class="btn btn-outline-primary">Add ProductType</a>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-example navbar-expand-lg bg-light" style="background-color: white !important;">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                        <div class="navbar-nav me-auto">
                            <a class="nav-item nav-link active" href="" style="font-size: 18px;"></a>
                        </div>
                        <form action="{{ route('search.product-type') }}" method="GET">
                            @csrf
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search..." name="keyword" value="{{ request()->input('keyword') }}">
                                @if(request()->input('keyword') !="")
                                <a class="cls_btn_clear" href="{{ url('product-type') }}">X</a>
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
                                <th style="width:50px;">No</th>
                                <th>Type Name</th>
                                <th>SiteMenus</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($product_types->count())
                                @foreach ($product_types as $index => $product_type)
                                    <tr>
                                        <td>{{ $product_types->firstItem() + $index  }}</td>
                                        <td>{{ $product_type->type_name }}</td>
                                        <td>
                                            {{ $product_type->sitemenu }}
                                        </td>
                                        <td>{{ $product_type->created_by != '' ? $product_type->created_by:'-' }}</td>
                                        <td>{{ $product_type->updated_by != '' ? $product_type->updated_by:'-' }}</td>
                                        <td>
                                            <a href="" class="badge {{ $product_type->status == '1' ? 'bg-label-success' : 'bg-label-warning' }} me-1"> {{ $product_type->status == '1' ? 'Active' : 'Pending' }} </a>
                                        </td>
                                        <td style="width: 100px">
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a href="{{ url('edit-product-type/'.encrypt($product_type->id)) }}" class="btn btn-outline-secondary"><i class="tf-icons bx bx-edit"></i></a>
                                                <a onclick="return confirm('Are you sure, you want to delete ?')" title="Delete user" href="{{ url('delete-product-type/'.encrypt($product_type->id)) }}" class="btn btn-outline-secondary" style="background-color: red; color:white"><i class="tf-icons bx bx-trash"></i></a>
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
                    {{ $product_types->firstItem() }}
                    to
                    {{ $product_types->lastItem() }}
                    of
                    {{ $countProduct_types }}
                    entries
                </div>
                <div>
                    {{  $product_types->appends(request()->input())->links('paginitaion_backend') }}
                </div>
            </div>

        </div>
    </div>

@endsection