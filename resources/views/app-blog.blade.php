<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title> @yield('title') </title>

    @php
      $metaTag = (new Symfony\Component\HttpFoundation\Session\Session)->get('meta_tag');
    @endphp
    
    <!-- SEO and Responsive -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaTag['web_meta_tag']['description'] }}">
    <meta name="googlebot-news" content="index,follow" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="all" />
    <meta name='language' content='EN'/>
    <meta name="author" content="rukuka">    
    <!-- end SEO and Responsive -->

    <!-- facebook META -->
    <meta property="og:title" content="{{ $metaTag['sosial_media_meta_tag']['title'] }}" />
    <meta property="og:description" content="{{ $metaTag['sosial_media_meta_tag']['description'] }}" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="EN" />
    <meta property="og:url" content="http://www.rukuka.com" />
    <meta property="og:site_name" content="{{ trans('app.rukuka') }} @yield('title')" />
<!--     <meta property="og:image" content="" /> -->
    <!-- end facebook META -->

    <!--twitter cards -->
    <meta name="twitter:card" content="summary_large_image" data-dynamic="true">
    <meta name="twitter:site" content="http://www.rukuka.com" data-dynamic="true">
    <meta name="twitter:title" content="{{ $metaTag['sosial_media_meta_tag']['title'] }}" data-dynamic="true">
    <meta name="twitter:description" content="{{ $metaTag['sosial_media_meta_tag']['description'] }}" data-dynamic="true">
    <meta name="twitter:creator" content="" data-dynamic="true">
    <!-- <meta name="twitter:image" content="" data-dynamic="true"> -->
    <meta name="twitter:url" content="http://www.rukuka.com" data-dynamic="true">
    <meta name="twitter:domain" content="http://www.rukuka.com" data-dynamic="true">
    <!-- end twitter cards -->

    <!--pavicon-->
    @include('partials.pavicon')
    <!--end pavicon-->

    <!-- CSRF Token -->
    <meta id="csrf-token" content="{{ csrf_token() }}">

    <!-- jQuery is required -->
    <link rel="stylesheet" href="{{ elixirCDN('css/app.css') }}">
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
        <div id="offcanvas-overlay-slide" uk-offcanvas="overlay: true">
        </div>
      </div>
      <div class="uk-offcanvas-content">
      @include('partials.nav-blog')
        @yield('content')
      @include('partials.footer')
      </div>
    </div>
    <script src="{{ elixirCDN('js/main.js') }}"></script>
    <script src="{{ elixirCDN('js/app.js') }}"></script>
    @section('footer_scripts')
    @show
  </body>
</html>
