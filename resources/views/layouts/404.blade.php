@extends('layouts.app')
@section('weblabs.title')
   404
@endsection
@section('weblabs.css')

@endsection
@section('weblabs.content')
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('weblabs/assets/img/breadcumb/breadcumb-bg.jpg') }}">
        <div class="container z-index-common">
            <div class="breadcumb-content"><h1 class="breadcumb-title">@lang('menu.error')</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('weblabs.index') }}">@lang('menu.home')</a></li>
                        <li>@lang('menu.error')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="space">
        <div class="container">
            <div class="error-content text-center"><h2 class="error-number">4<span class="text-theme">0</span>4</h2>
                <a href="{{ route('weblabs.index') }}" class="vs-btn"><i
                        class="fas fa-home ms-0 me-2"></i>@lang('menu.home')</a></div>
        </div>
    </section>
@endsection
@section('weblabs.js')

@endsection
