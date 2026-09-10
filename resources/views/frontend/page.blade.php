@extends('frontend.layouts.app-front')
@section('content')

    <style>
        .container p{
            font-family: "Kantumruy Pro", sans-serif;
        }
    </style>

    <main class="main">
        <div class="page-content">
            <div class="container">
                <br>
                <h3 class="">{{ $page->name }}</h3>
                <p>{!! $page->detail !!}<p>
            </div>
        </div>
    </main>
@endsection