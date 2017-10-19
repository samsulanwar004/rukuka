<div class="uk-section-xsmall uk-box-shadow-medium uk-margin-remove uk-padding-remove" uk-sticky="bottom: #hash; animation: uk-animation-slide-top;" id="menu">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-small">
        <div class="uk-container uk-container-small">
          <div class="uk-grid-small uk-grid-divider" uk-grid>
              <div class="uk-width-1-5@m">
                <div class="uk-panel">
                  <form class="uk-search uk-search-default">
                      <span class="uk-search-icon-flip" uk-search-icon></span>
                      <input class="uk-search-input" type="search" placeholder="Search">
                  </form>
                </div>
              </div>
              <div class="uk-width-3-5@m">
                <div class="uk-panel uk-text-center">
                  <h2><b>KUKA</b> INDONESIA</h2>
                </div>
              </div>
              <user-panel 
                profile_link="{{ route('user') }}"
                wishlist_link="{{ route('user.wishlist') }}"
                bag_link="{{ route('bag') }}"
                bag_count="{{ Cart::instance('shopping')->content()->count() }}"
                bag="{{ Cart::instance('shopping')->content() }}"
                login_link="{{ route('login') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                wishlist_api="{{ route('wishlist', ['api_token' => Auth::user('web')->api_token]) }}"
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
