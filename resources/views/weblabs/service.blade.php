@extends('layouts.app')
@section('weblabs.title')
@lang('menu.service')
@endsection
@section('weblabs.css')

@endsection
@section('weblabs.content')
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('weblabs/assets/img/breadcumb/breadcumb-bg.jpg') }}">
        <div class="container z-index-common">
            <div class="breadcumb-content"><h1 class="breadcumb-title">Services</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('weblabs.index') }}">Home</a></li>
                        <li>Services</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="space-top space-extra-bottom">
        <div class="container wow fadeInUp" data-wow-delay="0.2s">
            <div class="row">
                @foreach($data as $service)
                <div class="col-xl-3">
                    <div class="service-style3">
                        <div class="service-front">
                            <div class="service-img"><img src="{{ $service->bg_image }}" alt="image" class="w-100">
                            </div>
                            <div class="service-content">
                                <div class="service-icon"><img src="{{ asset('weblabs/assets/img/icon/sr-icon-3-1.png') }}" alt="icon"></div>
                                <h3 class="service-title h6"><a href="{{ route('weblabs.service_details',$service->id) }}">{{ $service->name[app()->getLocale().'_name'] }}</a></h3></div>
                        </div>
                        <div class="service-back">
                            <div class="service-content">
                                <div class="service-icon"><img src="{{ asset('weblabs/assets/img/icon/sr-icon-3-1.png') }}" alt="icon"></div>
                                <h3 class="service-title h6"><a class="text-inherit" href="{{ route('weblabs.service_details',$service->id) }}">{{ $service->name[app()->getLocale().'_name'] }}</a></h3>
                                <p class="service-text">{{ $service->name[app()->getLocale().'_name'] }}</p>
                                <a
                                    href="{{ route('weblabs.service_details',$service->id) }}" class="link-btn">Read Details<i
                                        class="far fa-arrow-right"></i></a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
{{--    <section class="process-wrap1 space-top space-extra-bottom" data-bg-src="{{ asset('weblabs/assets/img/bg/process-bg-3-1.jpg') }}">--}}
{{--        <div class="container wow fadeInUp" data-wow-delay="0.2s">--}}
{{--            <div class="row justify-content-center text-center">--}}
{{--                <div class="col-xl-6">--}}
{{--                    <div class="title-area"><span class="sec-subtitle">What We Do For You</span>--}}
{{--                        <h2 class="sec-title3 h1">Our Specialization</h2></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row justify-content-between">--}}
{{--                <div class="col-md-4 col-xl-auto process-style2">--}}
{{--                    <div class="process-arrow"><img src="{{ asset('weblabs/assets/img/icon/process-arrow-2-1.png') }}" alt="arrow"></div>--}}
{{--                    <div class="process-icon"><img src="{{ asset('weblabs/assets/img/icon/process-1-1.png') }}" alt="icon"> <span--}}
{{--                            class="process-number">01</span></div>--}}
{{--                    <h3 class="process-title h5">Project Planning</h3>--}}
{{--                    <p class="process-text">Internal or "organic" sources without turnkey growth strategies. Seamlessly--}}
{{--                        promote client-centered</p></div>--}}
{{--                <div class="col-md-4 col-xl-auto process-style2">--}}
{{--                    <div class="process-arrow"><img src="{{ asset('weblabs/assets/img/icon/process-arrow-2-1.png') }}" alt="arrow"></div>--}}
{{--                    <div class="process-icon"><img src="{{ asset('weblabs/assets/img/icon/process-1-2.png') }}" alt="icon"> <span--}}
{{--                            class="process-number">02</span></div>--}}
{{--                    <h3 class="process-title h5">Request A Meeting</h3>--}}
{{--                    <p class="process-text">Internal or "organic" sources without turnkey growth strategies. Seamlessly--}}
{{--                        promote client-centered</p></div>--}}
{{--                <div class="col-md-4 col-xl-auto process-style2">--}}
{{--                    <div class="process-arrow"><img src="{{ asset('weblabs/assets/img/icon/process-arrow-2-1.png') }}" alt="arrow"></div>--}}
{{--                    <div class="process-icon"><img src="{{ asset('weblabs/assets/img/icon/process-1-3.png') }}" alt="icon"> <span--}}
{{--                            class="process-number">03</span></div>--}}
{{--                    <h3 class="process-title h5">Start Building</h3>--}}
{{--                    <p class="process-text">Internal or "organic" sources without turnkey growth strategies. Seamlessly--}}
{{--                        promote client-centered</p></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    <section class="space-top space-extra-bottom">--}}
{{--        <div class="container wow fadeInUp" data-wow-delay="0.2s">--}}
{{--            <div class="row justify-content-between">--}}
{{--                <div class="col-lg-auto text-center text-lg-start">--}}
{{--                    <div class="title-area"><span class="sec-subtitle"><i class="fas fa-bring-forward"></i>Our Best Review’s</span>--}}
{{--                        <h2 class="sec-title3 h1">Customer’s Feedback</h2></div>--}}
{{--                </div>--}}
{{--                <div class="col-auto d-none d-lg-block">--}}
{{--                    <div class="sec-btns">--}}
{{--                        <button class="vs-btn style4" data-slick-prev="#testislide1"><i class="far fa-arrow-left"></i>Prev--}}
{{--                        </button>--}}
{{--                        <button class="vs-btn style4" data-slick-next="#testislide1">Next<i class="far fa-arrow-right"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row vs-carousel" data-slide-show="3" data-md-slide-show="2" id="testislide1">--}}
{{--                <div class="col-xl-4">--}}
{{--                    <div class="testi-style1">--}}
{{--                        <div class="testi-icon"><i class="fal fa-quote-right"></i></div>--}}
{{--                        <p class="testi-text">“Contrary to popular belief, Lorem Ipsum is not simply random text over 2000--}}
{{--                            years old. Richard McClintock”</p>--}}
{{--                        <h3 class="testi-name h6">David Smith</h3>--}}
{{--                        <div class="testi-degi">SEO Customer</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4">--}}
{{--                    <div class="testi-style1">--}}
{{--                        <div class="testi-icon"><i class="fal fa-quote-right"></i></div>--}}
{{--                        <p class="testi-text">“Engineer resource maximizing whereas human high quality scenarios via client--}}
{{--                            incentivize next generatio”</p>--}}
{{--                        <h3 class="testi-name h6">Floki Gustaf</h3>--}}
{{--                        <div class="testi-degi">UI Customer</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4">--}}
{{--                    <div class="testi-style1">--}}
{{--                        <div class="testi-icon"><i class="fal fa-quote-right"></i></div>--}}
{{--                        <p class="testi-text">“There are many variations of passages of Lorem Ipsum available, but the--}}
{{--                            majority have suffered alteration”</p>--}}
{{--                        <h3 class="testi-name h6">Jesper Karl</h3>--}}
{{--                        <div class="testi-degi">SEO Customer</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4">--}}
{{--                    <div class="testi-style1">--}}
{{--                        <div class="testi-icon"><i class="fal fa-quote-right"></i></div>--}}
{{--                        <p class="testi-text">“Latin words, combined with a handful of model sentence structures, to--}}
{{--                            generate Lorem Ipsum which looks reasonable”</p>--}}
{{--                        <h3 class="testi-name h6">Luis Luka</h3>--}}
{{--                        <div class="testi-degi">Dev Customer</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection
@section('weblabs.js')

@endsection
