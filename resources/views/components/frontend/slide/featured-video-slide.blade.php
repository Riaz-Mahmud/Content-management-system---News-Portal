@if (count($data['videoItems'])>0)

    {{-- Featured Video section start --}}
    <div class="container">
        <div class="main-video-wrap fl-wrap">
            <div class="video-main-cont">
                <div class="video-section-title fl-wrap">
                    <h2>Featured  Video</h2>
                    <h4>Stay up-to-date</h4>
                    <a href="category.html">View All <i class="fas fa-caret-right"></i></a>
                </div>
                <a class="video-holder vh-main fl-wrap  image-popup"  href="#">
                    <div class="bg"></div>
                    <div class="overlay"></div>
                    <div class="big_prom"> <i class="fas fa-play"></i></div>
                </a>
                <div class="video-holder-title fl-wrap">
                    <div class="video-holder-title_item"><a href="#"></a></div>
                    <span class="video-date"><i class="far fa-clock"></i> <strong></strong></span>
                    <a class="post-category-marker" href="#"></a>
                </div>
                <div class="vh-preloader"></div>
            </div>
            <!-- video-links-wrap   -->
            <div class="video-links-wrap">
                <!-- video-item  -->
                @foreach ($data['videoItems'] as $frature)
                    <div class="video-item @if ($loop->first) video-item_active @endif fl-wrap" data-url="{{URL::to($frature['slug'])}}" data-video-link="{{$frature['video']}}">
                        <div class="video-item-img fl-wrap">
                            <img src="{{$frature['image']}}" class="respimg" alt="">
                            <div class="play-icon"><i class="fas fa-play"></i></div>
                        </div>
                        <div class="video-item-title">
                            <h4>{{$frature['title']}}</h4>
                            <span class="video-date"><i class="far fa-clock"></i> <strong>{{$frature['date']}}</strong></span>
                        </div>
                        <a class="post-category-marker" href="{{$frature['category']->slug}}">{{$frature['category']->title}}</a>
                    </div>
                @endforeach
                <!--video-item end   -->
            </div>
            <!-- video-links-wrap end   -->
        </div>
    </div>
    {{-- Featured Video section end --}}

@endif
