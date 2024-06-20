@extends('frontend.layout.app')

@section('title', $data['rose']->last_name ?? 'User' .' | Profile')

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />


    <!--section   -->
    <section class="hero-section" style="z-index: 0">
        <div class="bg-wrap hero-section_bg">
            <div class="bg" data-bg="{{Storage::url('assets/image/background/1.jpg')}}"></div>
        </div>
        <div class="container">
            <div class="hero-section_title">
                <h2>{{$data['rose']->first_name}} {{$data['rose']->last_name}}’s Den</h2>
            </div>
            <div class="clearfix"></div>
            <div class="breadcrumbs-list fl-wrap">
                <a href="{{route('home')}}">Home</a><span>Profile</span>
            </div>
            <div class="scroll-down-wrap scw_transparent">
                <div class="mousey">
                    <div class="scroller"></div>
                </div>
                <span>Scroll Down To Discover</span>
            </div>
        </div>
    </section>
    <!-- section end  -->
    <!--section   -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @include('frontend.partials.pages.profile.profileSidebar')
                </div>
                <div class="col-md-8">
                    <div class="main-container fl-wrap fix-container-init">
                        {{-- author artical list start --}}
                        <div>
                            <div class="section-title">
                                <h3>{{$data['rose']->first_name}} {{$data['rose']->last_name}} Articles:</h3>
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
                                    @foreach ($data['rose']['news'] as $item)
                                        <div class="col-md-6">
                                            <div class="grid-post-item  bold_gpi  fl-wrap">
                                                <div class="grid-post-media">
                                                    <a href="{{URL::to($item->slug)}}" class="gpm_link">
                                                        <div class="bg-wrap">
                                                            <div class="bg" data-bg="{{ \App\Helpers\ImageHelper::generateImage($item->image_src,'main') }}"></div>
                                                        </div>
                                                    </a>
                                                    <span class="post-media_title">&copy; {{ $item->user ? $item->user->name : '' }}</span>
                                                </div>
                                                <a class="post-category-marker purp-bg" href="{{ URL::to($item->category()->first()->slug) }}">{{ \App\Helpers\StringHelper::title($item->category()->first()->title?? '') }}</a>
                                                <div class="grid-post-content" style="height: 150px">
                                                    <h3><a href="{{ URL::to($item->slug) }}">{{ \App\Helpers\StringHelper::title($item->title ?? '') }}</a></h3>
                                                    <span class="post-date"><i class="far fa-clock"></i>  {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</span>
                                                    <p>{{ \App\Helpers\StringHelper::shortDescription($item->description ?? '') }}</p>
                                                </div>
                                                <div class="grid-post-footer">
                                                    <div class="author-link">
                                                        <a href="{{ route('profile.show', $item->user->email) }}">
                                                            <img src="{{ \App\Helpers\ImageHelper::generateImage($item->user->profile->image) }}" alt="{{ $item->user ? $item->user->name : '' }}">  <span>By {{ $item->user ? $item->user->name : '' }}</span>
                                                        </a>
                                                    </div>
                                                    <ul class="post-opt">
                                                        <li><i class="far fa-comments-alt"></i> {{ $item->comment_count ?? 0 }}</li>
                                                        <li><i class="fal fa-eye"></i>  {{ $item->view_count ?? 0 }} </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--grid-post-wrap end-->

                            <!--pagination-->
                            {!! $data['rose']['news']->links('vendor.pagination.profile-page-news') !!}
                            <!--pagination end-->
                        </div>
                        {{-- author artical list end --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>
    </section>


    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

@endsection

