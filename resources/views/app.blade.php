<!DOCTYPE html>
<html lang="en-gb">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KUKA INDONESIA</title>
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
  </body>
</html>
