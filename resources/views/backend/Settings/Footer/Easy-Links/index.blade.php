@extends('backend.layouts.app-back')
@section('content')
    <style>
        .rounded-circle {
            object-fit: fill;
        }

        .my-img {
            background: black;
            height: 200px;
            width: 200px;
            border-radius: 50%;
        }

        .my-img-2 {
            height: 70px;
            width: 70px;
            object-fit: fill;
            border-radius: 50%;
            background-color: #fff2d6;
        }

        .navbar.bg-light {
            background-color: white !important;
            border: 1px solid rgb(238, 238, 237);
            border-radius: 5px;
            margin-bottom: 5px;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Easy Links</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        @foreach ($easyLinks as $easyLink)
                            <nav class="navbar navbar-example navbar-expand-lg bg-light" style="color: white;">
                                <div class="container-fluid">
                                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                                        <div class="navbar-nav me-auto">
                                            <a class="nav-item nav-link">{{ $easyLink->name }}</a>
                                        </div>
                                        <a onclick="return confirm('Are you sure, you want to delete?')" href="{{ url('delete-easyLinks', encrypt($easyLink->id)) }}" class="btn btn-outline-primary">Delete</a>
                                    </div>
                                </div>
                            </nav>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Insert SiteMenu to Easy Links</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('insert-easylinks') }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Select SiteMenu</label>
                                    <select name="menu_id" class="form-select @error('menu_id') border-danger @enderror">
                                        <option value=""  disabled selected>Please Select Menu</option>
                                        @foreach ($getSiteMenus as $getSiteMenu)
                                            <option value="{{ $getSiteMenu->id }}"  @if (old('menu_id') == $getSiteMenu->id){{ 'selected' }} @endif>{{ $getSiteMenu->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div>
                                <button type="submit1" class="btn btn-primary me-2">Insert</button>
                                <a href="{{ url('settings') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
