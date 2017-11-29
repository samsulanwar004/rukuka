<progress id="progressbar" class="uk-progress" value="0" max="100" hidden></progress>
<div class="uk-width-1-4@m">
  <div class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-small uk-visible@m">
      <div class="uk-card-header">
          <h3 class="uk-margin-small"><b>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</b></h3>
      </div>
      <div class="uk-card-body">
        <strong>MY ACCOUNT</strong>
        <ul class="uk-nav uk-navbar-dropdown-nav">
          <li><a href="{{ route('user') }}" class="uk-text-small">Home</a></li>
          <li><a href="{{ route('user.detail') }}" class="uk-text-small">My Details</a></li>
          <li><a href="{{ route('user.address') }}" class="uk-text-small">Address Books</a></li>
          <li><a href="{{ route('user.cc') }}" class="uk-text-small">Payment Methods</a></li>
          <li><a href="#" class="uk-text-small">Order History</a></li>
          <li><a href="{{ route('user.wishlist') }}" class="uk-text-small">My Wishlist</a></li>
          <li><a href="{{ route('user.reset.password') }}" class="uk-text-small">Reset Password</a></li>
          <li><a href="{{ route('logout') }}" class="uk-text-small">Sign Out</a></li>
        </ul>
      </div>
  </div>
  <div class="uk-grid uk-hidden@m" uk-grid>
    <div class="uk-width-4-5">
      <h4>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</h4>
    </div>
    <div class="uk-width-1-5">
      <div class="uk-inline">
        <a href="#" class="uk-icon uk-icon-link" uk-icon="icon: more"></a>
        <div class="uk-dropdown uk-dropdown-bottom-right" uk-dropdown="mode: click">
          <ul class="uk-nav uk-navbar-dropdown-nav">
            <li><a href="{{ route('user') }}" class="uk-text-small">Home</a></li>
            <li><a href="{{ route('user.detail') }}" class="uk-text-small">My Details</a></li>
            <li><a href="{{ route('user.address') }}" class="uk-text-small">Address Books</a></li>
            <li><a href="{{ route('user.cc') }}" class="uk-text-small">Payment Methods</a></li>
            <li><a href="#" class="uk-text-small">Order History</a></li>
            <li><a href="{{ route('user.wishlist') }}" class="uk-text-small">My Wishlist</a></li>
            <li><a href="{{ route('user.reset.password') }}" class="uk-text-small">Reset Password</a></li>
            <li><a href="{{ route('logout') }}" class="uk-text-small">Sign Out</a></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>

@section('upload_scripts')
<script>

    (function ($) {

        var bar = $("#progressbar")[0];

        UIkit.upload('.profile-upload', {

            url: '{{ route('user.upload.profile') }}',
            multiple: true,
            params: {
              _token : getTokenValue(),
            },

            loadStart: function (e) {

                bar.removeAttribute('hidden');
                bar.max =  e.total;
                bar.value =  e.loaded;
            },

            progress: function (e) {

                bar.max =  e.total;
                bar.value =  e.loaded;

            },

            loadEnd: function (e) {
                try {
                  var response = JSON.parse(e.currentTarget.response);
                  var msg = response['files.0'];
                  if (typeof msg !== 'undefined') {
                    UIkit.notification(msg.toString().replace(".0", ""), {
                      status:'danger'
                    });
                  }
                  // this is how you parse a string into JSON
                  $("#photo-profile").attr("src",response.data);
                } catch (ex) {
                  console.error(ex);
                }

                bar.max =  e.total;
                bar.value =  e.loaded;
            },

            completeAll: function () {
                setTimeout(function () {
                    bar.setAttribute('hidden', 'hidden');
                }, 1000);
            }
        });

    })(jQuery);

</script>
@endsection
