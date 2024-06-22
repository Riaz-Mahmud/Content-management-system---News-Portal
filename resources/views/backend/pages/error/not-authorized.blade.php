@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp
<!DOCTYPE html>

<html lang="{{ session()->get('locale') ?? app()->getLocale() }}" class="{{ $configData['style'] }}-style {{ $navbarFixed ?? '' }} {{ $menuFixed ?? '' }} {{ $menuCollapsed ?? '' }} {{ $footerFixed ?? '' }} {{ $customizerHidden ?? '' }}" dir="{{ $configData['textDirection'] }}" data-theme="{{ $configData['theme'] }}" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="{{ $configData['layout'] . '-menu-' . $configData['theme'] . '-' . $configData['style'] }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') |
    {{ config('variables.templateName') ? config('variables.templateName') : 'EC' }}</title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{Storage::url('assets/image/logo/logo.png')}}" />

  <!-- Include Styles -->
  @include('backend/layouts/sections/styles')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('backend/layouts/sections/scriptsIncludes')
</head>

<body>
  <!-- Layout Content -->
  <div class="container-xxl container-p-y col-xs-1" align="center">
  <div class="misc-wrapper">
    <h2 class="mb-2 mx-2">You are not authorized!</h2>
    <p class="mb-4 mx-2">You do not have permission to view this page using the credentials that you have provided while login. <br> Please contact your site administrator.</p>
    <a href="{{url('/')}}" class="btn btn-primary">Back to home</a>
    <div class="mt-5">
      <img src="{{asset('assets/backend/img/illustrations/girl-with-laptop-'.$configData['style'].'.png')}}" alt="page-misc-not-authorized-light" width="450" class="img-fluid" data-app-dark-img="illustrations/girl-with-laptop-dark.png" data-app-light-img="illustrations/girl-with-laptop-light.png">
    </div>
  </div>
</div>
  <!--/ Layout Content -->



  <!-- Include Scripts -->
  @include('backend/layouts/sections/scripts')

</body>

</html>
