<div class="col-md-8">
    <div class="main-container fl-wrap fix-container-init">
        <div class="section-title">
            <h3>Mark Rose Articles:</h3>
            <div class="steader_opt steader_opt_abs">
                <select name="filter" id="list" data-placeholder="Persons" class="style-select no-search-select">
                    <option>Latest</option>
                    <option>Most Read</option>
                    <option>Most Viewed</option>
                    <option>Most Commented</option>
                </select>
            </div>
        </div>
        <div class="grid-post-wrap">
            <div class="row">
                @foreach ($data['items'] as $item)
                    <div class="col-md-6">
                        <div class="grid-post-item  bold_gpi  fl-wrap">
                            <div class="grid-post-media">
                                <a href="post-single.html" class="gpm_link">
                                    <div class="bg-wrap">
                                        <div class="bg" data-bg="{{ $item['image'] }}"></div>
                                    </div>
                                </a>
                                <span class="post-media_title">&copy; {{ $item['author'] }}</span>
                            </div>
                            <a class="post-category-marker purp-bg" href="{{ URL::to($item['category']->slug) }}">{{ $item['category']->title }}</a>
                            <div class="grid-post-content">
                                <h3><a href="{{ $item['slug'] }}">{{ $item['title'] }}</a></h3>
                                <span class="post-date"><i class="far fa-clock"></i>  {{ $item['date'] }}</span>
                                <p>{{ $item['description'] }}</p>
                            </div>
                            <div class="grid-post-footer">
                                <div class="author-link"><a href="{{ route('profile.show', $item['author_id']) }}"><img src="{{ $item['author_image'] }}" alt="{{ $item['author'] }}">  <span>By {{ $item['author'] }}</span></a></div>
                                <ul class="post-opt">
                                    <li><i class="far fa-comments-alt"></i> {{ $item['commentCount'] }}</li>
                                    <li><i class="fal fa-eye"></i>  {{ $item['viewCount'] }} </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--grid-post-wrap end-->

        <!--pagination-->
        {!! $data['news']->links('vendor.pagination.profile-page-news') !!}
        <!--pagination end-->
    </div>
</div>
