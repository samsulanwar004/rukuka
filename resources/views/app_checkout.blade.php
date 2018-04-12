<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <title> @yield('title') </title>
  <meta name="google-site-verification" content="nFdFuv0V-IaFTa6HdepAZ1hYEsEY02ijn9kUbR2ieMQ" />

  <!--pavicon-->
@include('partials.pavicon')
<!--end pavicon-->

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta id="csrf-token" content="{{ csrf_token() }}">

  <!-- jQuery is required -->
  <link rel="stylesheet" href="{{ elixirCDN('css/app.css') }}">
  <script src="{{ elixirCDN('js/vendor.js') }}"></script>
  <script src="{{ elixirCDN('js/custom.js') }}"></script>
  @section('header_scripts')
  @show

</head>
<body>
<div id="app">
  <!-- Preloader -->
  {{-- <div id="preloader" class="uk-inline">
    <div class="uk-position-center" uk-spinner="ratio: 4"></div>
  </div> --}}
  @include('partials.header_checkout')
  @yield('content')
  @include('partials.footer_checkout')
</div>
<script src="{{ elixirCDN('js/main.js') }}"></script>
<script src="{{ elixirCDN('js/app.js') }}"></script>
@section('footer_scripts')
@show
</body>
</html>
