@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
dd($pageConfigs);
$configData = Helper::appClasses();

$customizerHidden = ($customizerHidden ?? '');
@endphp

@extends('layouts/commonMaster' )

@section('layoutContent')

<!-- Content -->
@yield('content')
<!--/ Content -->

@endsection
