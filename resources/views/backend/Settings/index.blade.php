@extends('backend.layouts.app-back')
@section('content')
    <style>
        .tiles {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            -moz-column-gap: 1rem;
            column-gap: 1rem;
            row-gap: 1rem;
            margin-top: 1.25rem;
        }

        .tile {
            padding: 1rem;
            border-radius: 8px;
            background-color: #fde9e9;
            background-color: rgb(255 242 239 / 35%);
            border: solid #ffeae7;
            color: var(--c-gray-900);
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            transition: 0.25s ease;
        }

        .tile:hover {
            transform: translateY(-5px);
            /* transform: scale(1.1) */
        }

        .tile:focus-within {
            box-shadow: 0 0 0 2px var(--c-gray-800), 0 0 0 4px var(--c-olive-500);
        }

        .tile:nth-child(2) {
            /* background-color: var(--c-green-500); */
            background-color: rgb(255 242 239 / 35%);
        }

        .tile:nth-child(2):focus-within {
            box-shadow: 0 0 0 2px var(--c-gray-800), 0 0 0 4px var(--c-green-500);
        }

        .tile:nth-child(3) {
            /* background-color: var(--c-gray-300); */
            background-color: rgb(255 242 239 / 35%);
        }

        .tile:nth-child(3):focus-within {
            box-shadow: 0 0 0 2px var(--c-gray-800), 0 0 0 4px var(--c-gray-300);
        }

        .tile a {
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
        }

        .tile a .icon-button {
            color: inherit;
            border-color: inherit;
        }

        .tile a .icon-button:hover,
        .tile a .icon-button:focus {
            background-color: transparent;
        }

        .tile a .icon-button:hover i,
        .tile a .icon-button:focus i {
            transform: none;
        }

        .tile a:focus {
            box-shadow: none;
        }

        .tile a:after {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .tile-header {
            display: flex;
            align-items: center;
        }

        .tile-header i {
            font-size: 2.5em;
        }

        .tile-header h3 {
            display: flex;
            flex-direction: column;
            line-height: 1.375;
            margin-left: 0.5rem;
        }

        .tile-header h3 span:first-child {
            font-weight: 600;
        }

        .tile-header h3 span:last-child {
            font-size: 0.7em;
            font-weight: 200;
        }

        .header-font-size {
            font-size: 1.3rem;
        }

        .bxs-right-arrow-circle {
            color: orange;
        }

        .bxs-right-arrow-circle:hover {
            color: #CE181E;
        }

        .layout-page {
            background-color: white;
        }

        .bg-footer-theme {
            background-color: white !important;
        }

    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1>Header</h1>
        <hr class="my-0">
        <div class="tiles">
            <article class="tile">
                <div class="tile-header">
                    <i class="ph-student-light"></i>
                    <h3>
                        <span class="header-font-size">Logos</span>
                        <span>Click to Edit and Updated</span> 
                    </h3>
                </div>

               {{-- កូដដែលបានកែរួច --}}
                <a href="{{ url('update-logo', isset($logos->id) ? encrypt($logos->id) : '') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>

            </article>

            <article class="tile">
                <div class="tile-header">
                    <i class="ph-chalkboard-teacher-light"></i>
                    <h3>
                        <span class="header-font-size">Icons & SiteName</span>
                        <span>Click to Edit and Updated</span>
                    </h3>
                </div>

                <a href="{{ url('update-sites') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>
            </article>

            <article class="tile">
                <div class="tile-header">
                    <i class="ph-clipboard-text-light"></i>
                    <h3>
                        <span class="header-font-size">Phone Number</span>
                        <span>Click to Edit and Updated</span>
                    </h3>
                </div>
                <a href="{{ url('update-phone-mail') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>
            </article>
        </div>

        <h1 style="padding-top: 25px;">Footer</h1>
        <hr class="my-0">
        <div class="tiles">
            <article class="tile">
                <div class="tile-header">
                    <i class="ph-student-light"></i>
                    <h3>
                        <span class="header-font-size">Easy Link</span>
                        <span>Click to Edit and Updated</span>
                    </h3>
                </div>
                <a href="{{ url('easy-links') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>
            </article>

            <article class="tile">
                <div class="tile-header">
                    <i class="ph-chalkboard-teacher-light"></i>
                    <h3>
                        <span class="header-font-size">Contact Us</span>
                        <span>Click to Edit and Updated</span>
                    </h3>
                </div>

                <a href="{{ url('contact-us') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>
            </article>

            <article class="tile">
                <div class="tile-header">
                    <i class="ph-clipboard-text-light"></i>
                    <h3>
                        <span class="header-font-size">Follow Us</span>
                        <span>Click to Edit and Updated</span>
                    </h3>
                </div>
                <a href="{{ url('img-followUs') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>
            </article>

            <article class="tile">
                <div class="tile-header">
                    <i class="ph-clipboard-text-light"></i>
                    <h3>
                        <span class="header-font-size">Payment ACCEPET</span>
                        <span>Click to Edit and Updated</span>
                    </h3>
                </div>
                <a href="{{ url('img-payment') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>
            </article>
        </div>

        <h1 style="padding-top: 25px;">Others</h1>
        <hr class="my-0">
        <div class="tiles">
            <article class="tile">
                <div class="tile-header">
                    <i class="ph-student-light"></i>
                    <h3>
                        <span class="header-font-size">Color Code and Text Footer</span>
                        <span>Click to Edit and Update</span>
                    </h3>
                </div>
                <a href="{{ url('update-color-code') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>
            </article>

            <article class="tile">
                <div class="tile-header">
                    <i class="ph-chalkboard-teacher-light"></i>
                    <h3>
                        <span class="header-font-size">Socia Chat</span>
                        <span>Click to Edit and Updated</span>
                    </h3>
                </div>

                <a href="{{ url('update-link-chat') }}">
                    <span style="color: black;"></span>
                    <i class='bx bxs-right-arrow-circle' style="font-size: 30px;"></i>
                </a>
            </article>
        </div>
    </div>
@endsection
