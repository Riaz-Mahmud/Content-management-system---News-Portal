<div class="box-widget fl-wrap">
    <div class="box-widget-content">
        <!-- content-tabs-wrap -->
        <div class="content-tabs-wrap tabs-act tabs-widget fl-wrap">
            <div class="content-tabs fl-wrap">
                <ul class="tabs-menu fl-wrap no-list-style">
                    @if (count($data['popularNewses']) > 0)
                        <li class="current"><a href="#tab-popular"> Popular News </a></li>
                    @endif
                    @if (count($data['recentNewses']) > 0)
                        <li><a href="#tab-resent">Resent News</a></li>
                    @endif
                </ul>
            </div>
            <!--tabs -->
            <div class="tabs-container">
                <!--tab -->
                <div class="tab ">
                    <div id="tab-popular" class="tab-content first-tab">
                        <div class="post-widget-container fl-wrap">
                            <!-- post-widget-item -->
                            @foreach ($data['popularNewses'] as $popular)
                                <div class="post-widget-item fl-wrap">
                                    <div class="post-widget-item-media">
                                        <a href="{{ URL::to($popular['slug'])}}"><img src="{{ $popular['image'] }}" alt=""></a>
                                    </div>
                                    <div class="post-widget-item-content">
                                        <h4><a href="{{ URL::to($popular['slug'])}}"> {{ $popular['title'] }}</a></h4>
                                        <ul class="pwic_opt">
                                            <li><span><i class="far fa-clock"></i> {{ $popular['date'] }}</span></li>
                                            <li><span><i class="far fa-comments-alt"></i> {{ $popular['commentCount'] }}</span></li>
                                            <li><span><i class="fal fa-eye"></i> {{ $popular['viewCount'] }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            <!-- post-widget-item end -->
                        </div>
                    </div>
                </div>
                <!--tab  end-->
                <!--tab -->
                <div class="tab">
                    <div id="tab-resent" class="tab-content">
                        <div class="post-widget-container fl-wrap">
                            <!-- post-widget-item -->
                            @foreach ( $data['recentNewses'] as $recent)
                                <div class="post-widget-item fl-wrap">
                                    <div class="post-widget-item-media">
                                        <a href="{{ URL::to($recent['slug'])}}"><img src="{{ $recent['image'] }}" alt=""></a>
                                    </div>
                                    <div class="post-widget-item-content">
                                        <h4><a href="{{ URL::to($recent['slug'])}}"> {{ $recent['title'] }}</a></h4>
                                        <ul class="pwic_opt">
                                            <li><span><i class="far fa-clock"></i> {{ $recent['date'] }}</span></li>
                                            <li><span><i class="far fa-comments-alt"></i> {{ $recent['commentCount'] }}</span></li>
                                            <li><span><i class="fal fa-eye"></i> {{ $recent['viewCount'] }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            <!-- post-widget-item end -->
                        </div>
                    </div>
                </div>
                <!--tab end-->
            </div>
            <!--tabs end-->
        </div>
        <!-- content-tabs-wrap end -->
    </div>
</div>
