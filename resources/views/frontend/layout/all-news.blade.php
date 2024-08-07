<div class="section-title sect_dec">
    <h2>More News</h2>
    <h4>Don't miss daily news</h4>
</div>
<div class="grid-post-wrap ">
    <div class="more-post-wrap fl-wrap">
        <div class="list-post-wrap list-post-wrap_column fl-wrap">
            <div class="row">
                @foreach ($data['allNewses'] as $key => $news)
                    <x-frontend.news.sigle-news-with-image-title :news="$news"/>
                @endforeach

            </div>
        </div>
    </div>
</div>
