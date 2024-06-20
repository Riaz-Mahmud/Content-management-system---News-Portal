@if (count($data['slideNewsItems']) > 0)

    <div class="single-grid-slider-wrap fl-wrap">
        <div class="single-grid-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- swiper-slide-->
                    @foreach ($data['slideNewsItems'] as $news)
                        <div class="swiper-slide">
                            <div class="grid-post-item  bold_gpi  fl-wrap">
                                <div class="grid-post-media gpm_sing">
                                    <div class="bg" data-bg="{{$news['image']}}"></div>
                                    <div class="author-link"><a href="{{route('profile.show', $news['author_id'])}}"><img src="{{$news['author_image']}}" alt="{{$news['author']}}">  <span>By {{$news['author']}}</span></a></div>
                                    <div class="grid-post-media_title">
                                        <a class="post-category-marker" href="{{URL::to($news['category']->slug)}}">{{$news['category']->title}}</a>
                                        <h4><a href="{{URL::to($news['slug'])}}">{{$news['title']}}</a></h4>
                                        <span class="video-date"><i class="far fa-clock"></i> {{$news['date']}}</span>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i>  {{$news['commentCount']}} </li>
                                            <li><i class="fal fa-eye"></i>  {{$news['viewCount']}} </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- swiper-slide end-->
                </div>
                <div class="sgs-pagination sgs_ver "></div>
            </div>
        </div>
    </div>

@endif
