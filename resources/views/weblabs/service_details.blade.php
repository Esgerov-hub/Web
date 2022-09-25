@extends('layouts.app')
@section('weblabs.title')
    @lang('menu.about')
@endsection
@section('weblabs.css')

@endsection
@section('weblabs.content')
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('weblabs/assets/img/breadcumb/breadcumb-bg.jpg') }}">
        <div class="container z-index-common">
            <div class="breadcumb-content"><h1 class="breadcumb-title">Service Details</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('weblabs.index') }}">Home</a></li>
                        <li>Service Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-8">
                    <div class="mb-3 pb-3"><img src="{{ $data->bg_image }}" alt="Project image"></div>
                    <h2 class="h4">{!! $data->name[app()->getLocale().'_name'] !!}</h2>
                    <p>{!! $data->description[app()->getLocale().'_description'] !!}</p>

                </div>
                <div class="col-lg-4">
                    <aside class="service-sidebar">
                        <div class="widget widget_categories"><h3 class="widget_title">All Services</h3>
                            <ul>
                                @foreach($services as $service)
                                <li><a href="{{ route('weblabs.service_details',$service->id) }}">{!! $service->name[app()->getLocale().'_name'] !!}</a></li>
                                @endforeach
                            </ul>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('weblabs.js')

@endsection
