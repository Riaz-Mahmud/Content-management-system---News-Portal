@extends('frontend.layout.app')

@section('title', $data['category']->title ?? 'News |')

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />

      <!--section   -->
    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="{{ route('home') }}">Home</a><span>{{$data['rows']->title}}</span>
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
                {!! $data['rows']->content !!}
            </div>
        </div>

    </section>
    <!--about end   -->
    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />


 @endsection
