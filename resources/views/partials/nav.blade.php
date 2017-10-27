<div class="uk-section-xsmall uk-box-shadow-medium uk-margin-remove uk-padding-remove" uk-sticky="bottom: #hash; animation: uk-animation-slide-top;" id="vue-menu">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-small">
        <div class="uk-container uk-container-small">
          <div class="uk-grid-small" uk-grid>
              <div class="uk-width-1-3@m uk-flex uk-flex-middle">
                <div class="uk-panel">
                  <form class="uk-search uk-form-width-medium uk-first-column" action="index.html" method="post">
                    <button type="button" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon name="button"></button>
                    <input type="search" class=" uk-search-input" name="" value="" placeholder="S E A R C H">
                  </form>
                </div>
              </div>
              <div class="uk-width-1-3@m">
                <div class="uk-panel uk-text-center">
                  <a href="/" class="uk-link-reset"><img src="/images/logo-kukaindonesia.png" alt=""></a>
                </div>
              </div>
              <user-panel
                profile_link="{{ route('user') }}"
                wishlist_link="{{ route('user.wishlist') }}"
                bag_link="{{ route('bag') }}"
                login_link="{{ route('login') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                account="{{ Auth::user('web') }}"  
                wishlist_api="{{ route('wishlist', ['api_token' => Auth::user('web')->api_token]) }}"
                product_link="{{ route('product') }}"
              ></user-panel>
          </div>

        </div>
    </div>
    <navigation
      api="{{ route('menu')}}"
      men_link="{{ route('men') }}"
      women_link="{{ route('women') }}"
      kid_link="{{ route('kids') }}"
    ></navigation>

  </div>
