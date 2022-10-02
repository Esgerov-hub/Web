@extends('layouts.app')
@section('weblabs.title')
    @lang('menu.project')
@endsection
@section('weblabs.css')

@endsection
@section('weblabs.content')
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('weblabs/assets/img/breadcumb/breadcumb-bg.jpg') }}">
        <div class="container z-index-common">
            <div class="breadcumb-content"><h1 class="breadcumb-title">Projects</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('weblabs.index') }}">Home</a></li>
                        <li>Projects</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row filter-active">
               @foreach($data as $project)
                <div class="col-xl-3 col-xxl-auto filter-item">
                    <div class="project-style2">
                        <div class="project-img">
                            <div class="project-shape"></div>
                            <img src="{{ $project->image }}" alt="project"> <a href="{{ $project->image }}"
                                                                                      class="icon-btn style4 popup-image"><i
                                    class="far fa-search"></i></a></div>
                        <div class="project-content"><span class="project-label">{{ $project->category->name[app()->getLocale().'_name'] }}</span>
                            <h3 class="project-title h5"><a href="{{ $project->url }}">{{ $project->title[app()->getLocale().'_name'] }}</a></h3></div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
@section('weblabs.js')

@endsection
