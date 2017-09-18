<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- jQuery is required -->

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    
    
  </head>
  <body>

  @include('partials.nav')
    <div class="uk-container uk-container-small" id="content">
       @yield('content')
    </div>
  @include('partials.footer')
  <script src="{{ elixir('js/vendor.js') }}"></script>
  <script src="{{ elixir('js/main.js') }}"></script>
  <script src="{{ elixir('js/app.js') }}"></script>

  @section('footer_scripts')
  @show
  </body>
</html>
