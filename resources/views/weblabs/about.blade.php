@extends('layouts.app')
@section('weblabs.title')
@lang('menu.about')
@endsection
@section('weblabs.css')

@endsection
@section('weblabs.content')

    <div class="breadcumb-wrapper" data-bg-src="{{ asset('weblabs/assets/img/weblabs.jpeg') }}">
        <div class="container z-index-common">
            <div class="breadcumb-content"><h1 class="breadcumb-title">@lang('menu.about')</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('weblabs.index') }}">@lang('menu.home')</a></li>
                        <li>@lang('menu.about')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section data-bg-src="{{ asset('weblabs/assets/img/bg/about-bg-5-1.jpg') }}">
        <div class="container container-style1">
            @foreach($data as $about)
            <div class="row flex-row-reverse align-items-center gx-70">
                <div class="col-lg-6 col-xl"><img src="{{ $about->bg_image }}" alt="about image"></div>
                <div class="col-lg-6 col-xl-auto wow fadeInUp" data-wow-delay="0.2s">
                    <div class="about-box2">

                        <h2 class="sec-title3 h1">{{ $about->name[app()->getLocale().'_name'] }}</h2>
                        <p>{!! $about->description[app()->getLocale().'_description'] !!}</p>

                        <div class="row gx-0 align-items-center flex-row-reverse justify-content-end mt-sm-3 pt-sm-3 mb-30 pb-10">

                            <div class="col-sm-auto">
                                <div class="about-call">
                                    <div class="about-call__icon"><i class="fas fa-phone-alt"></i></div>
                                    <div class="media-body"><span class="about-call__label">@lang('menu.we_contact')</span>
                                        <p class="about-call__number"><a href="tel:{{ $settings->social_network['phone_1'] }}">{{ $settings->social_network['phone_1'] }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('weblabs.contact') }}" class="vs-btn">@lang('menu.contact')<i class="far fa-long-arrow-right"></i></a></div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection
@section('weblabs.js')

@endsection
