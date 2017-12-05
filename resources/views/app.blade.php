<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta id="csrf-token" content="{{ csrf_token() }}">

    <title>rukuka</title>

    <!-- jQuery is required -->
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

  </head>
  <body>
    <div id="app">
      <!-- Preloader -->
      <div id="preloader">
        <div id="status">&nbsp;</div>
      </div>
      <div class="uk-visible@m">
        @include('partials.nav')
      </div>
      <div class="uk-hidden@m">
        @include('partials.mobile_nav')
        <div id="offcanvas-overlay-slide" uk-offcanvas="overlay: true">
          <navigation-mobile
                  api="{{ route('menu')}}"
                  men_link="{{ route('men') }}"
                  women_link="{{ route('women') }}"
                  kid_link="{{ route('kids') }}"
          ></navigation-mobile>
        </div>
      </div>

      @yield('content')
      @include('partials.footer')
    </div>
    <script src="{{ elixir('js/vendor.js') }}"></script>
    <script src="{{ elixir('js/custom.js') }}"></script>
    <script src="{{ elixir('js/main.js') }}"></script>
    <script src="{{ elixir('js/app.js') }}"></script>
    @section('upload_scripts')
    @show
    @section('footer_scripts')
    @show
  </body>
</html>
