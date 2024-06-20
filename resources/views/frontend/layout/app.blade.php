<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>@yield('title') | {{ config('frontend.site.title') }}</title>
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="{{ config('frontend.site.keywords') }}" />
        <meta name="description" content="{{ config('frontend.site.description') }}" />
        <meta name="author" content="{{ config('frontend.site.author') }}" />
        <!--=============== css  ===============-->
        <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/css/plugins.css')}}" >
        <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/css/color.css')}}">
        <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/toastr/toastr.css')}}" />
        <!--=============== favicons ===============-->
        <link rel="icon" href="{{ Storage::url(config('frontend.site.favicon')) }}">
        @livewireStyles

        @yield('css')

    </head>

    <body>
        @yield('content')


        @include('frontend.layout.scripts')

        @yield('script')

    </body>

</html>
