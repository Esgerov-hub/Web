@extends('layouts.app')
@section('weblabs.title')
    @lang('menu.home')
@endsection
@section('weblabs.css')

@endsection
@section('weblabs.content')
    <section class="vs-hero-wrapper position-relative">
        <div class="vs-hero-carousel" data-height="980" data-container="1900" data-slidertype="responsive">
            @foreach($sliders as $slider)
                <div class="ls-slide" data-ls="duration:12000; transition2d:5; kenburnszoom:in; kenburnsscale:1.1;"><img
                        width="1920" height="980" src="{{ $slider->bg_image }}" class="ls-bg" alt="slider-bg">
                    <img
                        width="664" height="522" src="{{ asset('weblabs/assets/img/hero/hero-shape-2-2.png') }}"
                        class="ls-l ls-hide-phone ls-img-layer d-hd-none" alt="image"
                        style="font-size:36px; color:#000; text-align:left; font-style:normal; text-decoration:none; text-transform:none; font-weight:400; letter-spacing:0px; border-style:solid; border-color:#000; background-position:0% 0%; background-repeat:no-repeat; top:463px; left:-6px;"
                        data-ls="offsetxin:left; offsetyin:bottom; durationin:1500; delayin:1400; easingin:easeOutQuint; offsetxout:left; offsetyout:bottom;">
                    <img width="1923" height="90" src="{{ asset('weblabs/assets/img/hero/hero-shape-2-1.png') }}"
                         class="ls-l ls-hide-phone ls-img-layer d-hd-none" alt="hero shape"
                         style="font-size:36px; color:#000; text-align:left; font-style:normal; text-decoration:none; text-transform:none; font-weight:400; letter-spacing:0px; background-position:0% 0%; background-repeat:no-repeat; top:894px; left:-13px;"
                         data-ls="easingin:easeOutQuint; static:forever;">
                    <div
                        style="-webkit-text-stroke: 1px rgba(255,255,255,0.10); font-size:300px; text-align:center; font-style:normal; text-decoration:none; text-transform:uppercase; font-weight:600; letter-spacing:0px; border-style:solid; border-color:#000; background-position:0% 0%; background-repeat:no-repeat; font-family:Exo; width:1700px; left:50%; top:290px; color:rgba(255, 255, 255, 0.05);"
                        class="ls-l ls-text-layer"
                        data-ls="durationin:1500; delayin:1000; parallax:true; parallaxlevel:8; parallaxaxis:x;">WEBLABS
                    </div>
{{--                    <p style="font-size:20px; text-align:center; font-style:normal; text-decoration:none; text-transform:none; font-weight:600; letter-spacing:0px; background-position:0% 0%; background-repeat:no-repeat; font-family:Exo; color:#ffffff; top:315px; left:50%; width:1000px;"--}}
{{--                       class="ls-l ls-hide-tablet ls-hide-phone ls-text-layer"--}}
{{--                       data-ls="offsetxin:300; durationin:1500; delayin:400; easingin:easeOutQuint; offsetxout:300; durationout:1500; easingout:easeOutQuint;">--}}
{{--                        {{ $slider->name[app()->getLocale().'_name'] }}</p>--}}
                    <h1 style="top:370px; left:50%; text-align:center; font-weight:700; background-size:inherit; background-position:inherit; font-size:72px; color:#ffffff; font-family:Exo; width:1000px;"
                        class="ls-l ls-hide-tablet ls-hide-phone ls-text-layer"
                        data-ls="offsetxin:-200; durationin:1500; easingin:easeOutQuint; offsetxout:-100; durationout:1500; easingout:easeOutQuint; position:relative;">
                        {{ $slider->name[app()->getLocale().'_name'] }}</h1>
                    <div
                        style="top:595px; left:50%; text-align:center; font-weight:700; background-size:inherit; background-position:inherit; font-size:24px; width:1000px;"
                        class="ls-l ls-hide-tablet ls-hide-phone ls-html-layer"
                        data-ls="offsetyin:50; durationin:1500; delayin:900; easingin:easeOutQuint; offsetyout:50; durationout:1500; easingout:easeOutQuint; position:relative;">
                        <div class="ls-btn-group justify-content-center"><a href="{{ route('weblabs.about') }}"
                                                                            class="vs-btn ls-hero-btn">ABOUT
                                US<i class="far fa-arrow-right"></i></a></div>
                    </div>
{{--                    <p style="text-align:center; font-style:normal; text-decoration:none; text-transform:none; font-weight:600; letter-spacing:0px; background-position:0% 0%; background-repeat:no-repeat; font-family:Exo; color:#ffffff; top:310px; left:50%; width:1000px; font-size:40px;"--}}
{{--                       class="ls-l ls-hide-desktop ls-hide-phone ls-text-layer"--}}
{{--                       data-ls="offsetxin:300; durationin:1500; delayin:400; easingin:easeOutQuint; offsetxout:300; durationout:1500; easingout:easeOutQuint;">--}}
{{--                        {{ $slider->name[app()->getLocale().'_name'] }}</p>--}}
                    <h1 style="top:404px; left:50%; text-align:center; font-weight:700; background-size:inherit; background-position:inherit; font-size:110px; color:#ffffff; font-family:Exo; width:1200px;"
                        class="ls-l ls-hide-desktop ls-hide-phone ls-text-layer"
                        data-ls="offsetxin:-200; durationin:1500; easingin:easeOutQuint; offsetxout:-100; durationout:1500; easingout:easeOutQuint; position:relative;">
                        {{ $slider->name[app()->getLocale().'_name'] }}</h1>
                    <div
                        style="top:713px; left:50%; text-align:center; font-weight:700; background-size:inherit; background-position:inherit; font-size:24px; width:1000px; height:28px;"
                        class="ls-l ls-hide-desktop ls-hide-phone ls-html-layer"
                        data-ls="offsetyin:50; durationin:1500; delayin:900; easingin:easeOutQuint; offsetyout:50; durationout:1500; easingout:easeOutQuint; position:relative;">
                        <div class="ls-btn-group justify-content-center"><a href="{{ route('weblabs.service') }}"
                                                                            class="vs-btn ls-hero-btn">Service<i
                                    class="far fa-arrow-right"></i></a></div>
                    </div>
                    <div
                        style="font-size:36px; color:#000; text-align:left; font-style:normal; text-decoration:none; text-transform:none; font-weight:400; letter-spacing:0px; border-style:solid; border-color:#000; background-position:0% 0%; background-repeat:no-repeat; left:50%; top:145px; width:120px; height:120px; line-height:120px;"
                        class="ls-l ls-play-btn ls-hide-desktop ls-hide-phone ls-html-layer"
                        data-ls="offsetxin:-100; durationin:1500; delayin:1000; easingin:easeOutQuint; offsetxout:-100; durationout:1500; easingout:easeOutQuint; bgcolorout:transparent; colorout:transparent;">
                        <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn style4 popup-video"><i
                                class="fas fa-play"></i></a></div>
                    <h1 style="top:132px; left:50%; text-align:center; font-weight:700; background-size:inherit; background-position:inherit; font-size:140px; color:#ffffff; font-family:Exo; width:1800px;"
                        class="ls-l ls-hide-desktop ls-hide-tablet ls-text-layer"
                        data-ls="offsetxin:-200; durationin:1500; easingin:easeOutQuint; offsetxout:-100; durationout:1500; easingout:easeOutQuint; position:relative;">
                        {{ $slider->name[app()->getLocale().'_name'] }}</h1>
                    <div
                        style="top:599px; left:50%; text-align:center; font-weight:700; background-size:inherit; background-position:inherit; font-size:24px; width:1000px; height:28px;"
                        class="ls-l ls-hide-desktop ls-hide-tablet ls-html-layer"
                        data-ls="offsetyin:50; durationin:1500; delayin:900; easingin:easeOutQuint; offsetyout:50; durationout:1500; easingout:easeOutQuint; position:relative;">
                        <div class="ls-btn-group justify-content-center"><a href="{{ route('weblabs.project') }}"
                                                                            class="vs-btn ls-hero-btn">Projects<i
                                    class="far fa-arrow-right"></i></a></div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <section class="space-top space-extra-bottom" data-bg-src="{{ asset('weblabs/assets/img/bg/sr-bg-3-1.jpg') }}">
        <div class="container wow fadeInUp" data-wow-delay="0.2s">
            <div class="row justify-content-center justify-content-lg-between align-items-center">
                <div class="col-md-8 col-lg-6 text-center text-lg-start">
                    <div class="title-area">
                        <h2 class="sec-title3 h1">We Provide Great IT & Business Solutions</h2></div>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <div class="sec-btns2"><a href="{{ route('weblabs.service') }}" class="vs-btn">View All Services<i
                                class="far fa-arrow-right"></i></a></div>
                </div>
            </div>
            <div class="row vs-carousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2"
                 data-sm-slide-show="2">
                @foreach($services as $service)
                    <div class="col-xl-3">
                        <div class="service-style3">
                            <div class="service-front">
                                <div class="service-img"><img src="{{ $service->bg_image }}" alt="image" class="w-100">
                                </div>
                                <div class="service-content">
                                    <div class="service-icon"><img
                                            src="{{ asset('weblabs/assets/img/icon/sr-icon-3-1.png') }}" alt="icon">
                                    </div>
                                    <h3 class="service-title h6"><a
                                            href="{{ route('weblabs.service_details',$service->id) }}">{{ $service->name[app()->getLocale().'_name'] }}</a>
                                    </h3></div>
                            </div>
                            <div class="service-back">
                                <div class="service-content">
                                    <div class="service-icon"><img
                                            src="{{ asset('weblabs/assets/img/icon/sr-icon-3-1.png') }}" alt="icon">
                                    </div>
                                    <h3 class="service-title h6"><a class="text-inherit"
                                                                    href="{{ route('weblabs.service_details',$service->id) }}">{{ $service->name[app()->getLocale().'_name'] }}</a>
                                    </h3>
                                    <p class="service-text">{{ $service->name[app()->getLocale().'_name'] }}</p>
                                    <a
                                        href="{{ route('weblabs.service_details',$service->id) }}" class="link-btn">Read
                                        Details<i
                                            class="far fa-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="z-index-common space-top" data-sec-pos="bottom" data-pos-amount="30px" data-pos-for="#aboutv2">
        <div class="space" data-bg-src="/weblabs/assets/img/bg/counter-bg-2-1.jpg">
            <div class="container">
                <div class="row justify-content-between gy-4">

                    <div class="col-6 col-lg-auto">
                        <div class="counter-media">
                            <div class="counter-media__icon"><img src="/weblabs/assets/img/icon/count-1-2.png"
                                                                  alt="icon"></div>
                            <div class="media-body"><span class="counter-media__number h1 text-white">{{ $projects->count() }}</span>
                                <p class="counter-media__title text-white">Projects</p></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-auto">
                        <div class="counter-media">
                            <div class="counter-media__icon"><img src="/weblabs/assets/img/icon/count-1-3.png"
                                                                  alt="icon"></div>
                            <div class="media-body"><span
                                    class="counter-media__number h1 text-white">{{ $services->count() }}</span>
                                <p class="counter-media__title text-white">Services</p></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-auto">
                        <div class="counter-media">
                            <div class="counter-media__icon"><img src="/weblabs/assets/img/icon/count-1-4.png"
                                                                  alt="icon"></div>
                            <div class="media-body"><span
                                    class="counter-media__number h1 text-white">{{ $partners->count() }}</span>
                                <p class="counter-media__title text-white">Partners</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-top">
        <div class="container wow fadeInUp" data-wow-delay="0.2s">
            <div class="row justify-content-between">
                <div class="col-lg-auto text-center text-lg-start">
                    <div class="title-area">
                        <h2 class="sec-title3 h1">Our Successful Projects</h2></div>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <div class="sec-btns">
                        <button class="vs-btn style4" data-slick-prev="#projectslide1"><i class="far fa-arrow-left"></i>Prev
                        </button>
                        <button class="vs-btn style4" data-slick-next="#projectslide1">Next<i
                                class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid overflow-hidden px-xxl-0">
            <div class="row vs-carousel" data-slide-show="4" data-ml-slide-show="3" data-lg-slide-show="3"
                 data-md-slide-show="2" id="projectslide1">
                @foreach($projects as $project)
                    <div class="col-xl-3">
                        <div class="project-style2">
                            <div class="project-img"><img src="{{ $project->image }}" alt="project">
                                <div class="project-shape"></div>
                                <a href="{{ $project->image }}" class="popup-image icon-btn style3"><i
                                        class="far fa-search"></i></a></div>
                            <div class="project-content"><span
                                    class="project-label">{{ $project->category->name[app()->getLocale().'_name'] }}</span>
                                <h3 class="project-title h5"><a href="{{ $project->url }}"
                                                                class="text-reset">{{ $project->title[app()->getLocale().'_name'] }}</a>
                                </h3></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
@section('weblabs.js')

@endsection
