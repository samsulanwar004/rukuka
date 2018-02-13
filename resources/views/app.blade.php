<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta id="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('app.rukuka') }} | @yield('title') </title>

    <!-- jQuery is required -->
    <link rel="stylesheet" href="{{ elixirCDN('css/app.css') }}">
    <link rel="shortcut icon" href="{{ imageCDN('favicon.png') }}">
    <script src="{{ elixirCDN('js/vendor.js') }}"></script>
    <script src="{{ elixirCDN('js/custom.js') }}"></script>
  </head>
  <body>
    <div id="app">
      <!-- Preloader -->
      <div id="preloader" class="uk-inline">
        <div class="uk-position-center" uk-spinner="ratio: 4"></div>
      </div>
      <div class="uk-visible@m">
        @include('partials.nav')
      </div>
      <div class="uk-hidden@m">
        @include('partials.mobile_nav')
      </div>

      @yield('content')
      @include('partials.footer')
    </div>
    <script src="{{ elixirCDN('js/main.js') }}"></script>
    <script src="{{ elixirCDN('js/app.js') }}"></script>
    @section('upload_scripts')
    @show
    @section('footer_scripts')
    @show
  </body>
</html>
