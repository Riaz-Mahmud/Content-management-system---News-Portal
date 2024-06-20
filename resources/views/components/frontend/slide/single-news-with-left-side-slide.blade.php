<!-- section  -->
<section>
    <div class="container">
        @if (count($data['items'])>0)
            <div class="section-title sect_dec">
                <h2>Environment</h2>
                <h4>Don't miss daily news</h4>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="list-post-wrap list-post-wrap_column list-post-wrap_column_fw">
                        <!--list-post-->
                        <div class="list-post fl-wrap ">
                            <a class="post-category-marker" href="{{URL::to($data['items'][0]['category']->slug)}}">{{$data['items'][0]['category']->title}}</a>
                            <div class="list-post-media">
                                <a href="{{URL::to($data['items'][0]['slug'])}}">
                                    <div class="bg-wrap">
                                        <div class="bg" data-bg="{{$data['items'][0]['image']}}"></div>
                                    </div>
                                </a>
                                <span class="post-media_title">&copy; Image {{$data['items'][0]['author']}}</span>
                            </div>
                            <div class="list-post-content">
                                <h3><a href="{{URL::to($data['items'][0]['slug'])}}">{{$data['items'][0]['title']}}</a></h3>
                                <span class="post-date"><i class="far fa-clock"></i> {{$data['items'][0]['date']}}</span>
                                <p>{{$data['items'][0]['description']}}</p>
                                <ul class="post-opt">
                                    <li><i class="far fa-comments-alt"></i> {{$data['items'][0]['commentCount']}} </li>
                                    <li><i class="fal fa-eye"></i>  {{$data['items'][0]['viewCount']}} </li>
                                </ul>
                                <div class="author-link"><a href="{{route('profile.show', $data['items'][0]['author_id'])}}"><img src="{{$data['items'][0]['author_image']}}" alt="">  <span>By {{$data['items'][0]['author']}}</span></a></div>
                            </div>
                        </div>
                        <!--list-post end-->
                    </div>
                    <a href="blog2.html" class="dark-btn fl-wrap"> Read all News </a>
                </div>
                <div class="col-md-7">
                    <div class="picker-wrap-container fl-wrap">
                        <div class="picker-wrap-controls">
                            <ul class="fl-wrap">
                                <li><span class="pwc_up"><i class="fas fa-caret-up"></i></span></li>
                                <li><span class="pwc_pause"><i class="fas fa-pause"></i></span></li>
                                <li><span class="pwc_down"><i class="fas fa-caret-down"></i></span></li>
                            </ul>
                        </div>
                        <div class="picker-wrap fl-wrap">
                            <div class="list-post-wrap  fl-wrap">
                                <!--list-post-->
                                @for ($i = 1 ; $i < count($data['items']) ; $i++)
                                    <div class="list-post fl-wrap ">
                                        <div class="list-post-media">
                                            <a href="{{URL::to($data['items'][$i]['slug'])}}">
                                                <div class="bg-wrap">
                                                    <div class="bg" data-bg="{{URL::to($data['items'][$i]['image'])}}"></div>
                                                </div>
                                            </a>
                                            <span class="post-media_title">&copy; Image {{$data['items'][$i]['author']}}</span>
                                        </div>
                                        <div class="list-post-content">
                                            <a class="post-category-marker" href="{{URL::to($data['items'][$i]['category']->slug)}}">{{$data['items'][$i]['category']->title}}</a>
                                            <h3><a href="{{URL::to($data['items'][$i]['slug'])}}">{{$data['items'][$i]['title']}}</a></h3>
                                            <span class="post-date"><i class="far fa-clock"></i> {{$data['items'][$i]['date']}}</span>
                                            <p>{{$data['items'][$i]['description']}}</p>
                                            <ul class="post-opt">
                                                <li><i class="far fa-comments-alt"></i> {{$data['items'][$i]['commentCount']}} </li>
                                                <li><i class="fal fa-eye"></i>  {{$data['items'][$i]['viewCount']}} </li>
                                            </ul>
                                            <div class="author-link"><a href="{{route('profile.show', $data['items'][$i]['author_id'])}}"><img src="{{$data['items'][$i]['author_image']}}" alt="">  <span>By {{$data['items'][$i]['author']}}</span></a></div>
                                        </div>
                                    </div>
                                @endfor
                                <!--list-post end-->
                            </div>
                        </div>
                        <div class="controls-limit fl-wrap"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="limit-box"></div>
</section>
<!-- section end -->
