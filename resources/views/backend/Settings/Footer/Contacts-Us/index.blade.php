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
            height: 80px;
            width: 80px;
            object-fit: fill;
            border-radius: 5%;
            padding: 5px;
            /* background-color: #fff2d6; */
            background-color: orange;
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
                    <h5 class="card-header">Locations</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-locations', encrypt($locations->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Enter Locations</label>
                                    <input type="text" class="form-control" name="value" value="{{ $locations->value }}" placeholder="enter">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="formFile" class="form-label">Icon (Photo)</label>
                                    <input type="file" name="icon_photo" id="select_image" onchange="selectImg()" class="form-control">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <img id="target" src="{{ url($locations->link == '' ? 'backend/assets/img/avatars/pro.png':'/logos/'.$locations->link) }}" alt class="my-img-2"/>
                                </div>
                            </div>
                            <div>
                                <button type="submit1" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('settings') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Email</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('updated-emails', encrypt($emails->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Enter Email</label>
                                    <input type="text" class="form-control" name="value" value="{{ $emails->value }}" placeholder="enter">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="formFile" class="form-label">Icon (Photo)</label>
                                    <input type="file" name="icon_photo" id="select_image" onchange="selectImg()" class="form-control">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <img id="target" src="{{ url($emails->link == '' ? 'backend/assets/img/avatars/pro.png':'/logos/'.$emails->link) }}" alt class="my-img-2"/>
                                </div>
                            </div>
                            <div>
                                <button type="submit1" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('settings') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Phonenumber</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-numberphone', encrypt($numberphones->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Enter Phonenumber</label>
                                    <input type="text" class="form-control" name="value" value="{{ $numberphones->value }}" placeholder="enter">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="formFile" class="form-label">Icon (Photo)</label>
                                    <input type="file" name="icon_photo" id="select_image" onchange="selectImg()" class="form-control">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <img id="target" src="{{ url($numberphones->link == '' ? 'backend/assets/img/avatars/pro.png':'/logos/'.$numberphones->link) }}" alt class="my-img-2"/>
                                </div>
                            </div>
                            <div>
                                <button type="submit1" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('settings') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImage(src, target) {
            var fr = new FileReader();
            fr.onload = function() {
                target.src = fr.result;
            }
            fr.readAsDataURL(src.files[0]);
        }

        function selectImg() {
            var src = document.getElementById("select_image");
            var target = document.getElementById("target");
            showImage(src, target);
        }
    </script>
@endsection
