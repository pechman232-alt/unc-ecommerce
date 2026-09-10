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
            border-radius: 50%;
            background-color: #fff2d6;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alert')

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit & Update Chat Links</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-linkchat', encrypt($getLinkChat->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Link Messenger</label>
                                <input type="text" class="form-control" name="link" placeholder="enter link chat" value="{{ $getLinkChat->link }}">
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('settings') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit & Update Chat Links</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{ url('update-linktelegram', encrypt($getLinkTelegram->id)) }}" method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Link Telegram</label>
                                <input type="text" class="form-control" name="link" placeholder="enter link telegram" value="{{ $getLinkTelegram->link }}">
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('settings') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
