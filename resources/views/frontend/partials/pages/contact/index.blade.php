@extends('frontend.layout.app')

@section('title', 'Contact Us')

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />


    <!--section   -->
    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="{{ route('home')}}">Home</a><span>Contact Us</span>
            </div>
            <div class="scroll-down-wrap">
                <div class="mousey">
                    <div class="scroller"></div>
                </div>
                <span>Scroll Down To Discover</span>
            </div>
        </div>
        <div class="pwh_bg"></div>
    </div>
    <!-- section end  -->

    <!--section   -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="pr-subtitle prs_big">Details</div>
                    <!--card-item -->
                    <ul class="contacts-list fl-wrap">
                        <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a>{{$data['settings']['contact_us_address']->settings_value}}</a></li>
                        <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="tel:{{$data['settings']['contact_us_phone']->settings_value}}">{{$data['settings']['contact_us_phone']->settings_value}}</a></li>
                        <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="mailto:{{$data['settings']['contact_us_email']->settings_value}}">{{$data['settings']['contact_us_email']->settings_value}}</a></li>
                    </ul>
                    <!--card-item end -->
                    <div class="contact-social fl-wrap">
                        <span class="cs-title">Find us on: </span>
                        <x-frontend.social-icon.social-icon :position="'contact-page'" />
                    </div>
                    <!-- box-widget -->
                    {{-- <div class="box-widget-content fl-wrap">
                        <div class="banner-widget fl-wrap">
                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                <div class="bg" data-bg="images/all/about.jpg"></div>
                            </div>
                            <div class="banner-widget_content">
                                <h5>Visit our awesome merch and souvenir online shop.</h5>
                                <a href="#" class="btn float-btn color-bg small-btn">OUR MISSION</a>
                            </div>
                        </div>
                    </div> --}}
                    <!-- box-widget  end -->
                </div>
                <div class="col-md-8">
                    <div class="pad-con fl-wrap">
                        <div class="pr-subtitle prs_big">Drop us a line</div>
                        <p>We love to hear from you! Please contact us with any questions or comments.</p>
                        <div id="contact-form" style="margin-top: 20px;">
                            <div id="message"></div>
                            <form  class="custom-form" action="{{route('page.contact.store')}}" method="post">
                                @csrf
                                <fieldset>
                                    <input type="text" name="name" id="name" placeholder="Your Name *" value="" required />
                                    <input type="text"  name="email" id="email" placeholder="Email Address*" value="" required />
                                    <textarea name="message"  id="message" cols="40" rows="3" placeholder="Your Message:" required></textarea>
                                </fieldset>
                                <button class="btn color-bg float-btn" id="submit">Send message <i class="fas fa-caret-right"></i></button>
                            </form>
                        </div>
                        <!-- contact form  end-->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="pad-con fl-wrap">
                        <div class="pr-subtitle prs_big">Location</div>
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2478.8526606597884!2d-3.3323337635707087!3d51.58926369654757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x486e17738af4af8d%3A0x30bb597229fd6ef2!2sUniversity%20of%20South%20Wales%2C%20Treforest%20Campus!5e0!3m2!1sen!2suk!4v1726482911024!5m2!1sen!2suk" width="100%" height="450"
                            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

 @endsection
