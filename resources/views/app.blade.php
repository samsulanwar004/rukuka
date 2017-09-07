<!DOCTYPE html>
<html lang="en-gb">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KUKA INDONESIA</title>
    <!-- jQuery is required -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/vendor/uikit/css/uikit.min.css">
    <script src="/vendor/uikit/js/uikit-core.min.js" charset="utf-8"></script>
    <script src="/vendor/uikit/js/uikit-icons.min.js" charset="utf-8"></script>
    <script src="/vendor/uikit/js/uikit.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.20/vue.min.js"></script>
  </head>
  <body>

  @include('partials.nav')
    <div class="uk-container uk-container-small">
       @yield('content')
    </div>
  @include('partials.footer')

  <script type="text/javascript">
    // create a root instance
    new Vue({
      el: '#menu',
        data: {
          mens: [],
          womens: [],
          designers: []
      },

      ready: function() {
        this.fetchMessages();
      },

      methods: {
          fetchMessages: function() {
              var self = this;
              $.get('/menu/men', function(mens) {
                  self.mens = mens
              });
              $.get('/menu/women', function(womens) {
                  self.womens = womens
              });
              $.get('/menu/designers', function(designers) {
                  self.designers = designers
              });
          }
      }
    })
  </script>
  </body>
</html>
