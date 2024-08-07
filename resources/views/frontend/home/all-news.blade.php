
@extends('frontend.layout.app')

@section('title', 'All News')

@section('css')
    <style>
        .cate-nav {
            position: absolute;
            right: 0;
            bottom: 20px;
            border: 1px solid #ddd;
            overflow: hidden;
            border-radius: 4px;
        }
        .cate-nav li {
            float: left;
            border-left: 1px solid #ddd;
        }
        .cate-nav li:first-child{
            border-left: none;
        }
        .cate-nav li a {
            padding: 8px 12px;
            float: left;
            background: #f9f9f9;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
        }
        .cate-nav li a.current_page {
            color: #fff;
            background: #08BA08;
        }
        .cate-loader {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            background: rgba(255,255,255,0.4);
            z-index: 100;
            padding-top: 100px;
            display: none;
        }
    </style>
@endsection

@section('content')

    <div id="main">
        <div class="progress-bar-wrap">
            <div class="progress-bar color-bg"></div>
        </div>
        <header class="main-header">
            <x-frontend.topbar.topbar :code="$data['hotNewses']" />
            <x-frontend.menu.menu-list :code="$data['menu']" />
        </header>
        <div id="wrapper">
            <div class="content">
                <x-frontend.user.user-login-registration />
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="main-container fl-wrap fix-container-init">
                                    @include('frontend.layout.all-news')
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="sidebar-content fl-wrap fix-bar">
                                    <x-frontend.news.recent-and-popular-news :popularNewses="$data['popularNewses']" :recentNewses="$data['recentNewses']" />
                                    <livewire:ad-show :code="'home_page'" :place="'home_page'"/>
                                    <x-frontend.social-icon.social-icon :position="'middle'" />
                                    <x-frontend.tags.popular-tags :code="$data['tags']" />
                                    <livewire:poll />
                                </div>
                            </div>

                        </div>
                        <div class="limit-box fl-wrap"></div>
                    </div>
                </section>
                <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />
            </div>
        </div>


    </div>

@endsection

@section('page-js')

    <script>
        $(document).ready(function(){
            $('.cate-nav li a').click(function(){
                $('.cate-nav li a').removeClass('current_page');
                $(this).addClass('current_page');
                var data = $(this).attr('data-id');

                $('.home-happenings-news').hide();
                $('#home-happenings-news-'+data).show();

            });

            // mail-subscribe-button click
            $('#mail-subscribe-button').click(function(){
                var email = $('#subscribe-email').val();
                if(email == ''){
                    $('#subscribe-email').focus();
                    return false;
                }
                $.ajax({
                    url: "{{ route('subscribe') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email
                    },
                    success: function(response){
                        if(response.status){
                            toastr.success(response.message);
                            $('#subscribe-email').val('');
                            $('.subscribe-message').attr('placeholder', response.message);
                        }else{
                            toastr.error(response.message);
                            $('.subscribe-message').attr('placeholder', response.message);
                        }
                    }
                });
            });

        });

    </script>
@endsection
