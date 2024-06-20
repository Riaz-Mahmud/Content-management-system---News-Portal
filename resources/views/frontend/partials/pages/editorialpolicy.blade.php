@extends('frontend.layout.app')

@section('content') 


@include('frontend.layout.topbar')
@include('frontend.layout.menu')
@include('frontend.layout.register')


        <!--section   -->
        <div class="breadcrumbs-header fl-wrap">
            <div class="container">
                <div class="breadcrumbs-header_url">
                    <a href="#">Home</a><span>Editorial Policy</span>
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
        <section >
            <div class="container">
                <!-- Vision Section Start -->
                <div class="row" style="padding-top:20px">

                <div class="col-md-12">
                        <div class="section-title " style="margin-bottom: 20px; padding-bottom: 15px;">
                            <h2> Policy </h2>
                        </div>
                        <div class="about-wrap" style="padding-bottom: 15px;">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. </p>    
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="section-title " style="margin-bottom: 20px; padding-bottom: 7px;">
                            <h2> Terms  and Condiction </h2>
                        </div>
                        <div class="about-wrap"  style="padding-bottom: 15px;">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit. Quisque varius eros ac purus dignissim. Proin eu ultrices libero. </p>    
                        </div>
                    </div>


                </div>
                <!-- vision section End  -->

            </div>
            <div class="sec-dec"></div>
        </section>
        <!--about end   -->
  
   			
    <div class="aside-panel">
        <ul>
            <li> <a href="category.html"><i class="far  fa-podium"></i><span>Market</span></a></li>
            <li> <a href="category.html"><i class="far fa-atom"></i><span>Technology</span></a></li>
            <li> <a href="category.html"><i class="far fa-user-chart"></i><span>Fossil Fuel</span></a></li>
            <li> <a href="category.html"><i class="far fa-address-book" ></i><span>Renewable Energy</span></a></li>
            <li> <a href="category.html"><i class="far fa-flask"></i><span>Nuclear Energy</span></a></li>
        </ul>
    </div>




@include('frontend.layout.footer')


 @endsection 