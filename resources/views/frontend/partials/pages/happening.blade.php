
@extends('frontend.layout.app')

@section('content')


@include('frontend.layout.topbar')
<x-frontend.menu.menu-list code="Main Menu" />
@include('frontend.layout.register')


<div class="breadcrumbs-header fl-wrap">
    <div class="container">
        <div class="breadcrumbs-header_url">
            <a href="#">Home</a><span>Happenings</span>
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
                            <div class="section-title">
                                <h2>Most Recent World News</h2>
                                <h4>Don't miss daily news</h4>
                                <div class="steader_opt steader_opt_abs">
                                    <select name="filter" id="list" data-placeholder="Persons" class="style-select no-search-select">
                                        <option>Latest</option>
                                        <option>Most Read</option>
                                        <option>Most Viewed</option>
                                        <option>Most Commented</option>
                                    </select>
                                </div>
                            </div>
                            <div class="list-post-wrap">
                                <!--list-post-->
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/2.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="#">Renewable Energy</a>
                                        <h3><a href="post-single.html">Goodwin must Break Clarkson hold on Flags</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 18 may 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i> 6 </li>
                                            <li><i class="fal fa-eye"></i>  587 </li>
                                        </ul>
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/3.png" alt="">  <span>By Jane Taylor</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/3.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="category.html">Technology</a>
                                        <h3><a href="post-single.html">New VR Glasses and Headset System Release</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 15 may 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  5 </li>
                                            <li><i class="fal fa-eye"></i>  456 </li>
                                        </ul>
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/4.png" alt="">  <span>By Mark Rose</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/4.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="category.html">Nuclear Energy</a>
                                        <h3><a href="post-single.html">How to start Home renovation.</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 05 April 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  55</li>
                                            <li><i class="fal fa-eye"></i>  987 </li>
                                        </ul>
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/5.jpg" alt="">  <span>By Ann Kowalsky</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/5.jpg"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="category.html">Market</a>
                                        <h3><a href="post-single.html">Man boasted of crowd size at Jan.  New book says</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 11 March 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  58 </li>
                                            <li><i class="fal fa-eye"></i> 235 </li>
                                        </ul>
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.png" alt="">  <span>By Jessie Bond</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/bestcat/1.png"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="category.html">Fossil Fuel</a>
                                        <h3><a href="post-single.html">Government legislates to decrimilaise   work</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 06 March 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  25 </li>
                                            <li><i class="fal fa-eye"></i>  164 </li>
                                        </ul>
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/203.png" alt="">  <span>By Mark Rose</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/bestcat/2.png"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="category.html">Technology</a>
                                        <h3><a href="post-single.html">This Is What a Smart Watch Can Actually Solve</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 03 March 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i> 4 </li>
                                            <li><i class="fal fa-eye"></i>  980 </li>
                                        </ul>
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/203.png" alt="">  <span>By Mark Rose</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/bestcat/3.png"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="category.html">Nuclear Energy</a>
                                        <h3><a href="post-single.html">Tesla   it tested hypersonic Model-C</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 22 january 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i> 32 </li>
                                            <li><i class="fal fa-eye"></i>  444 </li>
                                        </ul>
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/4.png" alt="">  <span>Ann Kowalsky</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/all/bestcat/4.png"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; Image Copyrights Title</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="category.html">Fossil Fuel</a>
                                        <h3><a href="post-single.html"> $310m  to help Fossil Fueles in latest lockdown</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> 16 january 2022</span>
                                        <p>Struggling to sell one multi-million dollar home quite on currently the market easily dollar home quite.  </p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  67 </li>
                                            <li><i class="fal fa-eye"></i>  1234 </li>
                                        </ul>
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/3.png" alt="">  <span>By Jane Taylor</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                            </div>
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

                        <div class="sidebar-content fl-wrap fix-bar">
                            <!-- box-widget -->
                            <div class="box-widget fl-wrap" >
                                <div class="widget-title">Popular Tags</div>
                                    <div class="box-widget-content">
                                        <div class="tags-widget">
                                            <a href="#">Nuclear Energy</a>
                                            <a href="#">Market</a>
                                            <a href="#">Technology</a>
                                            <a href="#">Fossil Fuel</a>
                                            <a href="#">Renewable Energy</a>
                                            <a href="#">Business</a>
                                            <a href="#">Hydrogen</a>
                                            <a href="#">Nuclear Power</a>
                                            <a href="#">Oil and Gas</a>
                                            <a href="#">Solar Module</a>
                                            <a href="#">Wind Power</a>
                                            <a href="#">Thermal Power</a>
                                            <a href="#">Political Energy</a>
                                            <a href="#">Environment</a>
                                            <a href="#">Energy Storage</a>
                                            <a href="#">Green Fuel</a>
                                            <a href="#">Transition Energy</a>
                                            <a href="#">Power Grid</a>
                                            <a href="#">Coal</a>
                                            <a href="#">Energy Vehicles</a>
                                            <a href="#">Geothermal</a>
                                            <a href="#">Energy Economy</a>
                                            <a href="#">Future Energy</a>
                                            <a href="#">Climate Change</a>
                                            <a href="#">Hydropower</a>
                                        </div>
                                    </div>
                                </div>
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
                            </div>
                        </div>
                        <div class="limit-box fl-wrap"></div>

                    </div>
                </div>

            </div>
        </section>

 @include('frontend.layout.footer')


 @endsection
