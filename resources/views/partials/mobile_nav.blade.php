<div class="uk-section uk-section-xsmall uk-padding-remove uk-margin-reove">
  <div class="uk-section uk-section-default uk-section-xsmall uk-padding-remove-vertical">
    <div class="uk-container uk-container-small">
      <div class="uk-panel uk-text-center">
        <a href="/" class="uk-link-reset"><img src="/images/logo-kukaindonesia.jpg" alt="" width="90"></a>
      </div>
    </div>
  </div>
  <hr class="uk-margin-remove uk-padding-remove">
  <div  uk-sticky="bottom: #hash; animation: uk-animation-slide-top;">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-small uk-box-shadow-medium">
      <div class="uk-container uk-container-small">
        <div class="uk-grid-small" uk-grid>
          <div class="uk-width-1-4@m">
            {{-- <div class="uk-penel">
              <ul class="uk-grid-small uk-flex-between" uk-grid>
                <li><a class="uk-icon-link" uk-icon="icon: more" href="#offcanvas-overlay-slide" uk-toggle></a></li>
                <li><a class="uk-icon-link" uk-icon="icon: search" uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a></li>
                <li><a class="uk-icon-link" uk-icon="icon: cart"></a><span class="uk-badge">3</span></li>
                <li><a class="uk-icon-link" uk-icon="icon: user"></a><span class="uk-badge">2</span></li>
              </ul>
            </div> --}}
            <user-panel
              profile_link="{{ route('user') }}"
              wishlist_link="{{ route('user.wishlist') }}"
              bag_link="{{ route('bag') }}"
              login_link="{{ route('login') }}"
              auth="{{ Auth::check() ? 1 : 0 }}"
              account="{{ Auth::user('web') }}"
              wishlist_api="{{ route('wishlist') }}"
              bag_api="{{ route('persist.bag') }}"
              product_link="{{ route('product') }}"
              checkout_link="{{ route('checkout') }}"
              api_token="{{ Auth::user('web')->api_token }}"
            ></user-panel>
            <div class="uk-navbar-left uk-flex-1 test-overlay" hidden>
              <div class="uk-navbar-item uk-width-expand">
                <form class="uk-search uk-search-navbar uk-width-1-1">
                    <input class="uk-search-input" type="search" placeholder="find our product" autofocus>
                </form>
              </div>
              <a class="uk-navbar-toggle" uk-close uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
