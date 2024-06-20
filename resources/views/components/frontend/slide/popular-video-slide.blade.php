{{-- if $data['popularVideosItems'] is not empty --}}
@if(count($data['popularVideosItems']) > 0)
    {{-- popular Video section start --}}
    <div class="video_carousel-wrap fl-wrap">
        <div class="container">
            <div class="video_carousel-container">
                <div class="video_carousel_title">
                    <h4>Popular Videos</h4>
                    <div class="vc-pagination pag-style"></div>
                </div>
                <!-- fw-carousel  -->
                <div class="video_carousel  lightgallery">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- swiper-slide-->
                            @foreach ($data['popularVideosItems'] as $popular)
                                <div class="swiper-slide">
                                    <!-- video-item  -->
                                    <div class="video-item fl-wrap">
                                        <div class="video-item-img fl-wrap">
                                            <img src="{{$popular['image']}}" class="respimg" alt="">
                                            <a class="play-icon image-popup" href="{{$popular['video']}}"><i class="fas fa-play"></i></a>
                                        </div>
                                        <div class="video-item-title">
                                            <h4><a href="{{URL::to($popular['slug'])}}">{{$popular['title']}}</a></h4>
                                            <span class="video-date"><i class="far fa-clock"></i> {{$popular['date']}}</span>
                                        </div>
                                        <a class="post-category-marker" href="{{URL::to($popular['category']->slug)}}">{{$popular['category']->title}}</a>
                                    </div>
                                    <!--video-item end   -->
                                </div>
                            @endforeach
                            <!-- swiper-slide end-->
                        </div>
                    </div>
                </div>
                <!-- fw-carousel end -->
                <div class="cc-prev cc_btn"><i class="fas fa-caret-left"></i></div>
                <div class="cc-next cc_btn"><i class="fas fa-caret-right"></i></div>
            </div>
        </div>
    </div>
    {{-- popular Video section end --}}
@endif
