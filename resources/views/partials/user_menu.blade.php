<progress id="progressbar" class="uk-progress" value="0" max="100" hidden></progress>
<div class="uk-width-1-4@m">
  <div class="uk-card uk-card-default uk-card-small uk-box-shadow-small">
      <div class="uk-card-media-top uk-inline">
          <div class="uk-position-top-right">
            <div class="profile-upload" uk-form-custom>
              <input type="file">
              <a class="uk-icon-button uk-icon" href="#" uk-icon="icon: pencil"></a>
            </div>
          </div>
          @if($user->avatar)
            <img src="{{ $user->avatar }}" alt="">
          @else
            @if($user->gender == 'm')
              <img src="/images/men_profile.jpg" alt="">
            @else
              <img src="/images/women_profile.jpg" alt="">
            @endif
          @endif
          
      </div>      
      <div class="uk-card-body">
          <h3 class="uk-card-title uk-margin-small">{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</h3>
          <hr>
          <p class="uk-margin-small"><strong>My Account</strong></p>
          <ul class="uk-list">
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

@section('footer_scripts')
<script>

    (function ($) {

        var bar = $("#progressbar")[0];

        UIkit.upload('.profile-upload', {

            url: '{{ route('user.upload.profile') }}',
            multiple: true,

            beforeSend: function() { console.log('beforeSend', arguments); },
            beforeAll: function() { console.log('beforeAll', arguments); },
            load: function() { console.log('load', arguments); },
            error: function() { console.log('error', arguments); },
            complete: function() { console.log('complete', arguments); },

            loadStart: function (e) {
                console.log('loadStart', arguments);

                bar.removeAttribute('hidden');
                bar.max =  e.total;
                bar.value =  e.loaded;
            },

            progress: function (e) {
                console.log('progress', arguments);

                bar.max =  e.total;
                bar.value =  e.loaded;

            },

            loadEnd: function (e) {
                console.log('loadEnd', arguments);

                bar.max =  e.total;
                bar.value =  e.loaded;
            },

            completeAll: function () {
                console.log('completeAll', arguments);

                setTimeout(function () {
                    bar.setAttribute('hidden', 'hidden');
                }, 1000);
            }
        });

    })(jQuery);

</script>
@endsection