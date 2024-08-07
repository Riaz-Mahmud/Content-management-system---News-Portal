@extends('frontend.layout.app')

@section('title', $data['rose']->title ?? 'News' .' | News Details')

@section('content')


    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />

    <!-- wrapper -->

    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="{{route('home')}}">Home</a><span>News Details</span>
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
            <div class="row">
                <div class="col-md-8">
                    <div class="main-container fl-wrap fix-container-init">
                        <!-- single-post-header  -->
                        <div class="single-post-header fl-wrap">
                            @foreach ( $data['rose']['category'] as $newsCategories)
                            <a class="post-category-marker" href="{{URL::to('category',$newsCategories->slug)}}" style="margin-right: 2px;">{{$newsCategories->title}}</a>
                            @endforeach
                            <div class="clearfix"></div>
                            <h1>{{$data['rose']->title}}</h1>
                            <div class="clearfix"></div>
                            <div class="author-link"><a href="{{ route('profile.show', $data['rose']->user->email) }}"><img src="{{ \App\Helpers\ImageHelper::generateImage($data['rose']->user->profile->image)}}" alt="">  <span>By {{ $data['rose']->user->name }}</span></a></div>
                            <span class="post-date"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($data['rose']->created_at)->format('d F Y')}}</span>
                            <ul class="post-opt">
                                <li><i class="far fa-comments-alt"></i> {{$data['rose']->comment_count}}</li>
                                <li><i class="fal fa-eye"></i>  {{$data['rose']->view_count}} </li>
                            </ul>
                        </div>
                        <!-- single-post-header end   -->
                        <!-- single-post-media   -->
                        <div class="single-post-media fl-wrap">
                            @if (($data['rose']->image_src != null && $data['rose']->image_src != '') || ($data['rose']->attachment_src != null && $data['rose']->attachment_src != ''))
                                <div class="fl-wrap">
                                    <div class="single-slider fl-wrap">
                                        <div class="swiper-container">
                                            <div class="lightgallery">
                                                <!-- swiper-slide   -->
                                                @if ($data['rose']->attachment_src != null && $data['rose']->attachment_src != '' && $data['rose']->attachment_type == 'video')
                                                    <div class="swiper-slide">
                                                        <video autoplay controls loop class="video" width="100%" controlsList="nodownload" poster="@if ($data['rose']->image_src != null && $data['rose']->image_src != '') {{ \App\Helpers\ImageHelper::generateImage($data['rose']->image_src, 'medium') }} @endif">
                                                            <source src="{{ Storage::url($data['rose']->attachment_src) }}" type="video/mp4">
                                                        </video>
                                                        <span class="post-media_title pmd_vis">© {{ $data['rose']->user ? $data['rose']->user->name : ''}} </span>
                                                    </div>
                                                @else
                                                <div class="swiper-slide hov_zoom">
                                                    <img src="{{ \App\Helpers\ImageHelper::generateImage($data['rose']->image_src, 'medium')}}" alt="">
                                                    <a href="{{ \App\Helpers\ImageHelper::generateImage($data['rose']->image_src, 'main') }}" class="box-media-zoom   popup-image"><i class="fas fa-search"></i></a>
                                                    <span class="post-media_title pmd_vis">© {{ $data['rose']->user ? $data['rose']->user->name : ''}} </span>
                                                </div>
                                                @endif
                                                <!-- swiper-slide end   -->
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="ss-slider-controls2">
                                        <div class="ss-slider-pagination pag-style"></div>
                                    </div> --}}
                                    {{-- <div class="ss-slider-cont ss-slider-cont-prev"><i class="fas fa-caret-left"></i></div> --}}
                                    {{-- <div class="ss-slider-cont ss-slider-cont-next"><i class="fas fa-caret-right"></i></div> --}}
                                </div>
                            @endif
                        </div>
                        <!-- single-post-media end   -->
                        <!-- single-post-content   -->
                        <div class="single-post-content spc_column fl-wrap">
                            <div class="single-post-content_column">
                                <div class="share-holder ver-share fl-wrap">
                                    <div class="share-title">Share This <br> Article:</div>
                                    <div class="share-container  isShare"></div>
                                </div>
                            </div>
                            <div class="fs-wrap smpar fl-wrap">
                                {{-- font size change --}}
                                {{-- <div class="fontSize"><span class="fs_title">Font size: </span><input type="text" class="rage-slider" data-step="1" data-min="12" data-max="15" value="12"></div> --}}
                                <div class="show-more-snopt smact"><i class="fal fa-ellipsis-v"></i></div>
                                <div class="show-more-snopt-tooltip">
                                    <a href="#comments" class="custom-scroll-link"> <i class="fas fa-comment-alt"></i> Write a Comment</a>
                                    <a href="#"> <i class="fas fa-exclamation-triangle"></i> Report </a>
                                </div>
                                <a class="print-btn" href="javascript:window.print()" data-microtip-position="bottom"><span>Print</span><i class="fal fa-print"></i></a>
                            </div>
                            <div class="clearfix"></div>
                            {{-- <div class="single-post-content_text" id="font_chage">
                                <p class="has-drop-cap">Lorem ipsum dosectetur adipisicing elit, sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus at leo dignissim congue. Mauris elementum accumsan leo vel tempor. Sit amet cursus nisl aliquam. Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor . Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor</p>
                                <h4 class="mb_head">Middle Post Heading</h4>
                                <p>Lorem ipsum dosectetur adipisicing elit, sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus at leo dignissim congue. Mauris elementum accumsan leo vel tempor. Sit amet cursus nisl aliquam. Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor . Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor</p>
                                <div class="single-post-content_text_media fl-wrap">
                                    <div class="row">
                                        <div class="col-md-6"><img src=" {{asset('assets/frontend/images/all/topstories/5.jpg')}} " alt="" class="respimg"></div>
                                        <div class="col-md-6">
                                            <p> Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. </p>
                                            <p> Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. </p>
                                        </div>
                                    </div>
                                </div>
                                <p> Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. </p>
                                <h4 class="mb_head">Middle Post Heading</h4>
                                <div class="single-post-content_text_media fl-wrap">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="has-drop-cap">  Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus.  faucibus.Cras lacinia magna vel molestie faucibus.   </p>
                                        </div>
                                        <div class="col-md-6"><img src="{{asset('assets/frontend/images/all/topstories/5.jpg')}} " alt="" class="respimg"></div>
                                    </div>
                                </div>
                                <p> Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. </p>
                                <blockquote>
                                    <p> Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.Cras lacinia magna vel molestie faucibus. </p>
                                </blockquote>
                                <p>Lorem ipsum dosectetur adipisicing elit, sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus at leo dignissim congue. Mauris elementum accumsan leo vel tempor. Sit amet cursus nisl aliquam. Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor . Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor</p>
                                <p>  Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus Lorem ipsum dosectetur adipisicing elit at leo dignissim congue. Mauris elementum accumsan leo vel tempor.</p>
                            </div> --}}
                            <div class="single-post-content_text" id="font_chage">
                                {!! $data['rose']->content !!}
                            </div>
                            <div class="single-post-footer fl-wrap">
                                <div class="post-single-tags">
                                    <span class="tags-title"><i class="fas fa-tag"></i> Tags : </span>
                                    <div class="tags-widget">
                                        @foreach ($data['rose']['tags'] as $tag)
                                            <a href="{{URL::to('tag',$tag->label)}}">{{$tag->label}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- single-post-nav"   -->
                            {{-- <div class="single-post-nav fl-wrap">
                                <a href="post-single.html" class="single-post-nav_prev spn_box">
                                    <div class="spn_box_img">
                                        <img src="{{asset('assets/frontend/images/all/topstories/6.jpg')}} " class="respimg" alt="">
                                    </div>
                                    <div class="spn-box-content">
                                        <span class="spn-box-content_subtitle"><i class="fas fa-caret-left"></i> Prev Post</span>
                                        <span class="spn-box-content_title">New VR Glasses and Headset System Release</span>
                                    </div>
                                </a>
                                <a href="post-single.html" class="single-post-nav_next spn_box">
                                    <div class="spn_box_img">
                                        <img src="{{asset('assets/frontend/images/all/topstories/7.jpg')}} " class="respimg" alt="">
                                    </div>
                                    <div class="spn-box-content">
                                        <span class="spn-box-content_subtitle">Next Post <i class="fas fa-caret-right"></i></span>
                                        <span class="spn-box-content_title">$310m to help Fossil Fueles in latest Lockdow</span>
                                    </div>
                                </a>
                            </div> --}}
                            <!-- single-post-nav"  end   -->
                        </div>
                        <!-- single-post-content  end   -->
                        <div class="limit-box2 fl-wrap"></div>
                        <!-- post-author-->
                        <div class="post-author fl-wrap">
                            <div class="author-img">
                                <img  src=" {{ \App\Helpers\ImageHelper::generateImage($data['rose']->user->profile->image)}} " alt="">
                            </div>
                            <div class="author-content fl-wrap">
                                <h5>Written By <a href="{{ route('profile.show', $data['rose']->user->email) }}">{{ $data['rose']->user->name }}</a></h5>
                                <p>{{ $data['rose']->user->profile->about }}</p>
                            </div>
                            <div class="profile-card-footer fl-wrap">
                                <a href="{{ route('profile.show', $data['rose']->user->email) }}" class="post-author_link">View Profile <i class="fas fa-caret-right"></i></a>

                            </div>
                        </div>
                        <!--post-author end-->
                        @if (count($data['rose']['relatedNews']) > 0)
                            <div class="more-post-wrap  fl-wrap">
                                <div class="pr-subtitle prs_big">Related Posts</div>
                                <div class="list-post-wrap list-post-wrap_column fl-wrap">
                                    <div class="row">
                                        @foreach ($data['rose']['relatedNews'] as $relatedNews)
                                            <x-frontend.news.sigle-news-with-image-title :news="$relatedNews" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <livewire:ad-show :code="'news_detail_page'" :place="'news_details_page_banner'"/>
                        <!--comments  -->
                        @if ($data['rose']->can_comment=='yes')
                            <div id="comments" class="single-post-comm fl-wrap">
                                <div class="pr-subtitle prs_big">Commnets <span>{{ $data['rose']->comment_count}}</span></div>
                                @if (count($data['rose']['comments']) > 0)
                                    <ul class="commentlist clearafix">
                                        @foreach ($data['rose']['comments'] as $comment)
                                            <li class="comment">
                                                <div class="comment-author">
                                                    <img alt="" src=" {{ \App\Helpers\ImageHelper::generateImage($comment->user->profile->image, 'main')}}" width="50" height="50">
                                                </div>
                                                <div class="comment-body smpar">
                                                    <h4><a href="{{ route('profile.show', $comment->user->email) }}">{{$comment->user->name}}</a></h4>
                                                    <div class="box-widget-menu-btn smact"><i class="far fa-ellipsis-h"></i></div>
                                                    <div class="show-more-snopt-tooltip bxwt">
                                                        {{-- <a href="#"> <i class="fas fa-reply"></i> Reply</a> --}}
                                                        <a href="#"> <i class="fas fa-exclamation-triangle"></i> Report </a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p>{{$comment->content}}</p>
                                                    @if ($comment->image || $comment->video)
                                                        <div class="comment-media">
                                                            @if ($comment->image)
                                                                <img src="{{ \App\Helpers\ImageHelper::generateImage($comment->image) }}" alt="" width="70%">
                                                            @endif
                                                            @if ($comment->video)
                                                                <video controls controlsList="nodownload" volume="0">
                                                                    <source src="{{ \App\Helpers\ImageHelper::generateVideo($comment->video) }}" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    {{-- <a class="comment-reply-link" href="#"><i class="fas fa-reply"></i> Reply</a> --}}
                                                    <div class="comment-meta"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($comment->created_at)->format('F d, Y') }}</div>
                                                    <div class="comment-body_dec"></div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="clearfix"></div>
                                @if (config('frontend.comment.canComment'))
                                <div id="addcom" class="clearafix">
                                    <div class="pr-subtitle"> Leave A Comment <i class="fas fa-caret-down"></i></div>
                                    @if (Auth::check())
                                        <div class="comment-reply-form fl-wrap">
                                            <form id="add-comment" class="add-comment custom-form" action="{{route('news.store.comment', $data['rose']['hashId'])}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @if(config('frontend.comment.messageBox'))
                                                    <fieldset>
                                                        <textarea placeholder="Your Comment:" name="comment"></textarea>
                                                    </fieldset>
                                                @endif
                                                @if(config('frontend.comment.attachment'))
                                                <div class="mb-3">
                                                    <label class="form-label required" for="add-news-image">Attach image/video</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="add-news-comment-file" name="attach_file" accept="image/*,video/*">
                                                    </div>
                                                </div>
                                                @endif
                                                <button class="btn float-btn color-btn">  Submit Comment <i class="fas fa-caret-right"></i> </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="comment-reply-form fl-wrap">
                                            <button class="btn float-btn color-btn show-reg-form" style="border:none; -webkit-appearance: none; cursor:pointer; margin-top:20px; padding: 18px 30px; border-radius: 4px;">  Login First <i class="fas fa-caret-right"></i> </button>
                                        </div>
                                    @endif

                                </div>
                                @endif
                                <!--end respond-->
                            </div>
                        @endif
                        <!--comments end -->
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- sidebar   -->
                    <div class="sidebar-content fl-wrap fixed-bar">
                        <!-- box-widget -->
                        <div class="box-widget fl-wrap">
                            <div class="box-widget-content">
                                <div class="search-widget fl-wrap">
                                    <form action="{{route('search')}}" method="GET">
                                        <input name="q" id="se12" type="text" class="search" placeholder="Search..." value="" />
                                        <button class="search-submit2" id="submit_btn12"><i class="far fa-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- box-widget  end -->
                        <!-- box-widget -->
                        <livewire:ad-show :code="'home_page'" :place="'news_details_page'"/>
                        <!-- box-widget  end -->
                        <!-- box-widget -->
                        <div class="box-widget fl-wrap">
                            <div class="widget-title">Categories</div>
                            <div class="box-widget-content">
                                <ul class="cat-wid-list">
                                    @foreach ($data['rose']['category'] as $category)
                                        <li><a href="{{URL::to('category', $category->slug)}}">{{$category->title}}</a><span>{{$category->count}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- box-widget  end -->
                        <!-- box-widget -->
                        <x-frontend.tags.popular-tags :code="$data['tags']" />
                        <!-- box-widget  end -->
                        <!-- box-widget -->
                        <x-frontend.social-icon.social-icon :position="'middle'" />
                        <!-- box-widget  end -->
                        <!-- box-widget -->
                        <x-frontend.news.recent-and-popular-news :popularNewses="$data['popularNewses']" :recentNewses="$data['recentNewses']" />
                        <!-- box-widget  end -->
                    </div>
                    <!-- sidebar  end -->
                </div>
            </div>
            <div class="limit-box fl-wrap"></div>
        </div>
    </section>
    <!-- section end -->

    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

@endsection
