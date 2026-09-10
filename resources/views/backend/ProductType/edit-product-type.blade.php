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
            background-color: #fff2d6;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Edit ProductType</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-profuct-type', encrypt($product_types->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Name Product Type</label>
                                    <input type="text" class="form-control" name="type_name" placeholder="product-type" value="{{ $product_types->type_name }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Add ToMenu</label>
                                    <select name="menu_id" class="form-select">
                                        <option disabled>--- Select Option ---</option>
                                        @foreach ($sitemenus as $sitemenu)
                                            <option @if ($sitemenu->id == $product_types->menu_id) selected @endif value="{{ $sitemenu->id }}">{{ $sitemenu->name }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('product-type') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                            <input type="hidden" name="last_url" value="{{  URL::previous() }}">
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
