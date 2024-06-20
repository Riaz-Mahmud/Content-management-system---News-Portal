
@extends('frontend.layout.app')

@section('content') 


@include('frontend.layout.topbar')
@include('frontend.layout.menu')
@include('frontend.layout.register')

    <!-- content    -->
    
        <div class="breadcrumbs-header fl-wrap">
            <div class="container">
                <div class="breadcrumbs-header_url">
                    <a href="#">Home</a><span>Impact Stories</span>
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
        <section>


            <div class="container">
                <div class="main-container fl-wrap">
                    <div class="section-title">
                        <h2>Impact Stories</h2>
                        <h4>Don't miss daily impact Stories</h4>
                        <div class="steader_opt steader_opt_abs">
                            <select name="filter" id="list" data-placeholder="Persons" class="style-select no-search-select">
                                <option>Current Issue </option>
                                <option>Old Issue </option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="section-title">
                        <h2>Life</h2> 
                    </div>
                    <!--grid-post-wrap-->
                    <div class="grid-post-wrap gallery-items">
                        <!--grid-post-item-->
                        <div class="gallery-item">
                            <div class="grid-post-item  bold_gpi fl-wrap">
                            <div class="video-item fl-wrap">
                                <div class="video-item-img fl-wrap">
                                    <img src="{{URL::to('/assets/frontend/images/all/yt/8.png')}}" class="respimg" alt="">
                                    <a class="play-icon image-popup" href="https://vimeo.com/108359069"><i class="fas fa-play"></i></a>
                                </div>
                                <div class="video-item-title">
                                    <h4><a href="post-single2.html">Efforts to cut car, plane and ship   get small boost</a></h4>
                                    <span class="video-date"><i class="far fa-clock"></i> 05december 2021</span>
                                </div>
                                <a class="post-category-marker" href="category.html">Nuclear Energy</a>
                            </div>
                            <div class="grid-post-footer">
                                <div class="author-link"><a href="{{route('profile')}}"><img src="{{asset('assets/frontend/images/avatar/1.jpg')}}" alt="">  <span>By Jane Taylor</span></a></div>
                                <ul class="post-opt">
                                    <li><i class="fal fa-eye"></i>  541 </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                        <!--grid-post-item end-->
                            <!--grid-post-item-->
                            <div class="gallery-item">
                                <div class="grid-post-item  bold_gpi fl-wrap">
                                <div class="video-item fl-wrap">
                                    <div class="video-item-img fl-wrap">
                                        <img src="{{URL::to('/assets/frontend/images/all/yt/8.png')}}" class="respimg" alt="">
                                        <a class="play-icon image-popup" href="https://vimeo.com/108359069"><i class="fas fa-play"></i></a>
                                    </div>
                                    <div class="video-item-title">
                                        <h4><a href="post-single2.html">Efforts to cut car, plane and ship   get small boost</a></h4>
                                        <span class="video-date"><i class="far fa-clock"></i> 05december 2021</span>
                                    </div>
                                    <a class="post-category-marker" href="category.html">Nuclear Energy</a>
                                </div>
                                <div class="grid-post-footer">
                                    <div class="author-link"><a href="{{route('profile')}}"><img src="{{asset('assets/frontend/images/avatar/1.jpg')}}" alt="">  <span>By Jane Taylor</span></a></div>
                                    <ul class="post-opt">
                                        <li><i class="fal fa-eye"></i>  541 </li>
                                    </ul>
                                </div>
                              </div>
                            </div>
                            <!--grid-post-item end-->

                                <!--grid-post-item-->
                        <div class="gallery-item">
                            <div class="grid-post-item  bold_gpi fl-wrap">
                            <div class="video-item fl-wrap">
                                <div class="video-item-img fl-wrap">
                                    <img src="{{URL::to('/assets/frontend/images/all/yt/8.png')}}" class="respimg" alt="">
                                    <a class="play-icon image-popup" href="https://vimeo.com/108359069"><i class="fas fa-play"></i></a>
                                </div>
                                <div class="video-item-title">
                                    <h4><a href="post-single2.html">Efforts to cut car, plane and ship   get small boost</a></h4>
                                    <span class="video-date"><i class="far fa-clock"></i> 05december 2021</span>
                                </div>
                                <a class="post-category-marker" href="category.html">Nuclear Energy</a>
                            </div>
                            <div class="grid-post-footer">
                                <div class="author-link"><a href="{{route('profile')}}"><img src="{{asset('assets/frontend/images/avatar/1.jpg')}}" alt="">  <span>By Jane Taylor</span></a></div>
                                <ul class="post-opt">
                                    <li><i class="fal fa-eye"></i>  541 </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                        <!--grid-post-item end-->
                    
                     
                        <!--grid-post-item end-->	 
                    </div>
                    <!--grid-post-wrap end-->
                    <div class="clearfix"></div>
                    <div class="load-more_btn"><i class="fal fa-undo"></i>Load More</div>
                    <!--pagination-->
                    <div class="pagination">
                        <a href="#" class="prevposts-link"><i class="fas fa-caret-left"></i></a>
                        <a href="#"  class="current-page">01.</a>
                        <a href="#">02.</a>
                        <a href="#">03.</a>
                        <a href="#">04.</a>
                        <a href="#" class="nextposts-link"><i class="fas fa-caret-right"></i></a>
                    </div>
                    <!--pagination end-->						
                </div>
            </div>
        </section>

        <section>


            <div class="container">
                <div class="main-container fl-wrap">


                    <div class="section-title">
                        <h2>Business</h2> 
                    </div>
                    <!--grid-post-wrap-->
                    <div class="grid-post-wrap gallery-items">
                        <!--grid-post-item-->
                        <div class="gallery-item">
                            <div class="grid-post-item  bold_gpi fl-wrap">
                            <div class="video-item fl-wrap">
                                <div class="video-item-img fl-wrap">
                                    <img src="{{URL::to('/assets/frontend/images/all/yt/8.png')}}" class="respimg" alt="">
                                    <a class="play-icon image-popup" href="https://vimeo.com/108359069"><i class="fas fa-play"></i></a>
                                </div>
                                <div class="video-item-title">
                                    <h4><a href="post-single2.html">Efforts to cut car, plane and ship   get small boost</a></h4>
                                    <span class="video-date"><i class="far fa-clock"></i> 05december 2021</span>
                                </div>
                                <a class="post-category-marker" href="category.html">Nuclear Energy</a>
                            </div>
                            <div class="grid-post-footer">
                                <div class="author-link"><a href="{{route('profile')}}"><img src="{{asset('assets/frontend/images/avatar/1.jpg')}}" alt="">  <span>By Jane Taylor</span></a></div>
                                <ul class="post-opt">
                                    <li><i class="fal fa-eye"></i>  541 </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                        <!--grid-post-item end-->
                            <!--grid-post-item-->
                            <div class="gallery-item">
                                <div class="grid-post-item  bold_gpi fl-wrap">
                                <div class="video-item fl-wrap">
                                    <div class="video-item-img fl-wrap">
                                        <img src="{{URL::to('/assets/frontend/images/all/yt/8.png')}}" class="respimg" alt="">
                                        <a class="play-icon image-popup" href="https://vimeo.com/108359069"><i class="fas fa-play"></i></a>
                                    </div>
                                    <div class="video-item-title">
                                        <h4><a href="post-single2.html">Efforts to cut car, plane and ship   get small boost</a></h4>
                                        <span class="video-date"><i class="far fa-clock"></i> 05december 2021</span>
                                    </div>
                                    <a class="post-category-marker" href="category.html">Nuclear Energy</a>
                                </div>
                                <div class="grid-post-footer">
                                    <div class="author-link"><a href="{{route('profile')}}"><img src="{{asset('assets/frontend/images/avatar/1.jpg')}}" alt="">  <span>By Jane Taylor</span></a></div>
                                    <ul class="post-opt">
                                        <li><i class="fal fa-eye"></i>  541 </li>
                                    </ul>
                                </div>
                              </div>
                            </div>
                            <!--grid-post-item end-->

                                <!--grid-post-item-->
                        <div class="gallery-item">
                            <div class="grid-post-item  bold_gpi fl-wrap">
                            <div class="video-item fl-wrap">
                                <div class="video-item-img fl-wrap">
                                    <img src="{{URL::to('/assets/frontend/images/all/yt/8.png')}}" class="respimg" alt="">
                                    <a class="play-icon image-popup" href="https://vimeo.com/108359069"><i class="fas fa-play"></i></a>
                                </div>
                                <div class="video-item-title">
                                    <h4><a href="post-single2.html">Efforts to cut car, plane and ship   get small boost</a></h4>
                                    <span class="video-date"><i class="far fa-clock"></i> 05december 2021</span>
                                </div>
                                <a class="post-category-marker" href="category.html">Nuclear Energy</a>
                            </div>
                            <div class="grid-post-footer">
                                <div class="author-link"><a href="{{route('profile')}}"><img src="{{asset('assets/frontend/images/avatar/1.jpg')}}" alt="">  <span>By Jane Taylor</span></a></div>
                                <ul class="post-opt">
                                    <li><i class="fal fa-eye"></i>  541 </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                        <!--grid-post-item end-->
                    
                     
                        <!--grid-post-item end-->	 
                    </div>
                    <!--grid-post-wrap end-->
                    <div class="clearfix"></div>
                    <div class="load-more_btn"><i class="fal fa-undo"></i>Load More</div>
                    <!--pagination-->
                    <div class="pagination">
                        <a href="#" class="prevposts-link"><i class="fas fa-caret-left"></i></a>
                        <a href="#"  class="current-page">01.</a>
                        <a href="#">02.</a>
                        <a href="#">03.</a>
                        <a href="#">04.</a>
                        <a href="#" class="nextposts-link"><i class="fas fa-caret-right"></i></a>
                    </div>
                    <!--pagination end-->						
                </div>
            </div>
        </section>
        <!-- section end -->


        

    
    <!-- content  end-->
     <!-- footer -->
          <div id="footer"></div>
    <!-- footer end-->  			
    <div class="aside-panel">
        <ul>
            <li> <a href="category.html"><i class="far  fa-podium"></i><span>Market</span></a></li>
            <li> <a href="category.html"><i class="far fa-atom"></i><span>Technology</span></a></li>
            <li> <a href="category.html"><i class="far fa-user-chart"></i><span>Fossil Fuel</span></a></li>
            <li> <a href="category.html"><i class="far fa-address-book"></i><span>Renewable Energy</span></a></li>
            <li> <a href="category.html"><i class="far fa-flask"></i><span>Nuclear Energy</span></a></li>
        </ul>
    </div>


            
@include('frontend.layout.footer')
@endsection 