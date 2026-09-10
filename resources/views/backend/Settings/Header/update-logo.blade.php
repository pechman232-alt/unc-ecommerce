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
            width: 150px;
            object-fit: fill;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Header Logos</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-logo', encrypt($logos->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="card-body">
                                    <figure class="text-center mt-2">
                                        <div id="cropie-demo"></div>
                                        {{-- <img id="target" src="{{ asset('backend/assets/img/slider.png') }}" alt class="my-img-2" /> --}}
                                        <img id="target" src="{{ url($logos->value == '' ? 'backend/assets/img/slider.png':'/logos/'.$logos->value) }}" alt class="my-img-2"/>
                                        <input type="file" name="header-logo" id="select_image" onchange="selectImg()"
                                            class="form-control" style="margin-top: 25px;">
                                    </figure>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <a href="{{ url('settings') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
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
