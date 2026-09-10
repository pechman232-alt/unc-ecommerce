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
            height: 527px;
            width: 1200px;
            object-fit: fill;

        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Brand-Name</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-brand', encrypt($brands->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Brand-Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $brands->name }}" placeholder="enter brandname">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Select ProductType</label>
                                    <select name="pro_type_id" class="form-select">
                                        <option>Select ProductTypes</option>
                                        @foreach ($product_types as $product_type)
                                            <option @if ($product_type->id == $brands->pro_type_id) selected @endif value="{{ $product_type->id }}">{{ $product_type->type_name }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('brand') }}" class="btn btn-outline-secondary">Cancel</a>
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
