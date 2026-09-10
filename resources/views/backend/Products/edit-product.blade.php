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

        .form-select option:first {
            color: #999;
        }
        
        .form-switch .form-check-input {
            width: 50px;
            height: 25px;
        }

    </style>

    <style>
        .output {
            width: 100%;
            min-height: 150px;
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 15px;
            position: relative;
            border-radius: 5px;
        }

        .output .image {
            height: 100px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }

        .output .image img {
            height: 100%;
            width: 100%;
        }

        .output .image span {
            position: absolute;
            top: -4px;
            right: 4px;
            cursor: pointer;
            font-size: 22px;
            color: black;
        }

        .output .image span:hover {
            opacity: 0.8;
        }

        .output .span--hidden {
            visibility: hidden;
        }

        #target {
            margin-left: 30px;
        }
    </style>





    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Product</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-product', encrypt($editProduct->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-2">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="basic-default-fullname">Select ProductType</label>
                                    <select id="pro_type_id" onchange="selectProduct(this);" name="pro_type_id"
                                        class="form-select">
                                        <option>Select ProductTypes</option>
                                        @foreach ($productTypes as $product_type)
                                            <option @if ($product_type->id == $editProduct->pro_type_id) selected @endif value="{{ $product_type->id }}">{{ $product_type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="basic-default-fullname">Select Brand</label>
                                    <select id="add_brand" name="brand_id"
                                        class="form-select @error('brand_id') border-danger @enderror">
                                        <option value="" disabled selected>Select Brand</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="basic-default-fullname">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" value="{{ $editProduct->product_name }}" placeholder="enter product name">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="basic-default-fullname">Original price</label>
                                    <input type="text" class="form-control" name="original_price" value="{{ $editProduct->original_price }}" placeholder="enter original price">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="basic-default-fullname">Price after discount</label>
                                    <input type="text" class="form-control" name="price_after_discount" value="{{ $editProduct->price_after_discount }}" placeholder="enter price after discount">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-5">
                                            <label class="form-label" for="basic-default-fullname">New Arrival</label>
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" name="isNewArrival" value="1" @if($isNewArrival) checked @endif>
                                            </div>
                                        </div>
                             
                                        <div class="col-5">
                                            <label class="form-label" for="basic-default-fullname">Hot Sale</label>
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" name="isHotSale" value="1" @if($isHotSale) checked @endif>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-10">
                                    <label class="form-label" for="basic-default-fullname">Details</label>
                                    <textarea name="detail_editer" id="detail_editer">{{ $editProduct->details }}</textarea>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="mb-3 col-md-5">
                                    <div class="form-group">
                                        <label>Thumnail:</label>
                                        <input type="file" value="{{ old('product_image') }}" name="product_image" id="select_image" onchange="selectImg()" class="form-control @error('product_image') border-danger @enderror">
                                    </div>
                                    <img id="target" class="mt-3 mb-2" src="{{ url($editProduct->thumbnail == '' ? 'backend/assets/img/example-images/thumnail.png':'/productImages/'.$editProduct->thumbnail) }}" alt="" width="65%"/>
                                    {{-- <img id="target" class="mt-3 mb-2" src="{{ url('backend/assets/img/example-images/thumnail.png') }}" alt="" width="65%"> --}}
                                </div>
                                <div class="mb-3 col-md-5">
                                    <div class="form-group" style="padding-bottom: 15px;">
                                        <label>Images Detail:</label>
                                        <input type="file" name="product_images[]" id="select-image" multiple accept="image/*" class="form-control">
                                    </div>
                                    <div class="output" id="images">
                                        @foreach ($productDetail as $item)
                                            <div class="image">
                                                <img src="{{ url($item->image_name == '' ? 'backend/assets/img/example-images/thumnail.png':'/productDetails/'.$item->image_name) }}" alt="image">
                                                <a onclick="return confirm('Are you sure, you want to delete?')" href="{{ url('delete-imagedetail', encrypt($item->id)) }}"><span>&times;</span></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-3" style="text-align: right;">
                                <a href="{{ url('view-product') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                            </div>
                            <input type="hidden" name="last_url" value="{{  URL::previous() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var mySelect = document.getElementById("pro_type_id");

            if (mySelect.value != "") {
                console.log("hello");
                selectProduct(mySelect);
            }
        })

        function selectProduct(pro_type_id) {
            // console.log(pro_type_id.value);
            var option = "";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ url('get-brands') }}",
                dataType: "json",
                data: {
                    id: pro_type_id.value
                },

                success: function(data) {
                    
                    var branch_name_id = "{{ $editProduct->brand_name_id }}";
                    console.log();
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            option += `<option value="` + data[i]['id']+`"`;

                           if(branch_name_id == data[i]['id']){
                            option+="selected";
                            };
                            option+=  `{{ old('brand_id') }}>` + data[i]["name"] + `</option>`;
                        }
                        $('#add_brand').append(option);
                    } else {
                        $('#add_brand').empty();
                        option = '<option value="" disabled selected>Select Brand</option>';
                        $('#add_brand').append(option);
                    }
                }

            });
        }
    </script>

    <script>
        // ---------------------------------------------------- //

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

        // ---------------------------------------------------- //

        const fileInput = document.getElementById('select-image');
        const show_images = document.getElementById('images');

        let imagesArray = []

        fileInput.addEventListener("change", () => {
            const files = fileInput.files
            for (let i = 0; i < files.length; i++) {
                imagesArray.push(files[i])
            }
            displayImages()
        })

        function displayImages() {
            let images = ""
            imagesArray.forEach((image, index) => {
                images += `<div class="image">
                                <img src="${URL.createObjectURL(image)}" alt="image">
                                <span onclick="deleteImage(${index})">&times;</span>
                            </div>`
            })
            show_images.innerHTML = images
        }

        function deleteImage(index) {
            imagesArray.splice(index, 1)
            displayImages()
        }

        // ---------------------------------------------------- //

        // CKEDITOR.replace('detail_editer', {
        //     filebrowserUploadUrl: "{{ url('image-upload', ['_token' => csrf_token()]) }}",
        //     filebrowserUploadMethod: 'form'
        // });

        ClassicEditor.create( document.querySelector( '#detail_editer' ),{
            ckfinder: {
                uploadUrl: '{{ url('image-upload').'?_token='.csrf_token()}}',
            }
        })
        .catch( error => {
              
        });
    </script>
@endsection
