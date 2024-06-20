<div class="content">
    <div class="section-title">
        <h2>Happenings</h2>
        <h4>Don't miss daily news</h4>
        <div class="cate-nav">
            <ul>
                @foreach ($data['starCategories'] as $key => $category)
                    <li>
                        <a href="javascript:void(0)" id="{{ $category->slug }}" class="category {{ $key == 0 ? 'current_page active' : '' }}" data-id="{{ str_replace('/','-',$category->slug) }}">{{ $category->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="cate-wrapper fl-wrap">

        <div class="cate-content fl-wrap">
            <div class="cate-inner fl-wrap">
                <div class="list-post-wrap">
                    <!--list-post-->
                    @foreach ($data['starCategories'] as $category)
                        <div class="home-happenings-news" style="display: @if ($loop->first)  block @else none @endif "; id="home-happenings-news-{{ str_replace('/','-',$category->slug) }}">
                            @foreach ($category->news()->where('is_deleted',0)->limit(4)->get(); as $cateNews)
                                <div class="list-post fl-wrap">
                                    <div class="list-post-media">
                                        <a href="{{URL::to($cateNews->slug)}}">
                                            <div class="bg-wrap">
                                                <div class="bg" data-bg="{{ \App\Helpers\ImageHelper::generateImage($cateNews->image_src,'medium') }}"></div>
                                            </div>
                                        </a>
                                        <span class="post-media_title">&copy; {{ $cateNews->user->profile->first_name ?? '' }}</span>
                                    </div>
                                    <div class="list-post-content">
                                        <a class="post-category-marker" href="{{URL::to($category->slug )}}"> {{ $category->title }}</a>
                                        <h3><a href="{{URL::to($cateNews->slug)}}"> {{ \App\Helpers\StringHelper::title($cateNews->title) }}</a></h3>
                                        <span class="post-date"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($cateNews->created_at)->format('d M Y') }}</span>
                                        <p>{{ \App\Helpers\StringHelper::shortDescription($cateNews->description) }}</p>
                                        <ul class="post-opt">
                                            <li><i class="far fa-comments-alt"></i> {{ $cateNews->comment_count ?? '0'}}</li>
                                            <li><i class="fal fa-eye"></i>  {{ $cateNews->view_count ?? '0'}}</li>
                                        </ul>
                                        <div class="author-link"><a href="{{route('profile.show', $cateNews->user->email)}}"><img src="{{ \App\Helpers\ImageHelper::generateImage($cateNews->user->profile->image) }}" alt="">  <span>by {{ $cateNews->user->name }}</span></a></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <!--list-post end-->
                </div>
            </div>
        </div>

    </div>
</div>


