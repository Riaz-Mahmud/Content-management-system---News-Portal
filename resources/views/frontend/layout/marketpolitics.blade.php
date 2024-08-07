<div class="section-title sect_dec">
    <h2>More News</h2>
    <h4>Don't miss daily news</h4>
</div>
<div class="grid-post-wrap ">
    <div class="more-post-wrap fl-wrap">
        <div class="list-post-wrap list-post-wrap_column fl-wrap">
            <div class="row">
                @for($i=0; $i<2; $i++)
                    @if(!empty($data['MarketPoliticsNewses'][$i]))
                        <x-frontend.news.sigle-news-with-image-title :news="$data['MarketPoliticsNewses'][$i]"/>
                    @endif
                @endfor
            </div>
        </div>
    </div>

    <!--grid-post-item-->
    <x-frontend.slide.single-item-full-width-box-slide slug="category/market-and-politics/technology" limit="3" />
    <!--grid-post-item end-->
    <div class="more-post-wrap  fl-wrap">
        <div class="list-post-wrap list-post-wrap_column fl-wrap">
            <div class="row">
                @for($i=2; $i<count($data['MarketPoliticsNewses']); $i++)
                    @if(!empty($data['MarketPoliticsNewses'][$i]))
                        <x-frontend.news.sigle-news-with-image-title :news="$data['MarketPoliticsNewses'][$i]"/>
                    @endif
                @endfor
            </div>
        </div>
    </div>
</div>
<a href="{{route('all-news')}}" class="dark-btn fl-wrap"> Read all News </a>
