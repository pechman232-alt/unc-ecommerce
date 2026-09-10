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
            height: auto;
            width: 100%;
            object-fit: fill;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Add Slider</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('add-slide') }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="card-body">
                                    <figure class="text-center mt-2">
                                        <div id="cropie-demo"></div>
                                        <img id="target" src="{{ asset('backend/assets/img/slider.png') }}" alt class="my-img-2"/>
                                        <input type="file" name="image_slider" id="select_image" onchange="selectImg()" class="form-control @error('image_slider') border-danger @enderror" style="margin-top: 25px;">
                                    </figure>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save</button>
                                    <a href="{{ url('slider') }}" class="btn btn-outline-secondary">Cancel</a>
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
