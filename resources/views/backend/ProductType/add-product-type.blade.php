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
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Add ProductType</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('add-product-type') }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Name Product Type</label>
                                    <input type="text" class="form-control @error('type_name') border-danger @enderror" name="type_name" value="{{ old('type_name') }}" placeholder="product-type">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Add ToMenu</label>
                                    <select name="menu_id" class="form-select @error('menu_id') border-danger @enderror">
                                        <option value=""  disabled selected>--- Select Option ---</option>
                                        @foreach ($sitemenus as $sitemenu)
                                            <option value="{{ $sitemenu->id }}"  @if (old('menu_id') == $sitemenu->id){{ 'selected' }} @endif>{{ $sitemenu->name }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <a href="{{ url('product-type') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
