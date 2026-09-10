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
            height: 200px;
            width: 200px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Add Users</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('add-users') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-6">
                                <div class="card-body">
                                    <figure class="text-center mt-2">
                                        <div id="cropie-demo"></div>
                                        <img id="target" src="{{ asset('backend/assets/img/avatars/1.png') }}" alt class="my-img-2"/>
                                        <input type="file" name="profile_image" id="select_image" onchange="selectImg()" class="form-control" style="margin-top: 25px; ">
                                    </figure>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Full Name</label>
                                    <input class="form-control @error('full_name') border-danger @enderror" type="text" name="full_name" value="{{ old('full_name') }}" placeholder="fullname">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Username</label>
                                    <input class="form-control @error('username') border-danger @enderror" type="text" name="username" value="{{ old('username') }}" placeholder="username">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control @error('email') border-danger @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="email@example.com">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Role</label>
                                    <select class="select2 form-select @error('role_id') border-danger @enderror"
                                        name="role_id">
                                        <option value="" disabled selected>Select UserType</option>
                                        @foreach ($userRoles as $userRole)
                                            <option value="{{ $userRole->id }}" @if (old('role_id') == $userRole->id){{ 'selected' }} @endif>{{ $userRole->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Password</label>
                                    <input class="form-control @error('password') border-danger @enderror" type="password"
                                        name="password" placeholder="*************">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <a href="{{ url('users') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
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
