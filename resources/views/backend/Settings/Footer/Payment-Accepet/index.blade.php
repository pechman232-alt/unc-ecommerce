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
            height: 50px;
            width: auto;
            object-fit: fill;
            /* border-radius: 50%; */
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
                    <h5 class="card-header">Image PaymentAccepet</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        @foreach ($getImages as $getImage)
                            <nav class="navbar navbar-example navbar-expand-lg bg-light" style="color: white;">
                                <div class="container-fluid">
                                    <div class="collapse navbar-collapse" id="navbar-ex-3">
                                        <div class="navbar-nav me-auto">
                                            <img src="{{ url($getImage->value == '' ? 'backend/assets/img/avatars/pro.png':'/logos/'.$getImage->value) }}" alt class="my-img-2"/>
                                        </div>
                                        <a onclick="return confirm('Are you sure, you want to delete?')" href="{{ url('delete-imagePayment', encrypt($getImage->id)) }}" onclick="" class="btn btn-outline-primary">Delete</a>
                                    </div>
                                </div>
                            </nav>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Upload Image PaymentAccepet Logo</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('upload-imgPayment') }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="formFile" class="form-label">Images (Photo)</label>
                                    <input type="file" name="img_payment" id="select_image" onchange="selectImg()" class="form-control">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <img id="target" src="{{ asset('backend/assets/img/avatars/pro.png') }}" alt class="my-img-2"/>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">Insert</button>
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
