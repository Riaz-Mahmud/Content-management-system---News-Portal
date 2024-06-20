@extends('frontend.layout.app')

@section('title', 'Webinar')

@section('content')


    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />


    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="#">Home</a><span>Webiner</span>
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
    <!-- section end  -->
    <!--section   -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="main-container fl-wrap fix-container-init">
                        <div class="section-title">
                            <h3>Sorty by:</h3>
                            <div class="steader_opt steader_opt_abs">
                                <select name="filter" id="list" data-placeholder="Persons" class="style-select no-search-select">
                                    <option>Latest</option>
                                    <option>Most Read</option>
                                    <option>Most Viewed</option>
                                    <option>Most Commented</option>
                                </select>
                            </div>
                        </div>
                        <!--grid-post-wrap-->
                        <div class="grid-post-wrap">
                            <div class="row">
                                <!--grid-post-item-->
                                @foreach ($data['rows'] as $row)
                                    <div class="col-md-6">
                                        <div class="grid-post-item  bold_gpi  fl-wrap">
                                            <div class="grid-post-media">
                                                    <a href="{{$row['link']}}" target="blank" class=" gpm_link btn float-btn color-btn"> <span>Our Vision Video</span> <i class="fas fa-caret-right"></i>
                                                    <div class="bg-wrap">
                                                        <div class="bg" data-bg="{{$row['image']}}"></div>
                                                    </div>
                                                </a>
                                            </div>
                                            <a class="post-category-marker purp-bg" style="background-color: red">Live</a>
                                            <div class="grid-post-content">
                                                <h3><a href="post-single.html">{{$row['title']}}</a></h3>
                                                <p>{{$row['description']}}</p>
                                            </div>
                                            <div class="grid-post-footer">
                                                <span style="font-size: 15px">Start Time: {{$row['start_time']}}</span><br>
                                                <span style="font-size: 15px">End Time: {{$row['end_time']}}</span><br>
                                                <span style="font-size: 15px"><b>Meeting password: {{$row['password']}}</b></span>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!--grid-post-item end-->
                            </div>
                        </div>
                        <!--grid-post-wrap end-->

                        <!--pagination-->
                        {!! $data['rows']->links('vendor.pagination.profile-page-news') !!}
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
                                    @foreach ($data['allCategory'] as $category)
                                        <li><a href="{{URL::to($category->slug)}}">{{$category->title}}</a><span>{{$category->count}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- box-widget  end -->

                        <!-- box-widget -->
                        <x-frontend.social-icon.social-icon :position="'middle'" />
                        <!-- box-widget  end -->

                    </div>
                    <!-- sidebar  end -->
                </div>
            </div>
            <div class="limit-box fl-wrap"></div>
        </div>
    </section>
    <!-- section  -->

    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

@endsection
