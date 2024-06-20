

@extends('frontend.layout.app')

@section('content') 


@include('frontend.layout.topbar')
@include('frontend.layout.menu')
@include('frontend.layout.register')

<div class="breadcrumbs-header fl-wrap">
    <div class="container">
        <div class="breadcrumbs-header_url">
            <a href="#">Home</a><span>Editor's Details</span>
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
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main-container fl-wrap fix-container-init">
                    <div class="shop-header-title fl-wrap">
                        <div class="row">
                            <div class="col-md-7">
                                <h2>Awesome Merch Wallet</h2>
                                <div class="post-opt single_post-opt">
                                    <ul class="no-list-style">
                                        <li><i class="fal fa-eye"></i> <span>164</span></li>
                                        <li><i class="fal fa-shopping-bag"></i> <span>26</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                         
                            </div>
                        </div>
                    </div>
                    <!-- single-post-media   -->
                    <div class="single-post-media fl-wrap">
                        <div class="single-slider-wrap fl-wrap">
                            <div class="single-slider fl-wrap">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper lightgallery">
                                        <!-- swiper-slide   -->
                                        <div class="swiper-slide hov_zoom">
                                            <img src="{{asset('assets/frontend/images/all/1.jpg')}}" alt="">
                                            <a href="{{asset('assets/frontend/images/all/1.jpg')}}" class="box-media-zoom   popup-image"><i class="fas fa-search"></i></a>
                                        </div>
                                        <!-- swiper-slide end   -->
                                        <!-- swiper-slide   -->
                                        <div class="swiper-slide hov_zoom">
                                            <img src="{{asset('assets/frontend/images/all/2.jpg')}}" alt="">
                                            <a href="{{asset('assets/frontend/images/all/2.jpg')}}" class="box-media-zoom   popup-image"><i class="fas fa-search"></i></a>
                                        </div>
                                        <!-- swiper-slide end   -->
                                        <!-- swiper-slide   -->
                                        <div class="swiper-slide hov_zoom">
                                            <img src="{{asset('assets/frontend/images/all/2.jpg')}}g" alt="">
                                            <a href="{{asset('assets/frontend/images/all/2.jpg')}}" class="box-media-zoom   popup-image"><i class="fas fa-search"></i></a>
                                        </div>
                                        <!-- swiper-slide end   -->
                                    </div>
                                </div>
                            </div>
                            <div class="ss-slider-controls2">
                                <div class="ss-slider-pagination pag-style"></div>
                            </div>
                            <div class="ss-slider-cont ss-slider-cont-prev"><i class="fas fa-caret-left"></i></div>
                            <div class="ss-slider-cont ss-slider-cont-next"><i class="fas fa-caret-right"></i></div>
                        </div>
                    </div>
                    <!-- single-post-media end   -->									
                    <!-- single-post-content   -->
                    <div class="single-post-content spc_column shop_post-content  fl-wrap">
                        <div class="clearfix"></div>
                        <div class="single-post-content_column">
                            <div class="share-holder ver-share fl-wrap">
                                <div class="share-title">Share This <br></div>
                                <div class="share-container  isShare"></div>
                            </div>
                        </div>
                        <div class="single-post-content_text">
                            <p class="has-drop-cap">Lorem ipsum dosectetur adipisicing elit, sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus at leo dignissim congue. Mauris elementum accumsan leo vel tempor. Sit amet cursus nisl aliquam. Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor . Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor</p>
                            <h4 class="mb_head">Middle Post Heading</h4>
                            <p>Lorem ipsum dosectetur adipisicing elit, sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus at leo dignissim congue. Mauris elementum accumsan leo vel tempor. Sit amet cursus nisl aliquam. Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor . Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor</p>
                            <!-- table end -->

                            <!-- table end -->						  
                        </div>
                        <div class="single-post-footer fl-wrap">
                            <div class="post-single-tags">
                                <span class="tags-title"><i class="fas fa-tag"></i> Tags : </span>
                                <div class="tags-widget">
                                    <a href="#">Nuclear Energy</a>
                                    <a href="#">Technology</a>
                                    <a href="#">Fossil Fuel</a>
                                    <a href="#">Lifestyle</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="limit-box2 fl-wrap"></div>
                    <!-- single-post-content  end   -->
                    <!--comments  -->
                    <div id="comments" class="single-post-comm fl-wrap">
                        <div class="pr-subtitle prs_big">Reviews <span>2</span></div>
                        <ul class="commentlist clearafix">
                            <li class="comment">
                                <div class="comment-author">
                                    <img alt="" src="images/avatar/1.jpg" width="50" height="50">
                                </div>
                                <div class="comment-body smpar">
                                    <h4><a href="#">Kevin Antony</a></h4>
                                    <span class="star-rating" data-starrating="5"></span>
                                    <div class="box-widget-menu-btn smact"><i class="far fa-ellipsis-h"></i></div>
                                    <div class="show-more-snopt-tooltip bxwt">
                                        <a href="#"> <i class="fas fa-reply"></i> Reply</a>
                                        <a href="#"> <i class="fas fa-exclamation-triangle"></i> Report </a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo.</p>
                                    <a class="comment-reply-link" href="#"><i class="fas fa-reply"></i> Reply</a>
                                    <div class="comment-meta"><i class="far fa-clock"></i> January 02, 2020</div>
                                    <div class="comment-body_dec"></div>
                                </div>
                            </li>
                            <li class="comment">
                                <div class="comment-author">
                                    <img alt="" src="images/avatar/1.jpg" width="50" height="50">
                                </div>
                                <div class="comment-body smpar">
                                    <h4><a href="#">Liza Rose</a></h4>
                                    <span class="star-rating" data-starrating="5"></span>
                                    <div class="box-widget-menu-btn smact"><i class="far fa-ellipsis-h"></i></div>
                                    <div class="show-more-snopt-tooltip bxwt">
                                        <a href="#"> <i class="fas fa-reply"></i> Reply</a>
                                        <a href="#"> <i class="fas fa-exclamation-triangle"></i> Report </a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p> Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
                                    <a class="comment-reply-link" href="#"><i class="fas fa-reply"></i> Reply</a>
                                    <div class="comment-meta"><i class="far fa-clock"></i> January 02, 2020</div>
                                    <div class="comment-body_dec"></div>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <div id="addcom" class="clearafix">
                            <div class="pr-subtitle">Add Review<i class="fas fa-caret-down"></i></div>
                            <div class="comment-reply-form fl-wrap">
                                <form id="add-comment" class="add-comment custom-form">
                                    <fieldset>
                                        <div class="leave-rating-wrap fl-wrap">
                                            <span class="leave-rating-title">Your rating for this : </span>
                                            <div class="leave-rating">
                                                <input type="radio" name="rating" id="rating-1" value="1" />
                                                <label for="rating-1" class="fal fa-star"></label>
                                                <input type="radio" name="rating" id="rating-2" value="2" />
                                                <label for="rating-2" class="fal fa-star"></label>
                                                <input type="radio" name="rating" id="rating-3" value="3" />
                                                <label for="rating-3" class="fal fa-star"></label>
                                                <input type="radio" name="rating" id="rating-4" value="4" />
                                                <label for="rating-4" class="fal fa-star"></label>
                                                <input type="radio" name="rating" id="rating-5" value="5" />
                                                <label for="rating-5" class="fal fa-star"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" placeholder="Your Name *" value="" />
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="Email Address*" value="" />
                                            </div>
                                            <div class="col-md-12">
                                                <input type="file" placeholder="Upload Your File*"  value=""/>
                                            </div>
                                        </div>
                                        <textarea placeholder="Your Comment:"></textarea>
                                    </fieldset>
                                    <button class="btn float-btn color-btn"> Submit Comment <i class="fas fa-caret-right"></i> </button>
                                </form>
                            </div>
                        </div>
                        <!--end respond-->
                    </div>
                    <!--comments end -->					  
                								
                    <div class="limit-box2 fl-wrap"></div>
                </div>
            </div>
            <!-- sidebar   -->
            <div class="col-md-4">
                <div class="sidebar-content fl-wrap fixed-bar">
                    <!-- box-widget -->
                    <div class="box-widget fl-wrap">
                        <div class="box-widget-content">
                            <div class="search-widget fl-wrap">
                                <form action="#">
                                    <input name="se" id="se12" type="text" class="search" placeholder="Search..." value="" />
                                    <button class="search-submit2" id="submit_btn12"><i class="far fa-search"></i> </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- box-widget  end -->						
                    <!-- box-widget   -->

                    <!-- box-widget  end -->					
                					
                    <!-- box-widget -->
                    <div class="box-widget fl-wrap">
                        <div class="widget-title">Categories</div>
                        <div class="box-widget-content">
                            <ul class="cat-wid-list">
                                <li><a href="#">Nuclear Energy</a><span>3</span></li>
                                <li><a href="#">Market</a> <span>6</span></li>
                                <li><a href="#">Technology</a> <span>12</span></li>
                                <li><a href="#">Renewable Energy</a> <span>4</span></li>
                                <li><a href="#">Fossil Fuel</a> <span>22</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- box-widget  end -->
                    <!-- box-widget -->
                    <div class="box-widget fl-wrap">
                        <div class="widget-title">Popular Tags</div>
                        <div class="box-widget-content">
                            <div class="tags-widget">
                                <a href="#">Nuclear Energy</a>
                                <a href="#">Market</a>
                                <a href="#">Technology</a>
                                <a href="#">Fossil Fuel</a>
                                <a href="#">Renewable Energy</a>
                                <a href="#">Business</a>
                            </div>
                        </div>
                    </div>
                    <!-- box-widget  end -->						
                </div>
                <!-- sidebar  end --> 
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>
    </div>
</section>




@include('frontend.layout.footer')


@endsection 