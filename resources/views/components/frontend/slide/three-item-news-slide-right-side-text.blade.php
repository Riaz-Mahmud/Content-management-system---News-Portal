<!-- section -->
<section class="no-padding">
    <div class="fs-carousel-wrap">
        @if (count($data['items'])>0)
            <div class="fs-carousel-wrap_title">
                <div class="fs-carousel-wrap_title-wrap fl-wrap">
                    <h4>Quarterly</h4>
                    <h5>Don't Miss And  Stay Up-to-date. Top pic for you.</h5>
                </div>
                <div class="abs_bg"></div>
                <div class="gs-controls">
                    <div class="gs_button gc-button-next"><i class="fas fa-caret-right"></i></div>
                    <div class="gs_button gc-button-prev"><i class="fas fa-caret-left"></i></div>
                </div>
            </div>
            <div class="fs-carousel fl-wrap">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- swiper-slide-->
                        @foreach ($data['items'] as $item)
                            <div class="swiper-slide">
                                <div class="grid-post-item  bold_gpi  fl-wrap">
                                    <div class="grid-post-media gpm_sing">
                                        <div class="bg" data-bg="{{$item['image']}}"></div>
                                        <div class="author-link"><a href="{{ route('profile.show', $item['author_id'])}}"><img src=" {{$item['author_image']}}" alt="">  <span>By {{$item['author']}}</span></a></div>
                                        <div class="grid-post-media_title">
                                            <a class="post-category-marker" href="{{URL::to($item['category']->slug)}}">{{$item['category']->title}}</a>
                                            <h4><a href="{{URL::to($item['slug'])}}">{{$item['title']}}</a></h4>
                                            <span class="video-date"><i class="far fa-clock"></i> {{$item['date']}}</span>
                                            <ul class="post-opt">
                                                <li><i class="far fa-comments-alt"></i>  {{$item['commentCount']}}</li>
                                                <li><i class="fal fa-eye"></i>  {{$item['viewCount']}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- swiper-slide end-->
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- section end -->
