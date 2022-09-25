<div class="preloader">

    <div class="preloader-inner"><span class="loader"></span></div>
</div>

<div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
        <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo"><a href="{{ route('weblabs.index') }}"><img src="{{ $settings->logos['logo_lt_web'] }}" alt="TechBiz" class="logo"></a>
        </div>
        <div class="vs-mobile-menu">
            <ul>
                <li><a href="{{ route('weblabs.index') }}">Home</a>
                </li>
                <li><a href="{{ route('weblabs.about') }}">About Us</a></li>
                <li ><a href="{{ route('weblabs.service') }}">Service</a>
                </li>
                <li><a href="{{ route('weblabs.project') }}">Project</a></li>
                <li><a href="{{ route('weblabs.teams') }}">Teams</a></li>
                <li><a href="{{ route('weblabs.contact') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="sidemenu-wrapper d-none d-lg-block">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <div class="widget">
            <div class="vs-widget-about">
                <div class="footer-logo"><a href="{{ route('weblabs.index') }}"><img src="{{ $settings->logos['logo_lt_web'] }}" alt="TechBiz" class="logo"></a>
                </div>
                <p class="footer-text">Intrinsicly evisculate emerging cutting edge scenarios redefine future-proof
                    e-markets demand line</p>
                <div class="footer-social"><a href="#"><i class="fab fa-facebook-f"></i></a> <a href="#"><i
                            class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-instagram"></i></a> <a href="#"><i
                            class="fab fa-behance"></i></a> <a href="#"><i class="fab fa-youtube"></i></a></div>
            </div>
        </div>
        <div class="widget"><h4 class="widget_title">Gallery Posts</h4>
            <div class="sidebar-gallery">
                <div class="gallery-thumb"><img src="{{ asset('weblabs/assets/img/widget/gal-1-1.jpg') }}" alt="Gallery Image" class="w-100">
                </div>
                <div class="gallery-thumb"><img src="{{ asset('weblabs/assets/img/widget/gal-1-2.jpg') }}" alt="Gallery Image" class="w-100">
                </div>
                <div class="gallery-thumb"><img src="{{ asset('weblabs/assets/img/widget/gal-1-3.jpg') }}" alt="Gallery Image" class="w-100">
                </div>
                <div class="gallery-thumb"><img src="{{ asset('weblabs/assets/img/widget/gal-1-4.jpg') }}" alt="Gallery Image" class="w-100">
                </div>
                <div class="gallery-thumb"><img src="{{ asset('weblabs/assets/img/widget/gal-1-5.jpg') }}" alt="Gallery Image" class="w-100">
                </div>
                <div class="gallery-thumb"><img src="{{ asset('weblabs/assets/img/widget/gal-1-6.jpg') }}" alt="Gallery Image" class="w-100">
                </div>
            </div>
        </div>
        <div class="widget"><h3 class="widget_title">Office Maps</h3>
            <div class="footer-map">
                <iframe title="office location map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d163720.11965853968!2d8.496481908353967!3d50.121347879150306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bd096f477096c5%3A0x422435029b0c600!2sFrankfurt%2C%20Germany!5e0!3m2!1sen!2sbd!4v1651732317319!5m2!1sen!2sbd"
                        width="200" height="180" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<header class="vs-header header-layout3">

    <div class="header-top">
        <div class="container">
            <div class="row align-items-center justify-content-between text-center text-lg-start">
                <div class="col-md-auto text-center text-md-start">
                    <div class="header-links style-white">
                        <ul>
                            <li class="d-none d-xxl-inline-block"><i class="fal fa-map-marker-alt"></i>2529 Pen Road,
                                New York
                            </li>
                            <li><i class="far fa-clock"></i>Mon - Fri: 8:00AM - 6:00PM</li>
                            <li><i class="far fa-envelope"></i><a
                                    href="mailto:{{ $settings->social_network['email_1'] }}">{{ $settings->social_network['email_1'] }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto d-none d-md-block">
                    <div class="header-social style-white"><span class="social-title">Follow Us On: </span>
                        <a href="{{ $settings->social_network['facebook_url'] }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings->social_network['instagram_url'] }}"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $settings->social_network['telegram_url_1'] }}"><i class="fab fa-telegram"></i></a>
                        <a href="{{ $settings->social_network['whatsapp_1'] }}"><i class="fab fa-whatsapp"></i></a>
                        <a href="{{ $settings->social_network['linkedin_url'] }}"><i class="fab fa-linkedin"></i></a>
                        <a href="{{ $settings->social_network['youtube_url'] }}"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <div class="sticky-active">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="header-logo"><a href="{{ route('weblabs.index') }}"><img src="{{ $settings->logos['logo_lt_web'] }}" alt="TechBiz"
                                                                           class="logo"></a></div>
                    </div>
                    <div class="col-auto">
                        <nav class="main-menu menu-style3 d-none d-lg-block">
                            <ul>
                                <li ><a href="{{ route('weblabs.index') }}">Home</a></li>
                                <li><a href="{{ route('weblabs.about') }}">About Us</a></li>
                                <li ><a href="{{ route('weblabs.service') }}">Service</a></li>
                                <li ><a href="{{ route('weblabs.project') }}">Project</a>
                                <li><a href="{{ route('weblabs.contact') }}">Contact</a></li>
                                <li class="menu-item-has-children"><a href="">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                                    <ul class="sub-menu">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                @if($properties['native'] != LaravelLocalization::getCurrentLocaleNative())
                                                    <li><a hreflang="{{ $localeCode }}"
                                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                            {{ $properties['native'] }}</a></li>
                                                @endif
                                            @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
