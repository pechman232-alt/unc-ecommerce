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

        .dataTables_filter {
            margin-bottom: 20px;
        }

        .dataTables_paginate,
        .dataTables_info {
            margin-top: 20px;
        }

        table#datatable {
            border: 1px solid #ccc;
        }

        table.dataTable thead>tr>th.sorting:after,
        table.dataTable thead>tr>th.sorting_asc:after {
            display: none;
        }

        table.dataTable thead>tr>th.sorting:before,
        table.dataTable thead>tr>th.sorting_asc:before {
            display: none;
        }

        #datatable thead tr th {
            height: 35px;
            background-color: #fde9e9;
        }

        #datatable thead tr th,
        #datatable tbody tr td {
            text-align: center;
        }

        .offcanvas-top {
            height: 210px;
        }
    </style>



    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="card">
            <nav class="navbar navbar-example navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                        <div class="navbar-nav me-auto">
                            <a class="nav-item nav-link active" href="" style="font-size: 18px;"> <i
                                    class='bx bxs-school'></i> Brand-Name</a>
                        </div>
                        <a href="{{ url('create-brand') }}" class="btn btn-outline-primary">Add Brand-Name</a>
                    </div>
                </div>
            </nav>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th>Branch Name</th>
                                <th>ProductType</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $index => $brand)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->pro_type_name }}</td>
                                    <td>{{ $brand->created_by != '' ? $brand->created_by:'-' }}</td>
                                    <td>{{ $brand->updated_by != '' ? $brand->updated_by:'-' }}</td>
                                    <td>
                                        <a href="" class="badge {{ $brand->status == '1' ? 'bg-label-success' : 'bg-label-warning' }} me-1">{{ $brand->status == '1' ? 'Active' : 'Pending' }} </a>
                                    </td>
                                    <td style="width: 100px">
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a href="{{ url('edit-brand', encrypt($brand->id)) }}" class="btn btn-outline-secondary"><i class="tf-icons bx bx-edit"></i></a>
                                            <a onclick="return confirm('Are you sure, you want to delete?')" href="{{ url('delete-brand', encrypt($brand->id)) }}" class="btn btn-outline-secondary" style="background-color: red; color:white"><i class="tf-icons bx bx-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#datatable').DataTable({
            "iDisplayLength": 25
        });
    </script>
@endsection
