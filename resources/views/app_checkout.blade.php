<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title> @yield('title') </title>

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">

            .overlay {
                position: fixed;
                display: none;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5);
                z-index: 2;
            }

            .modal-body{
                position: absolute;
                top: 60%;
                left: 50%;
                font-size: 50px;
                color: white;
                transform: translate(-50%,-50%);
                -ms-transform: translate(-50%,-50%);
                -webkit-transform: translate(-50%,-50%);
                background-color: #ffffff;
                border-radius: 5px;
                z-index: 1;
                margin-top: 50%;
            }
    </style>

  </head>
  <body>
    <div id="app">
      <!-- Preloader -->
      <div id="preloader" class="uk-inline">
        <div class="uk-position-center" uk-spinner="ratio: 4"></div>
      </div>
      @include('partials.header_checkout')
      @yield('content')
      @include('partials.footer')
    </div>
    <script src="{{ elixirCDN('js/main.js') }}"></script>
    <script src="{{ elixirCDN('js/app.js') }}"></script>
    @section('footer_scripts')
    @show
  </body>
</html>
