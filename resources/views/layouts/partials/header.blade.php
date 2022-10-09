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
                <li><a href="{{ route('weblabs.index') }}">@lang('menu.home')</a>
                </li>
                <li><a href="{{ route('weblabs.about') }}">@lang('menu.about')</a></li>
                <li ><a href="{{ route('weblabs.service') }}">@lang('menu.service')</a>
                </li>
                <li><a href="{{ route('weblabs.project') }}">@lang('menu.project')</a></li>
{{--                <li><a href="{{ route('weblabs.teams') }}">Teams</a></li>--}}
                <li><a href="{{ route('weblabs.contact') }}">@lang('menu.contact')</a></li>
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
        </div>
    </div>
</div>

<header class="vs-header header-layout3">

    <div class="header-top">
        <div class="container-xl">
            <div class="row align-items-center justify-content-between text-center text-lg-start">
                <div class="col-md-auto text-center text-md-start">
                    <div class="header-links style-white">
                        <ul>

                            <li><i class="far fa-clock"></i>@lang('menu.mon') - @lang('menu.fri'): 9:00AM - 6:00PM</li>
                            <li><i class="far fa-envelope"></i><a
                                    href="mailto:{{ $settings->social_network['email_1'] }}">{{ $settings->social_network['email_1'] }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto d-none d-md-block">
                    <div class="header-social style-white"><span class="social-title">@lang('menu.follow'): </span>
                        <a href="{{ $settings->social_network['facebook_url'] }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings->social_network['instagram_url'] }}"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $settings->social_network['linkedin_url'] }}"><i class="fab fa-linkedin"></i></a>
                        <a href="{{ $settings->social_network['whatsapp_1'] }}"><i class="fab fa-whatsapp"></i></a>
                        <a href="{{ $settings->social_network['telegram_url_1'] }}"><i class="fab fa-telegram"></i></a>
                        <a href="{{ $settings->social_network['youtube_url'] }}"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <div class="sticky-active">
            <div class="container-xl">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="header-logo"><a href="{{ route('weblabs.index') }}"><img src="{{ $settings->logos['logo_lt_web'] }}" alt="WebLabs"
                                                                           class="logo"></a></div>
                    </div>

                    <div class="col-auto">
                        <nav class="main-menu menu-style3 d-none d-lg-block">
                            <ul>
                                <li ><a href="{{ route('weblabs.index') }}" >@lang('menu.home')</a></li>
                                <li><a href="{{ route('weblabs.about') }}">@lang('menu.about')</a></li>
                                <li ><a href="{{ route('weblabs.service') }}">@lang('menu.service')</a></li>
                                <li ><a href="{{ route('weblabs.project') }}">@lang('menu.project')</a>
                                <li><a href="{{ route('weblabs.contact') }}">@lang('menu.contact')</a></li>
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
