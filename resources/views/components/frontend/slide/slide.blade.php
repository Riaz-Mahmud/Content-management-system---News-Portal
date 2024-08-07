@if (count($data['slideItems']) > 0)

    <div class="hero-slider-wrap fl-wrap">
        <!-- hero-slider-container     -->
        <div class="hero-slider-container multi-slider fl-wrap full-height">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- swiper-slide -->
                    @foreach ($data['slideItems'] as $key => $item)
                        @if (isset($item['is_news']) && $item['is_news'])
                            <div class="swiper-slide">
                                <div class="bg-wrap">
                                    <div class="bg" data-bg="{{ $item['image'] }}" data-swiper-parallax="40%"></div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="hero-item fl-wrap">
                                    <div class="container">
                                        @if ($item['category'] != null)
                                            <a class="post-category-marker" href="{{URL::to('category',$item['category']->slug)}}">{{$item['category']->title}}</a>
                                        @endif
                                        <div class="clearfix"></div>
                                        <h2><a href="{{URL::to($item['slug'])}}">{{$item['title']}}</a></h2>
                                        <h4>{{$item['description']}}</h4>
                                        <div class="clearfix"></div>
                                        <div class="author-link">
                                            <a @if($item['author_id'])  href="{{route('profile.show', $item['author_id'])}}" @endif>
                                                <img src="{{ $item['author_image'] }}" alt="">
                                                <span>
                                                    {{$item['author']}}
                                                </span>
                                            </a>
                                        </div>
                                        <span class="post-date"><i class="far fa-clock"></i>  {{$item['date']}}</span>
                                    </div>
                                </div>
                            </div>
                        @elseif (isset($item['is_slide']) && $item['is_slide'])
                            <div class="swiper-slide">
                                <div class="bg-wrap">
                                    <div class="bg" data-bg="{{ $item['image']}}" data-swiper-parallax="40%"></div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="hero-item fl-wrap">
                                    <div class="container">
                                        <div class="clearfix"></div>
                                        <h2>{{$item['title']}}</h2>
                                        <h4>{{$item['description']}}</h4>
                                        <div class="clearfix"></div>
                                        <span class="post-date"><i class="far fa-clock"></i> {{$item['date']}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <!-- swiper-slide  end   -->
                </div>
            </div>
            <div class="fs-slider_btn color-bg fs-slider-button-prev"><i class="fas fa-caret-left"></i></div>
            <div class="fs-slider_btn color-bg fs-slider-button-next"><i class="fas fa-caret-right"></i></div>
        </div>
        <!-- hero-slider-container  end   -->
        <!-- hero-slider_controls-wrap   -->
        <div class="hero-slider_controls-wrap">
            <div class="container">
                <div class="hero-slider_controls-list multi-slider_control">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- swiper-slide  -->
                            @foreach ($data['slideItems'] as $bottomItem)
                                @if (isset($bottomItem['is_news']) && $bottomItem['is_news'])
                                    <div class="swiper-slide">
                                        <div class="hsc-list_item fl-wrap">
                                            <div class="hsc-list_item-media">
                                                <div class="bg-wrap">
                                                    <div class="bg" data-bg="{{ $bottomItem['thumbnail'] }}"></div>
                                                </div>
                                            </div>
                                            <div class="hsc-list_item-content fl-wrap">
                                                <h4>{{$bottomItem['title']}}</h4>
                                                <span class="post-date"><i class="far fa-clock"></i> {{$bottomItem['date']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @elseif (isset($bottomItem['is_slide']) && $bottomItem['is_slide'])
                                    <div class="swiper-slide">
                                        <div class="hsc-list_item fl-wrap">
                                            <div class="hsc-list_item-media">
                                                <div class="bg-wrap">
                                                    <div class="bg" data-bg="{{ $bottomItem['thumbnail'] }}"></div>
                                                </div>
                                            </div>
                                            <div class="hsc-list_item-content fl-wrap">
                                                <h4>{{$bottomItem['title']}}</h4>
                                                <span class="post-date"><i class="far fa-clock"></i> {{$bottomItem['date']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <!-- swiper-slide end   -->
                        </div>
                    </div>
                </div>
                <div class="multi-pag"></div>
            </div>
        </div>
        <!-- hero-slider_controls-wrap end  -->
        <div class="slider-progress-bar act-slider">
            <span>
                <svg class="circ" width="30" height="30">
                    <circle class="circ2" cx="15" cy="15" r="13" stroke="rgba(255,255,255,0.4)" stroke-width="1" fill="none" />
                    <circle class="circ1" cx="15" cy="15" r="13" stroke="#e93314" stroke-width="2" fill="none" />
                </svg>
            </span>
        </div>
    </div>

@endif
