@extends('frontend.layout.app')

@section('title', 'Category Newses')

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />

    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="{{ route('home') }}">Home</a>
                <span>
                    {{ $data['category']->title ?? 'Category' }}
                </span>
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
                        <div class="section-title">
                            <h2>{{ $data['category']->title ?? 'Category' }}</h2>
                            <h4>Don't miss daily news</h4>
                            <div class="steader_opt steader_opt_abs">
                                <select name="filter" id="list" data-placeholder="Persons" class="style-select no-search-select">
                                    <option>Latest</option>
                                    <option>Most Read</option>
                                    <option>Most Viewed</option>
                                    <option>Most Commented</option>
                                </select>
                            </div>
                        </div>
                        <div class="list-post-wrap">

                            @if (count($data['rows']) > 0)
                                @foreach ($data['rows'] as $item)
                                    <x-frontend.news.single-news-by-category :news="$item" :category="$data['fixedCategory']"/>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <strong>Warning!</strong> Not data found.
                                    </div>
                                </div>
                            @endif

                        </div>

                        <!--pagination-->
                        @if(!empty($data['rows']))
                        {!! $data['rows']->links('vendor.pagination.profile-page-news') !!}
                        @endif
                        <!--pagination end-->
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
                                        <input name="q" id="se12" type="text" class="search" placeholder="Search..." value="" autocomplete="search">
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
                                    @foreach ($data['allCategory'] as $category)
                                        <li><a href="{{URL::to($category->slug)}}">{{$category->title}}</a><span>{{$category->count}}</span></li>
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
