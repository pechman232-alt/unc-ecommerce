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
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit & Update Sitename</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-site-name', encrypt($siteName->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sitename</label>
                                <input type="text" class="form-control" name="value" placeholder="site-name" value="{{ $siteName->value }}">
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('settings') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit & Update Site Icons</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-site-icon',encrypt($sitesIcon->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="formFile" class="form-label">Icon (Photo)</label>
                                    <input type="file" name="site-icon" id="select_image" onchange="selectImg()" class="form-control">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <img id="target" src="{{ url($sitesIcon->value == '' ? 'backend/assets/img/avatars/pro.png':'/logos/'.$sitesIcon->value) }}" alt class="my-img-2"/>
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
