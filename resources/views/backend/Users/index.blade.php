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
                            <a class="nav-item nav-link active" href="" style="font-size: 18px;"> <i
                                    class='bx bx-package'></i> Users</a>
                        </div>
                        <a href="{{ url('create-users') }}" class="btn btn-outline-primary">Add Users</a>
                    </div>
                </div>
            </nav>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th style="width:25px;">No</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>User Role</th>
                                <th>Profile</th>
                                <th>status</th>
                                <th style="text-align: center">Created By</th>
                                <th style="text-align: center">Updated By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <span
                                            class="badge {{ (($user->role_id == 1 ? 'bg-label-success' : $user->role_id == 2) ? 'bg-label-warning' : $user->role_id == 3) ? 'bg-label-info' : 'bg-label-info' }} me-1">{{ $user->role_name }}</span>
                                    </td>
                                    <td>
                                        <img src="{{ url($user->picture == '' ? 'backend/assets/img/avatars/1.png' : '/userProfile/' . $user->picture) }}"
                                            alt="image" width="50" style="border-radius: 50px">
                                    </td>
                                    <td>
                                        <a href="" class="badge {{ $user->status == '1' ? 'bg-label-success' : 'bg-label-warning' }} me-1">{{ $user->status == '1' ? 'Active' : 'Pending' }} </a>
                                    </td>
                                    <td style="text-align: center">{{ $user->created_by != '' ? $user->created_by:'-' }}</td>
                                    <td style="text-align: center">{{ $user->updated_by != '' ? $user->updated_by:'-' }}</td>

                                    <td style="width: 100px">
                                        <div class="btn-group" role="group" aria-label="First group">

                                            @if (auth('user')->user() && $user->id == auth('user')->user()->id)
                                                <a href="{{ url('edit-users', encrypt($user->id)) }}" class="btn btn-outline-secondary"><i class="tf-icons bx bx-edit"></i></a>
                                            @else
                                                <a href="{{ url('edit-users', encrypt($user->id)) }}" class="btn btn-outline-secondary"><i class="tf-icons bx bx-edit"></i></a>
                                                <a onclick="return confirm('Are you sure, you want to delete?')" href="{{ url('delete-users',encrypt($user->id)) }}" class="btn btn-outline-secondary" style="background-color: red; color:white"><i class="tf-icons bx bx-trash"></i></a>
                                            @endif

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


        $(document).ready(function() {
            $('.offcanvasTop').click(function(e) {
                e.preventDefault();

                var id = $(this).val();
                $('#id').val(id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
