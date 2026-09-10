@extends('backend.layouts.app-back')
@section('content')
    <style>
        .navbar.bg-light {
            /* background-color: #fde9e9 !important; */
            background-color: #fff2d6 !important;
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
            background-color: #fff2d6;
        }
        #datatable thead tr th, #datatable tbody tr td{
            text-align: center;
        }

    </style>



    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="card">
            <nav class="navbar navbar-example navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                        <div class="navbar-nav me-auto">
                            <a class="nav-item nav-link active" href="" style="font-size: 18px;"> <i class='bx bx-package'></i> SLIDERS</a>
                        </div>
                        <a href="{{ url('create-slide') }}" class="btn btn-outline-primary">Add Slider</a>
                    </div>
                </div>
            </nav>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th>Name (Photo)</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $index => $slider)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ url($slider->name == '' ? 'backend/assets/img/avatars/1.png' : '/slider/' . $slider->name) }}" alt="image" width="150">
                                    </td>
                                    <td>{{ $slider->created_by != '' ? $slider->created_by:'-' }}</td>
                                    <td>{{ $slider->updated_by != '' ? $slider->updated_by:'-' }}</td>
                                    <td>
                                        {{-- <a class="badge {{ $slider->status == '1' ? 'bg-label-success' : 'bg-label-warning' }} me-1"> {{ $slider->status == '1' ? 'Active' : 'Pending' }} </a> --}}
                                        <input data-id="{{$slider->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $slider->status ? 'checked' : '' }}>
                                    </td>
                                    <td style="width: 100px">
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a href="{{ url('edit-slide',encrypt($slider->id)) }}" class="btn btn-outline-secondary"><i class="tf-icons bx bx-edit"></i></a>
                                            <a onclick="return confirm('Are you sure, you want to delete?')" href="{{ url('delete-slide',encrypt($slider->id)) }}" class="btn btn-outline-secondary" style="background-color: red; color:white"><i class="tf-icons bx bx-trash"></i></a>
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

        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var id = $(this).data('id'); 
                
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'sliderStatus',
                    data: {'status': status, 'id': id},
                    success: function(data){
                    console.log(data.success)
                    }
                });
            })
        })
    </script>

@endsection