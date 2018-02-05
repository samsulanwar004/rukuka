<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta id="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- jQuery is required -->
    <link rel="stylesheet" href="{{ elixirCDN('css/app.css') }}">
    <script src="{{ elixirCDN('js/vendor.js') }}"></script>
    <script src="{{ elixirCDN('js/custom.js') }}"></script>
    <style type="text/css">
         .credit-card-box .panel-title {
                display: inline;
                font-weight: bold;
            }
            .credit-card-box .form-control.error {
                border-color: red;
                outline: 0;
                box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
            }
            .credit-card-box label.error {
              font-weight: bold;
              color: red;
              padding: 2px 8px;
              margin-top: 2px;
            }
            .credit-card-box .payment-errors {
              font-weight: bold;
              color: red;
              padding: 2px 8px;
              margin-top: 2px;
            }
            .credit-card-box label {
                display: block;
            }
            .submit-button {
              background-color: #1ace9b;
              color: #ffffff;
            }

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


            #loading {
                position: fixed;
                display: none;
                width: 100%;
                height: 100%;
                top: 60px;
                left: 0;
                right: 0;
                bottom: 0;
            }

            #three-ds-container{
              
                position: absolute;
                top: 60%;
                left: 50%;
                font-size: 50px;
                color: white;
                transform: translate(-50%,-50%);
                -ms-transform: translate(-50%,-50%);
                background-color: #ffffff;
                border-radius: 5px;
                z-index: 11;
            }

          

            #payment {
                width: 550px;
                height: 400px;
                line-height: 200px;
                position: fixed;
                top: 25%;
                left: 40%;
                margin-top: -100px;
                margin-left: -150px;
                background-color: #ffffff;
                border-radius: 5px;
                text-align: center;
                z-index: 11; /* 1px higher than the overlay layer */
            }

            pre {
                white-space: pre-wrap;
            }

            div.request {
                width: 50%;
                float: left;
            }

            pre.result {
                width: 49%;
            }

            .credit-card-div  span {
                padding-top:10px;
            }
            .credit-card-div img {
                padding-top:30px;
            }
            .credit-card-div .small-font {
                font-size:9px;
            }
            .credit-card-div .pad-adjust {
                padding-top:10px;
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
