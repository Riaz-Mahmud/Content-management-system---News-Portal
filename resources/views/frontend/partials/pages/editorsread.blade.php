
@extends('frontend.layout.app')

@section('content') 


@include('frontend.layout.topbar')
@include('frontend.layout.menu')
@include('frontend.layout.register')




        <!--section   -->
        <div class="breadcrumbs-header fl-wrap">
            <div class="container">
                <div class="breadcrumbs-header_url">
                    <a href="{{route('home')}}">Home</a><span>Editors Read</span>
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
                                <h2>Editor's Read</h2>
                                
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
                                                <div class="bg" data-bg="images/trending/1.jpg"></div>
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
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.png" alt="">  <span>By Jane Taylor</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->	
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/2.jpg"></div>
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
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/3.png" alt="">  <span>By Mark Rose</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->					
                                <!--list-post-->	
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/3.jpg"></div>
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
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/4.png" alt="">  <span>By Ann Kowalsky</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->	
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/4.jpg"></div>
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
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/5.jpg" alt="">  <span>By Jessie Bond</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->					
                                <!--list-post-->	
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/9.jpg"></div>
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
                                                <div class="bg" data-bg="images/trending/6.jpg"></div>
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
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/1.png" alt="">  <span>By Mark Rose</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->					
                                <!--list-post-->	
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/7.jpg"></div>
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
                                        <div class="author-link"><a href="author-single.html"><img src="images/avatar/5.jpg" alt="">  <span>Ann Kowalsky</span></a></div>
                                    </div>
                                </div>
                                <!--list-post end-->
                                <!--list-post-->	
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="post-single.html">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/8.jpg"></div>
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
                            {{-- <!-- box-widget -->
                            <div class="box-widget fl-wrap">
                                <div class="widget-title">Cetegories</div>
                                <div class="box-widget-content">
                                    <div class="sb-categories_bg">
                                        <!-- sb-categories_bg_item -->
                                        <a href="category-single.html" class="sb-categories_bg_item">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/ne.jpg"></div>
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="spb-categories_title"><span>01</span>Nuclear Energy</div>
                                            <div class="spb-categories_counter">66</div>
                                        </a>
                                        <!-- sb-categories_bg_item  end-->
                                        <!-- sb-categories_bg_item -->
                                        <a href="category-single.html" class="sb-categories_bg_item">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/re.jpg"></div>
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="spb-categories_title"><span>02</span>Renewable Energy</div>
                                            <div class="spb-categories_counter">22</div>
                                        </a>
                                        <!-- sb-categories_bg_item  end-->											
                                        <!-- sb-categories_bg_item -->
                                        <a href="category-single.html" class="sb-categories_bg_item">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/ff.jpg"></div>
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="spb-categories_title"><span>03</span>Fossil Fuel</div>
                                            <div class="spb-categories_counter">54</div>
                                        </a>
                                        <!-- sb-categories_bg_item  end-->													
                                        <!-- sb-categories_bg_item -->
                                        <a href="category-single.html" class="sb-categories_bg_item">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="images/trending/t.jpg"></div>
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="spb-categories_title"><span>04</span>Technology</div>
                                            <div class="spb-categories_counter">15</div>
                                        </a>
                                        <!-- sb-categories_bg_item  end-->													
                                        <!-- sb-categories_bg_item -->
                                
                                        <!-- sb-categories_bg_item  end-->													
                                    </div>
                                </div>
                            </div>
                            <!-- box-widget  end -->					 --}}
                            <!-- box-widget -->
                            @include('frontend.layout.populertab')
                            <!-- box-widget  end -->						
                            <!-- box-widget -->
                            @include('frontend.layout.followus')
                            <!-- box-widget  end -->						
                            <!-- box-widget -->
                            @include('frontend.layout.recentnews')
                            <!-- box-widget  end -->					
                        </div>
                        <!-- sidebar  end -->
                    </div>
                </div>
                <div class="limit-box fl-wrap"></div>
            </div>
        </section>
        <!-- section end -->
    




@include('frontend.layout.footer')


@endsection 