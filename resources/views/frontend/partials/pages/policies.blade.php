@extends('frontend.layout.app')

@section('content') 


@include('frontend.layout.topbar')
@include('frontend.layout.menu')
@include('frontend.layout.register')

<div class="breadcrumbs-header fl-wrap">
    <div class="container">
        <div class="breadcrumbs-header_url">
            <a href="#">Home</a><span>Policies</span>
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
            <div class="col-md-8">
                <div class="main-container fl-wrap fix-container-init">
                    <div class="section-title">
                        <h3>Sorty by:</h3>
                        <div class="steader_opt steader_opt_abs">
                            <select name="filter" id="list" data-placeholder="Persons" class="style-select no-search-select">
                                <option>Latest</option>
                                <option>Most Read</option>
                                <option>Most Viewed</option>
                                <option>Most Commented</option>
                            </select>
                        </div>
                    </div>
                    <!--grid-post-wrap-->
                    <div class="grid-post-wrap">
                        <div class="row">
                            <!--grid-post-item-->
                            <div class="col-md-6">
                                <div class="grid-post-item  bold_gpi  fl-wrap">
                                    <div class="grid-post-media">
                                        <a href="post-single.html" class="gpm_link">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/1.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <a class="post-category-marker purp-bg" href="category.html">Renewable Energy</a>
                                    <div class="grid-post-content">
                                        <h3><a href="post-single.html">Goodwin must Break Clarkson hold on Flags</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i>  18 may 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                    </div>
                                    <div class="grid-post-footer">
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.jpg" alt="">  <span>By Jane Taylor</span></a></div>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i> 6</li>
                                            <li><i class="fal fa-eye"></i>  587 </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--grid-post-item end-->
                            <!--grid-post-item-->
                            <div class="col-md-6">
                                <div class="grid-post-item  bold_gpi fl-wrap">
                                    <div class="grid-post-media">
                                        <a href="post-single.html" class="gpm_link">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/1.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <a class="post-category-marker purp-bg" href="category.html">Technology</a>
                                    <div class="grid-post-content">
                                        <h3><a href="post-single.html">New VR Glasses and Headset System Release</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 15 may 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                    </div>
                                    <div class="grid-post-footer">
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.jpg" alt="">  <span>By Mark Rose</span></a></div>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  5 </li>
                                            <li><i class="fal fa-eye"></i>  456 </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--grid-post-item end-->	
                            <!--grid-post-item-->
                            <div class="col-md-6">
                                <div class="grid-post-item  bold_gpi  fl-wrap">
                                    <div class="grid-post-media">
                                        <a href="post-single.html" class="gpm_link">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/1.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <a class="post-category-marker purp-bg" href="category.html">Nuclear Energy</a>
                                    <div class="grid-post-content">
                                        <h3><a href="post-single.html">How to start Home renovation.</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i>  05 April 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                    </div>
                                    <div class="grid-post-footer">
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.jpg" alt="">  <span>By Ann Kowalsky</span></a></div>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  55 </li>
                                            <li><i class="fal fa-eye"></i>  987 </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--grid-post-item end-->
                            <!--grid-post-item-->
                            <div class="col-md-6">
                                <div class="grid-post-item  bold_gpi fl-wrap">
                                    <div class="grid-post-media">
                                        <a href="post-single.html" class="gpm_link">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/1.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <a class="post-category-marker purp-bg" href="category.html">Market</a>
                                    <div class="grid-post-content">
                                        <h3><a href="post-single.html">Man boasted of crowd size at Jan. New book says</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i>  11 March 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                    </div>
                                    <div class="grid-post-footer">
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.jpg" alt="">  <span>By Jessie Bond</span></a></div>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  58 </li>
                                            <li><i class="fal fa-eye"></i>  235 </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--grid-post-item end-->
                            <!--grid-post-item-->
                            <div class="col-md-6">
                                <div class="grid-post-item  bold_gpi  fl-wrap">
                                    <div class="grid-post-media">
                                        <a href="post-single.html" class="gpm_link">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/1.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <a class="post-category-marker purp-bg" href="category.html">Fossil Fuel</a>
                                    <div class="grid-post-content">
                                        <h3><a href="post-single.html">Government legislates to decrimilaise work</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i>  06 March 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                    </div>
                                    <div class="grid-post-footer">
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.jpg" alt="">  <span>By Mark Rose</span></a></div>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  25 </li>
                                            <li><i class="fal fa-eye"></i>  164 </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--grid-post-item end-->
                            <!--grid-post-item-->
                            <div class="col-md-6">
                                <div class="grid-post-item  bold_gpi fl-wrap">
                                    <div class="grid-post-media">
                                        <a href="post-single.html" class="gpm_link">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/1.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <a class="post-category-marker purp-bg" href="category.html">Nuclear Energy</a>
                                    <div class="grid-post-content">
                                        <h3><a href="post-single.html">Tesla   it tested hypersonic Model-C</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 25 may 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                    </div>
                                    <div class="grid-post-footer">
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.jpg" alt="">  <span>By Ann Kowalsky</span></a></div>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  32 </li>
                                            <li><i class="fal fa-eye"></i>  44 </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--grid-post-item end-->
                            <!--grid-post-item-->
                            <div class="col-md-6">
                                <div class="grid-post-item  bold_gpi  fl-wrap">
                                    <div class="grid-post-media">
                                        <a href="post-single.html" class="gpm_link">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/1.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <a class="post-category-marker purp-bg" href="category.html">Fossil Fuel</a>
                                    <div class="grid-post-content">
                                        <h3><a href="post-single.html">$310m to help Fossil Fueles in latest lockdown</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i>  16 january 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                    </div>
                                    <div class="grid-post-footer">
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.jpg" alt="">  <span>By Jane Taylor</span></a></div>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  67 </li>
                                            <li><i class="fal fa-eye"></i>  1234 </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--grid-post-item end-->
                            <!--grid-post-item-->
                            <div class="col-md-6">
                                <div class="grid-post-item  bold_gpi fl-wrap">
                                    <div class="grid-post-media">
                                        <a href="post-single.html" class="gpm_link">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/1.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <a class="post-category-marker purp-bg" href="category.html">Sport</a>
                                    <div class="grid-post-content">
                                        <h3><a href="post-single.html">Power Plant season still to proceed.</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 15 December 2021</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                    </div>
                                    <div class="grid-post-footer">
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.jpg" alt="">  <span>By Jessie Bond</span></a></div>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  08 </li>
                                            <li><i class="fal fa-eye"></i>  541 </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--grid-post-item end-->								
                        </div>
                    </div>
                    <!--grid-post-wrap end-->
                    <div class="clearfix"></div>
                    <div class="load-more_btn"><i class="fal fa-undo"></i>Load More</div>
                    <!--pagination-->
                    <div class="pagination">
                        <a href="#" class="prevposts-link"><i class="fas fa-caret-left"></i></a>
                        <a href="#">01.</a>
                        <a href="#" class="current-page">02.</a>
                        <a href="#">03.</a>
                        <a href="#">04.</a>
                        <a href="#" class="nextposts-link"><i class="fas fa-caret-right"></i></a>
                    </div>
                    <!--pagination end-->						
                </div>
            </div>
            <div class="col-md-4">
                <!-- sidebar   -->
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
                    <!-- box-widget -->
                    <div class="box-widget fl-wrap">
                        <div class="box-widget-content">
                            <div class="banner-widget fl-wrap">
                                <div class="bg-wrap bg-parallax-wrap-gradien">
                                    <div class="bg  " data-bg="images/bg/1.jpg"></div>
                                </div>
                                <div class="banner-widget_content">
                                    <h5>Visit our awesome merch and souvenir online shop.</h5>
                                    <a href="#" class="btn float-btn color-bg small-btn">OUR MISSION</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <!-- box-widget -->
                    <div class="box-widget fl-wrap">
                        <div class="widget-title">Follow Us</div>
                        <div class="box-widget-content">
                            <div class="social-widget">
                                <a href="#" target="_blank" class="facebook-soc">
                                <i class="fab fa-facebook-f"></i>
                                <span class="soc-widget-title">Likes</span>
                                <span class="soc-widget_counter">2640</span>
                                </a>
                                <a href="#" target="_blank" class="twitter-soc">
                                <i class="fab fa-twitter"></i>
                                <span class="soc-widget-title">Followers</span>
                                <span class="soc-widget_counter">1456</span>												
                                </a> 
                                <a href="#" target="_blank" class="youtube-soc">
                                <i class="fab fa-youtube"></i>
                                <span class="soc-widget-title">Followers</span>
                                <span class="soc-widget_counter">1456</span>												
                                </a> 												
                                <a href="#" target="_blank" class="instagram-soc">
                                <i class="fab fa-instagram"></i>
                                <span class="soc-widget-title">Followers</span>
                                <span class="soc-widget_counter">1456</span>												
                                </a> 														
                            </div>
                        </div>
                    </div>
                    <!-- box-widget  end -->						
                    <!-- box-widget -->
                    <div class="box-widget fl-wrap">
                        <div class="box-widget-content">
                            <!-- content-tabs-wrap -->
                            <div class="content-tabs-wrap tabs-act tabs-widget fl-wrap">
                                <div class="content-tabs fl-wrap">
                                    <ul class="tabs-menu fl-wrap no-list-style">
                                        <li class="current"><a href="#tab-popular"> Popular News </a></li>
                                        <li><a href="#tab-resent">Resent News</a></li>
                                    </ul>
                                </div>
                                <!--tabs -->                       
                                <div class="tabs-container">
                                    <!--tab -->
                                    <div class="tab">
                                        <div id="tab-popular" class="tab-content first-tab">
                                            <div class="post-widget-container fl-wrap">
                                                <!-- post-widget-item -->
                                                <div class="post-widget-item fl-wrap">
                                                    <div class="post-widget-item-media">
                                                        <a href="post-single.html"><img src="images/all/thumbs/1.jpg"  alt=""></a>
                                                    </div>
                                                    <div class="post-widget-item-content">
                                                        <h4><a href="post-single.html">How to start Home education.</a></h4>
                                                        <ul class="pwic_opt">
                                                            <li><span><i class="far fa-clock"></i> 25 may 2022</span></li>
                                                            <li><span><i class="far fa-comments-alt"></i> 12</span></li>
                                                            <li><span><i class="fal fa-eye"></i> 654</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- post-widget-item end -->
                                                <!-- post-widget-item -->
                                                <div class="post-widget-item fl-wrap">
                                                    <div class="post-widget-item-media">
                                                        <a href="post-single.html"><img src="images/all/thumbs/1.jpg"  alt=""></a>
                                                    </div>
                                                    <div class="post-widget-item-content">
                                                        <h4><a href="post-single.html">The secret to moving this   screening.</a></h4>
                                                        <ul class="pwic_opt">
                                                            <li><span><i class="far fa-clock"></i> 13 april 2021</span></li>
                                                            <li><span><i class="far fa-comments-alt"></i> 6</span></li>
                                                            <li><span><i class="fal fa-eye"></i> 1227</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- post-widget-item end -->														
                                                <!-- post-widget-item -->
                                                <div class="post-widget-item fl-wrap">
                                                    <div class="post-widget-item-media">
                                                        <a href="post-single.html"><img src="images/all/thumbs/1.jpg"  alt=""></a>
                                                    </div>
                                                    <div class="post-widget-item-content">
                                                        <h4><a href="post-single.html">Fall ability to keep Congress on rails.</a></h4>
                                                        <ul class="pwic_opt">
                                                            <li><span><i class="far fa-clock"></i> 02 December 2021</span></li>
                                                            <li><span><i class="far fa-comments-alt"></i> 12</span></li>
                                                            <li><span><i class="fal fa-eye"></i> 654</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- post-widget-item end -->														
                             
                                            </div>
                                        </div>
                                    </div>
                                    <!--tab  end-->
                                    <!--tab -->
                                    <div class="tab">
                                        <div id="tab-resent" class="tab-content">
                                            <div class="post-widget-container fl-wrap">
                                                <!-- post-widget-item -->
                                                <div class="post-widget-item fl-wrap">
                                                    <div class="post-widget-item-media">
                                                        <a href="post-single.html"><img src="images/all/thumbs/1.jpg"  alt=""></a>
                                                    </div>
                                                    <div class="post-widget-item-content">
                                                        <h4><a href="post-single.html">Magpie nesting zone sites.</a></h4>
                                                        <ul class="pwic_opt">
                                                            <li><span><i class="far fa-clock"></i> 05 april 2021</span></li>
                                                            <li><span><i class="far fa-comments-alt"></i> 16</span></li>
                                                            <li><span><i class="fal fa-eye"></i> 727</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- post-widget-item end -->														
                                                <!-- post-widget-item -->
                                                <div class="post-widget-item fl-wrap">
                                                    <div class="post-widget-item-media">
                                                        <a href="post-single.html"><img src="images/all/thumbs/1.jpg"  alt=""></a>
                                                    </div>
                                                    <div class="post-widget-item-content">
                                                        <h4><a href="post-single.html">Locals help create whole new community.</a></h4>
                                                        <ul class="pwic_opt">
                                                            <li><span><i class="far fa-clock"></i> 22 march 2021</span></li>
                                                            <li><span><i class="far fa-comments-alt"></i> 31</span></li>
                                                            <li><span><i class="fal fa-eye"></i> 63</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- post-widget-item end -->														
                                                <!-- post-widget-item -->
                                                <div class="post-widget-item fl-wrap">
                                                    <div class="post-widget-item-media">
                                                        <a href="post-single.html"><img src="images/all/thumbs/1.jpg"  alt=""></a>
                                                    </div>
                                                    <div class="post-widget-item-content">
                                                        <h4><a href="post-single.html">Power Plant season still to proceed.</a></h4>
                                                        <ul class="pwic_opt">
                                                            <li><span><i class="far fa-clock"></i> 06 December 2021</span></li>
                                                            <li><span><i class="far fa-comments-alt"></i> 05</span></li>
                                                            <li><span><i class="fal fa-eye"></i> 145</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- post-widget-item end -->													
                                            </div>
                                        </div>
                                    </div>
                                    <!--tab end-->							
                                </div>
                                <!--tabs end-->  
                            </div>
                            <!-- content-tabs-wrap end -->
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
<!-- section  -->

@include('frontend.layout.footer')
 @endsection 