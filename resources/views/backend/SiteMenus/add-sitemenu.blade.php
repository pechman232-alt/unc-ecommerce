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
                    <h5 class="card-header">Add SiteMenus</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('add-sitemenus') }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">SiteMenus Name</label>
                                    <input type="text" class="form-control @error('name') border-danger @enderror" name="name" value="{{ old('name') }}" placeholder="site-menus">
                                </div>
                                {{-- <div class="row col-md-6">
                                    <div class="mb-3 col-md-8">
                                        <label for="formFile" class="form-label">Icon (Photo)</label>
                                        <input type="file" name="icon_photo" id="select_image" onchange="selectImg()" class="form-control @error('icon_photo') border-danger @enderror">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <img id="target" src="{{ asset('backend/assets/img/avatars/pro.png') }}" alt class="my-img-2"/>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-10">
                                    <label class="form-label" for="basic-default-fullname">Details</label>
                                    <textarea name="detail_editer" id="detail_editer">{{ old('detail_editer') }}</textarea>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Cancel</a>
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

        // ---------------------------------
        // CKEDITOR.replace('detail_editer', {
        //     filebrowserUploadUrl: "{{ url('uploadSitemenu', ['_token' => csrf_token()]) }}",
        //     filebrowserUploadMethod: 'form',
        //     // clipboard_handleImagePasting: true,
	    //     // extraPlugins: "customImagePasteHandlerPlugin",
        // });

        ClassicEditor.create( document.querySelector( '#detail_editer' ),{
            ckfinder: {
                uploadUrl: '{{ url('uploadSitemenu').'?_token='.csrf_token()}}',
            }
        })
        .catch( error => {
              
        });

    </script>

@endsection
