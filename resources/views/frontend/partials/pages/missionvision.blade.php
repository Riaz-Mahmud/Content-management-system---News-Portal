@extends('frontend.layout.app')





@section('content') 


@include('frontend.layout.topbar')
@include('frontend.layout.menu')
@include('frontend.layout.register')



                <div class="breadcrumbs-header fl-wrap">
                    <div class="container">
                        <div class="breadcrumbs-header_url">
                            <a href="#">Home</a><span>Mission Vision</span>
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

                    <!--section   -->
                    <section >
                        <div class="container">
                            <!-- mission section Start -->
                            <div class="row" style="padding-bottom:60px">
                                   <div class="col-md-4">
                                    <div class="about-img fl-wrap"  style=" text-align: right;">
                                        <!-- <img  src="images/logo.png" class="respimg" alt=""> -->
                                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                         <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_6bgnnlrr.json"  background="transparent"  speed="1"  style="width: 350px; height: 350px;padding-top:20px paddig-right:355px"  loop  autoplay></lottie-player>
                                    </div>
                                </div>
                                
                                <div class="col-md-1"></div>

                                <div class="col-md-6">
                                    <div class="section-title ">
                                        <h2>Our Mission</h2>
                                    </div>
                                    <div class="about-wrap">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. </p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. </p>
                                        <a href="https://www.youtube.com/watch?v=UHRlzjsL3JQ" class="btn float-btn color-btn image-popup"> <span>Our Mission Video</span> <i class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>

                            </div>
                            <!-- mission Scetion end  -->

                            <!-- Vision Section Start -->
                            <div class="row" style="padding-top:60px">

                            <div class="col-md-6">
                                    <div class="section-title ">
                                        <h2>Our Vision </h2>
                                    </div>
                                    <div class="about-wrap">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. </p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. </p>
                                        <a href="https://www.youtube.com/watch?v=MJ6YL3IekYs" class="btn float-btn color-btn image-popup"> <span>Our Vision Video</span> <i class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-1"></div>

                                <div class="col-md-4">
                                    <div class="about-img fl-wrap"  style=" text-align: right;">
                                        <img  src="https://w7.pngwing.com/pngs/231/592/png-transparent-vision-statement-businessperson-company-management-vision-angle-company-text.png" class="respimg" alt="">
                                        <!-- <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                         <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_6bgnnlrr.json"  background="transparent"  speed="1"  style="width: 350px; height: 350px;padding-top:20px paddig-right:355px"  loop  autoplay></lottie-player> -->
                                    </div>
                                </div>

                            </div>
                            <!-- vision section End  -->

                        </div>
                        <div class="sec-dec"></div>
                    </section>
                    <!--about end   -->


                    
@include('frontend.layout.footer')


 @endsection 