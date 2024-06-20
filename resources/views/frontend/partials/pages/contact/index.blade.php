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
                <a href="#">Home</a><span>Contact Us</span>
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
                        <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a>{{$data['contact_address']}}</a></li>
                        <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="tel:{{$data['contact_phone']}}">{{$data['contact_phone']}}</a></li>
                        <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="mailto:{{$data['contact_email']}}">{{$data['contact_email']}}</a></li>
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
                            <form  class="custom-form" action="{{route('contact.store')}}" method="post">
                                @csrf
                                <fieldset>
                                    <input type="text" name="name" id="name" placeholder="Your Name *" value=""/>
                                    <input type="text"  name="email" id="email" placeholder="Email Address*" value=""/>
                                    <textarea name="message"  id="message" cols="40" rows="3" placeholder="Your Message:"></textarea>
                                </fieldset>
                                <button class="btn color-bg float-btn" id="submit">Send message <i class="fas fa-caret-right"></i></button>
                            </form>
                        </div>
                        <!-- contact form  end-->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

 @endsection
