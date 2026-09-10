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
                    <h5 class="card-header">Add Branch</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('add-brand') }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">BrandName</label>
                                    <input type="text" class="form-control @error('name') border-danger @enderror" name="name" placeholder="enter brandname" value="{{ old('name') }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Select ProductType</label>
                                    <select name="pro_type_id" class="form-select @error('pro_type_id') border-danger @enderror">
                                        <option value=""  disabled selected>Select ProductTypes</option>
                                        @foreach ($product_types as $product_type)
                                            <option value="{{ $product_type->id }}"  @if (old('pro_type_id') == $product_type->id){{ 'selected' }} @endif>{{ $product_type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <a href="{{ url('brand') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
