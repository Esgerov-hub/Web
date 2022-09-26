<div class="space" data-bg-src="/weblabs/assets/img/bg/brand-bg-2-1.jpg">
    <div class="container">
        <div class="row vs-carousel text-center" data-slide-show="5" data-md-slide-show="3" data-sm-slide-show="2"
             data-xs-slide-show="2">
            @foreach($partners as $partner)
            <div class="col-auto"><img src="{{ $partner->image }}" alt="Brand"></div>
            @endforeach

        </div>
    </div>
</div>
<footer class="footer-wrapper footer-layout3">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm footer-info_group style2">
                    <div class="footer-info">
                        <div class="footer-info_icon"><i class="fal fa-map-marker-alt"></i></div>
                        <div class="media-body"><span class="footer-info_label">Office Address</span>
                            <div class="footer-info_link">{{ $settings->address[app()->getLocale().'_address'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm footer-info_group style2">
                    <div class="footer-info">
                        <div class="footer-info_icon"><i class="fal fa-clock"></i></div>
                        <div class="media-body"><span class="footer-info_label">Working Hours</span>
                            <div class="footer-info_link">Weekdays 8am - 22pm Weekend 10am - 12pm</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm footer-info_group style2">
                    <div class="footer-info">
                        <div class="footer-info_icon"><i class="fal fa-phone-volume"></i></div>
                        <div class="media-body"><span class="footer-info_label">Contact Us</span>
                            <div class="footer-info_link"><a href="mailto:{{ $settings->social_network['email_1'] }}">{{ $settings->social_network['email_1'] }}</a><br><a
                                    href="tel:{{ $settings->social_network['phone_1'] }}">{{ $settings->social_network['phone_1'] }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-lg-4 col-xl-auto">
                    <div class="widget footer-widget"><h3 class="widget_title">About Us</h3>
                        <div class="vs-widget-about"><p class="footer-text">Intrinsicly evisculate emerging cutting edge
                                scenarios redefine future-proof e-markets demand line</p>
                            <div class="footer-social">
                                <a href="{{ $settings->social_network['facebook_url'] }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ $settings->social_network['instagram_url'] }}"><i class="fab fa-instagram"></i></a>
                                <a href="{{ $settings->social_network['linkedin_url'] }}"><i class="fab fa-linkedin"></i></a>
                                <a href="{{ $settings->social_network['whatsapp_1'] }}"><i class="fab fa-whatsapp"></i></a>
                                <a href="{{ $settings->social_network['telegram_url_1'] }}"><i class="fab fa-telegram"></i></a>
                                <a href="{{ $settings->social_network['youtube_url'] }}"><i class="fab fa-youtube"></i></a></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-auto">
                    <div class="widget footer-widget"><h3 class="widget_title">Office Maps</h3>
                        <div class="footer-map">
                            <iframe title="office location map"
                                    src="{{ $settings->social_network['gmaps_url'] }}"
                                    width="200" height="180" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container"><p class="copyright-text">Copyright <i class="fal fa-copyright"></i> 2022 <a
                    class="text-white" href="{{ route('weblabs.index') }}">WebLabs</a>. All rights reserved by
            </p></div>
    </div>
</footer>
