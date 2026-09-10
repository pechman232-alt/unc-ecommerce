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
        /* #datatable thead tr th, #datatable tbody tr td{
            text-align: center;
        } */
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="card">
            <nav class="navbar navbar-example navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                        <div class="navbar-nav me-auto">
                            <a class="nav-item nav-link active" href="" style="font-size: 18px;"> <i class='bx bx-package'></i>Users Role</a>
                        </div>
                        <a href="{{ url('create-roles') }}" class="btn btn-outline-primary">Add Users Role</a>
                    </div>
                </div>
            </nav>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th>Name</th>
                                <th style="text-align: center">Created At</th>
                                <th style="text-align: center">Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userRole as $index => $userRol)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $userRol->name }}</td>
                                    <td style="text-align: center">{{ $userRol->created_at != '' ? $userRol->created_at:'-' }}</td>
                                    <td style="text-align: center">{{ $userRol->updated_at != '' ? $userRol->updated_at:'-' }}</td>
                                    
                                    <td style="width: 100px">
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a href="{{ url('edit-role', encrypt($userRol->id)) }}" class="btn btn-outline-secondary"><i class="tf-icons bx bx-edit"></i></a>
                                            <a onclick="return confirm('Are you sure, you want to delete?')" href="{{ url('delete-role', encrypt($userRol->id)) }}" class="btn btn-outline-secondary" style="background-color: red; color:white"><i class="tf-icons bx bx-trash"></i></a>
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