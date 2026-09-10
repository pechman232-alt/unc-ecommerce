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
                    <h5 class="card-header">Edit Users</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-users', encrypt($users->id)) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="card-body">
                                    <figure class="text-center mt-2">
                                        <div id="cropie-demo"></div>
                                        <img id="target" src="{{ url($users->picture == '' ? 'backend/assets/img/avatars/1.png': '/userProfile/'. $users->picture) }}" alt class="my-img-2"/>
                                        <input type="file" name="profile_image" id="select_image" onchange="selectImg()" class="form-control" style="margin-top: 25px; ">
                                    </figure>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Full Name</label>
                                    <input class="form-control" type="text" name="full_name" placeholder="fullname" value="{{ $users->full_name }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" placeholder="username" value="{{ $users->username }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" name="email" placeholder="email@example.com" value="{{ $users->email }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Role</label>
                                    <select class="select2 form-select"
                                        name="role_id">
                                        <option value="" disabled selected>Select UserType</option>
                                        @foreach ($userRoles as $userRole)
                                            <option @if ($userRole->id == $users->role_id) selected @endif value="{{ $userRole->id }}" >{{ $userRole->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="*************">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
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
