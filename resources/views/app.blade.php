<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title> @yield('title') </title>

    @php
      $metaTag = (new Symfony\Component\HttpFoundation\Session\Session)->get('meta_tag');
      $doFollow = (new Symfony\Component\HttpFoundation\Session\Session)->get('do_follow');
    @endphp

   <!-- SEO and Responsive -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaTag['web_meta_tag']['description'] }}">
    <meta name='language' content='EN'/>
    <meta name="author" content="rukuka">

    @if($doFollow == true)
    <meta name="googlebot-news" content="index,follow" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="all" />
    @else
    <meta name="googlebot-news" content="nofollow" />
    <meta name="robots" content="nofollow" />
    <meta name="googlebot" content="nofollow" />
    @endif
    <!-- end SEO and Responsive -->

    <!-- Start Global site tag (gtag.js) - Google Analytics -->
    @if(config('common.google_analytics') == TRUE)
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-99161447-3"></script>
      <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-99161447-3');
      </script>
    @endif
    <!-- End Global site tag (gtag.js) - Google Analytics -->

    <!-- facebook META -->
    <meta property="og:title" content="{{ $metaTag['sosial_media_meta_tag']['title'] }}" />
    <meta property="og:description" content="{{ $metaTag['sosial_media_meta_tag']['description'] }}" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="EN" />
    <meta property="og:url" content="http://www.rukuka.com" />
    <meta property="og:site_name" content="{{ trans('app.rukuka') }} @yield('title')" />
    <!--<meta property="og:image" content="" /> -->
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

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NRS5V6D');</script>
    <!-- End Google Tag Manager -->

    <!-- CSRF Token -->
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="nFdFuv0V-IaFTa6HdepAZ1hYEsEY02ijn9kUbR2ieMQ" />
    <!-- jQuery is required -->
    <link rel="stylesheet" href="{{ elixirCDN('css/app.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="{{ elixirCDN('js/vendor.js') }}"></script>
    <script src="{{ elixirCDN('js/custom.js') }}"></script>
    @section('header_scripts')
    @show
  </head>
  <body>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NRS5V6D"
    height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
    <!-- End Google Tag Manager (noscript) -->

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
    @section('navigation_scripts')
    @show
    @section('footer_scripts')
    @show
  </body>
  <script type="text/javascript">
  var cbpAnimatedHeader = (function() {

  var docElem = document.documentElement,
    header = document.querySelector( '.cbp-af-header' ),
    didScroll = false,
    changeHeaderOn = 10;

  function init() {
    window.addEventListener( 'scroll', function( event ) {
      if( !didScroll ) {
        didScroll = true;
        setTimeout( scrollPage, 0 );
      }
    }, false );
  }

  function scrollPage() {
    var sy = scrollY();
    if ( sy >= changeHeaderOn ) {
      classie.add( header, 'cbp-af-header-shrink' );
    }
    else {
      classie.remove( header, 'cbp-af-header-shrink' );
    }
    didScroll = false;
  }

  function scrollY() {
    return window.pageYOffset || docElem.scrollTop;
  }

  init();

  })();
    </script>
</html>
