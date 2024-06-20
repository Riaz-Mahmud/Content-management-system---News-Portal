@extends('frontend.layout.app')





@section('content') 


@include('frontend.layout.topbar')
@include('frontend.layout.menu')
@include('frontend.layout.register')



<div class="breadcrumbs-header fl-wrap">
    <div class="container">
        <div class="breadcrumbs-header_url">
            <a href="#">Home</a><span>OUR Team</span>
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
<div class="main-container fl-wrap fix-container-init">
                                       
    <!--   row-->
    <div class="container">
         <div class="section-title">
        <h3>Team Member:</h3>

    </div>
        <div class="row">
         
        <!--   shop-item-->
 
        <!--   shop-item-->
        <div class="col-md-3">
            <div class="det-box">
                <a href="product-single.html" class="det-box-media">
                    <span>Details</span><img src="{{URL::to('/assets/frontend/images/avatar/4.png')}}" alt="" class="respimg">
                    
                </a>
                <div class="det-box-ietm dbig dbi_shop fl-wrap">
                    <h3><a href="product-single.html">Tanim Shariar</a></h3>
                    <p>Granny help you treat yourself with a empor scelerisque different meal everyday.</p>
                    <div class="reviews_counter_wrap">
                       
                        
                    </div>
                    <div class="grid-item_price fl-wrap">
                        <span class="grid-item_price_item rent-price"><strong>Web developer</strong></span>
                        <div class="add_cart"><i class="fab fa-facebook-f"></i></div>
                     
                    </div>
                </div>
            </div>
        </div>
                    <!--   shop-item end-->
         
                    <!--   shop-item-->
                    <div class="col-md-3">
                        <div class="det-box">
                            <a href="product-single.html" class="det-box-media">
                                <span>Details</span><img src="{{URL::to('/assets/frontend/images/avatar/203.png')}}" alt="" class="respimg">
                                
                            </a>
                            <div class="det-box-ietm dbig dbi_shop fl-wrap">
                                <h3><a href="product-single.html">Tanim Shariar</a></h3>
                                <p>Granny help you treat yourself with a empor scelerisque different meal everyday.</p>
                                <div class="reviews_counter_wrap">
                                   
                                    
                                </div>
                                <div class="grid-item_price fl-wrap">
                                    <span class="grid-item_price_item rent-price"><strong>Web developer</strong></span>
                                    <div class="add_cart"><i class="fab fa-facebook-f"></i></div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--   shop-item end-->
                    <!--   shop-item-->
                    <div class="col-md-3">
                        <div class="det-box">
                            <a href="product-single.html" class="det-box-media">
                                <span>Details</span><img src="{{URL::to('/assets/frontend/images/avatar/3.png')}}" alt="" class="respimg">
                                
                            </a>
                            <div class="det-box-ietm dbig dbi_shop fl-wrap">
                                <h3><a href="product-single.html">Tanim Shariar</a></h3>
                                <p>Granny help you treat yourself with a empor scelerisque different meal everyday.</p>
                                <div class="reviews_counter_wrap">
                                   
                                    
                                </div>
                                <div class="grid-item_price fl-wrap">
                                    <span class="grid-item_price_item rent-price"><strong>Web developer</strong></span>
                                    <div class="add_cart"><i class="fab fa-facebook-f"></i></div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--   shop-item end-->
           
                    
                    <!--   shop-item-->
                    <div class="col-md-3">
                        <div class="det-box">
                            <a href="product-single.html" class="det-box-media">
                                <span>Details</span><img src="{{URL::to('/assets/frontend/images/avatar/1.png')}}" alt="" class="respimg">
                                
                            </a>
                            <div class="det-box-ietm dbig dbi_shop fl-wrap">
                                <h3><a href="product-single.html">Tanim Shariar</a></h3>
                                <p>Granny help you treat yourself with a empor scelerisque different meal everyday.</p>
                                <div class="reviews_counter_wrap">
                                   
                                    
                                </div>
                                <div class="grid-item_price fl-wrap">
                                    <span class="grid-item_price_item rent-price"><strong>Web developer</strong></span>
                                    <div class="add_cart"><i class="fab fa-facebook-f"></i></div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>


        <!--   shop-item end-->

        </div>
    </div>
    <!--  row end-->
    <div class="clearfix"></div>
 
    <!--pagination-->

    <!--pagination end-->                               
</div>
@include('frontend.layout.footer')


 @endsection 