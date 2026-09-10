<footer class="footer">
    <style>
        /* --- Footer CSS Variables --- */
        :root {
            --footer-bg: #1a202c; /* Modern dark slate */
            --footer-text: #a0aec0; /* Soft grey text */
            --footer-heading: #ffffff;
            --primary-accent: #CE181E;
            --transition-speed: 0.3s ease;
        }

        .footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            border-top: 4px solid var(--primary-accent);
            padding-top: 3rem;
            font-family: "Kantumruy Pro", sans-serif;
        }

        /* --- Widget Headings --- */
        .footer .widget-title {
            color: var(--footer-heading);
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
        }

        /* Small red underline under headings */
        .footer .widget-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-accent);
        }

        /* --- Easy Links --- */
        .footer .nav {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .footer-middle a {
            color: var(--footer-text);
            text-decoration: none;
            transition: var(--transition-speed);
            display: inline-block;
            font-size: 0.95rem;
        }

        .footer-middle a:hover {
            color: #ffffff;
            transform: translateX(8px); /* Smooth slide to the right */
        }

        /* --- Contact Us Section --- */
        .icon-contacts {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .icon-contacts img {
            width: 22px;
            margin-right: 12px;
            margin-top: 2px;
            filter: brightness(0) invert(1); /* Forces uploaded icons to turn white for the dark background */
            opacity: 0.8;
        }

        .icon-contacts p {
            margin: 0;
            color: var(--footer-text);
        }

        /* --- Follow Us & Socials --- */
        .social-icons-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 2rem;
        }

        .social-icons-wrapper a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            transition: var(--transition-speed);
        }

        .social-icons-wrapper a:hover {
            background-color: var(--primary-accent);
            transform: translateY(-5px); /* Lift up on hover */
        }

        .social-icons-wrapper img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        /* --- Payment Methods --- */
        .payment-icons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .icon-payments {
            width: 55px;
            height: 35px;
            object-fit: contain;
            background-color: #fff;
            padding: 4px;
            border-radius: 4px;
            transition: var(--transition-speed);
        }

        .icon-payments:hover {
            transform: scale(1.1);
        }

        /* --- Footer Bottom --- */
        .footer-bottom {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 1.5rem 0;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
        }

        .footer-copyright {
            color: #718096 !important;
            margin: 0;
            font-size: 0.9rem;
        }

    </style>

    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <!-- Column 1: Easy Links -->
                <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="widget">
                        <h4 class="widget-title">EASY LINKS</h4>
                        <ul class="nav">
                            @foreach ($GET_EASYLINKS as $item)
                                <li>
                                    <a href="{{ url($item->route, encrypt($item->menu_id)) }}">
                                        {{ $item->site_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Column 2: Contact Us -->
                <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="widget">
                        <h4 class="widget-title">CONTACT US</h4>
                        <div class="widget-list">
                            <div class="icon-contacts">
                                <img src="{{ url($GET_LOCATION->link == '' ? 'backend/assets/img/avatars/pro.png' : '/logos/'.$GET_LOCATION->link) }}" alt="Location">
                                <p>{{ $GET_LOCATION->value }}</p>
                            </div>
                            
                            <div class="icon-contacts">
                                <img src="{{ url($GET_EMAIL->link == '' ? 'backend/assets/img/avatars/pro.png' : '/logos/'.$GET_EMAIL->link) }}" alt="Email">
                                <p>{{ $GET_EMAIL->value }}</p>
                            </div>

                            <div class="icon-contacts">
                                <img src="{{ url($GET_NUMBER_FOOTER->link == '' ? 'backend/assets/img/avatars/pro.png' : '/logos/'.$GET_NUMBER_FOOTER->link) }}" alt="Phone">
                                <p>{{ $GET_NUMBER_FOOTER->value }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Follow Us & Payments -->
                <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
                    <!-- Follow Us -->
                    <div class="widget">
                        <h4 class="widget-title">FOLLOW US</h4>
                        <div class="social-icons-wrapper">
                            @foreach ($GET_FOLLOW_US as $item)
                                <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ url($item->value == '' ? 'backend/assets/img/avatars/pro.png' : '/logos/'.$item->value) }}" alt="Social">
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Payment Accept -->
                    <div class="widget mt-4">
                        <h4 class="widget-title">PAYMENT ACCEPTED</h4>
                        <div class="payment-icons">
                            @foreach ($GET_IMAGE_PAYMENT as $item)
                                <img src="{{ url($item->value == '' ? 'backend/assets/img/avatars/pro.png' : '/logos/'.$item->value) }}" alt="Payment Method" class="icon-payments">
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Footer Bottom Copyright -->
    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">{{ $SITE_TEXTFOOTER->value }}</p>
        </div>
    </div>
</footer>