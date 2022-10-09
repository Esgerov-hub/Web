@extends('layouts.app')
@section('weblabs.title')
@lang('menu.contact')
@endsection
@section('weblabs.css')

@endsection
@section('weblabs.content')
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('weblabs/assets/img/weblabs.jpeg') }}">
        <div class="container z-index-common">
            <div class="breadcumb-content"><h1 class="breadcumb-title">@lang('menu.contact')</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('weblabs.index') }}">@lang('menu.home')</a></li>
                        <li>@lang('menu.contact')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="space-top space-extra-bottom">
        <div class="container">

            <div class="tab-content" id="nav-contactTabContent">
                <div class="tab-pane fade show active" id="nav-GermanyAddress" role="tabpanel"
                     aria-labelledby="nav-GermanyAddress-tab">
                    <div class="row">
                        <div class="col-lg-6 mb-30">
                            <div class="contact-box"><h3 class="contact-box__title h4">@lang('menu.baku_address')</h3>
{{--                                <p class="contact-box__text"></p>--}}
                                <br>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="fal fa-phone-alt"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">@lang('menu.sosial_contact')</h4>
                                        <p class="contact-box__info"><a href="tel:{{ $settings->social_network['phone_1'] }}">{!!   $settings->social_network['phone_1'] !!}</a><a
                                                href="mailto:{!!   $settings->social_network['email_1'] !!}">{!!   $settings->social_network['email_1'] !!}</a></p></div>
                                </div>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="far fa-map-marker-alt"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">@lang('menu.address')</h4>
                                        <p class="contact-box__info">{!! $settings->address[app()->getLocale().'_address'] !!}</p></div>
                                </div>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="far fa-clock"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">@lang('menu.work_time')</h4>
                                        <p class="contact-box__info">@lang('menu.work_date')</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-30">
                            <div class="col-12 mt-1" id="submitdataform-response">

                            </div>
                            <div class="contact-box"><h3 class="contact-box__title h4">@lang('menu.we_contact')</h3>
                                <p class="contact-box__text">@lang('menu.help')</p>

                                <form class="contact-box__form ajax-contact" id="submitdataform">
                                    @csrf
                                    <div class="row gx-20">
                                        <div class="col-md-6 form-group"><input type="text" name="namesurname" required
                                                                                placeholder="@lang('menu.name')"> <i
                                                class="fal fa-user"></i></div>
                                        <div class="col-md-6 form-group"><input type="email" name="email" required
                                                                                placeholder="@lang('menu.email')"> <i
                                                class="fal fa-envelope"></i></div>
                                        <div class="col-12 form-group"><input type="text" name="phone" required
                                                                              placeholder="@lang('menu.phone')"> <i
                                                class="fal fa-phone"></i></div>
                                        <div class="col-12 form-group"><input type="text" name="subject" required
                                                                              placeholder="@lang('menu.subject')"> </div>
                                        <div class="col-12 form-group"><textarea name="message"
                                                                                 placeholder="@lang('menu.messages')"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="vs-btn" id="submitbtn">@lang('menu.submit_messages')<i class="far fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>

                                <p class="form-messages mb-0 mt-3"  id="submitdataform-response"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-AustraliaAddress" role="tabpanel"
                     aria-labelledby="nav-AustraliaAddress-tab">
                    <div class="row">
                        <div class="col-lg-6 mb-30">
                            <div class="contact-box"><h3 class="contact-box__title h4">Australia Office Address</h3>
                                <p class="contact-box__text">Completely recaptiualize 24/7 communities via standards
                                    compliant metrics whereas web-enabled content</p>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="fal fa-phone-alt"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">Phone Number & Email</h4>
                                        <p class="contact-box__info"><a href="tel:+310259121563">+(310) 2591 21563</a><a
                                                href="mailto:info@example.com">info@example.com</a></p></div>
                                </div>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="far fa-map-marker-alt"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">Our Office Address</h4>
                                        <p class="contact-box__info">258 Dancing Street, Miland Line, HUYI 21563,
                                            Canberra</p></div>
                                </div>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="far fa-clock"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">Official Work Time</h4>
                                        <p class="contact-box__info">7:00am - 6:00pm ( Mon - Fri ) Sat, Sun & Holiday
                                            Closed</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-30">
                            <div class="contact-box"><h3 class="contact-box__title h4">Leave a Message</h3>
                                <p class="contact-box__text">We’re Ready To Help You</p>
                                <form class="contact-box__form ajax-contact2"
                                      action="https://themeforest.vecuro.com/html/techbiz/demo/mail.php" method="POST">
                                    <div class="row gx-20">
                                        <div class="col-md-6 form-group"><input type="text" name="name" id="name2"
                                                                                placeholder="Your Name"> <i
                                                class="fal fa-user"></i></div>
                                        <div class="col-md-6 form-group"><input type="email" name="email" id="email2"
                                                                                placeholder="Email Address"> <i
                                                class="fal fa-envelope"></i></div>
                                        <div class="col-12 form-group"><select name="subject" id="subject2">
                                                <option selected="selected" disabled="disabled" hidden>Select subject</option>
                                                <option value="Web Development">Web Development</option>
                                                <option value="UI Design">UI Design</option>
                                                <option value="CMS Development">CMS Development</option>
                                                <option value="Theme Development">Theme Development</option>
                                                <option value="Wordpress Development">Wordpress Development</option>
                                            </select></div>
                                        <div class="col-12 form-group"><textarea name="message" id="message2"
                                                                                 placeholder="Type Your Message"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="vs-btn">Submit Message<i class="far fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messages mb-0 mt-3"></p></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="row">
                        <div class="col-lg-6 mb-30">
                            <div class="contact-box"><h3 class="contact-box__title h4">United State Office Address</h3>
                                <p class="contact-box__text">Completely recaptiualize 24/7 communities via standards
                                    compliant metrics whereas web-enabled content</p>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="fal fa-phone-alt"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">Phone Number & Email</h4>
                                        <p class="contact-box__info"><a href="tel:+310259121563">+(310) 2591 21563</a><a
                                                href="mailto:info@example.com">info@example.com</a></p></div>
                                </div>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="far fa-map-marker-alt"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">Our Office Address</h4>
                                        <p class="contact-box__info">258 Dancing Street, Miland Line, HUYI 21563,
                                            NewYork</p></div>
                                </div>
                                <div class="contact-box__item">
                                    <div class="contact-box__icon"><i class="far fa-clock"></i></div>
                                    <div class="media-body"><h4 class="contact-box__label">Official Work Time</h4>
                                        <p class="contact-box__info">7:00am - 6:00pm ( Mon - Fri ) Sat, Sun & Holiday
                                            Closed</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-30">
                            <div class="contact-box"><h3 class="contact-box__title h4">Leave a Message</h3>
                                <p class="contact-box__text">We’re Ready To Help You</p>
                                <form class="contact-box__form ajax-contact3"
                                      action="https://themeforest.vecuro.com/html/techbiz/demo/mail.php" method="POST">
                                    <div class="row gx-20">
                                        <div class="col-md-6 form-group"><input type="text" name="name" id="name3"
                                                                                placeholder="Your Name"> <i
                                                class="fal fa-user"></i></div>
                                        <div class="col-md-6 form-group"><input type="email" name="email" id="email3"
                                                                                placeholder="Email Address"> <i
                                                class="fal fa-envelope"></i></div>
                                        <div class="col-12 form-group"><select name="subject" id="subject3">
                                                <option selected="selected" disabled="disabled" hidden>Select subject</option>
                                                <option value="Web Development">Web Development</option>
                                                <option value="UI Design">UI Design</option>
                                                <option value="CMS Development">CMS Development</option>
                                                <option value="Theme Development">Theme Development</option>
                                                <option value="Wordpress Development">Wordpress Development</option>
                                            </select></div>
                                        <div class="col-12 form-group"><textarea name="message" id="message3"
                                                                                 placeholder="Type Your Message"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="vs-btn">Submit Message<i class="far fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messages mb-0 mt-3"></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('weblabs.js')
    @include('layouts.content.js')
@endsection
