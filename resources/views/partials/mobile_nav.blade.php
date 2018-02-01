<div class="uk-section uk-section-xsmall uk-padding-remove uk-margin-reove">
  <div class="uk-section uk-section-default uk-section-xsmall uk-padding-remove-vertical">
    <div class="uk-container uk-container-small">
      <div class="uk-panel uk-text-center">
        <a href="/" class="uk-link-reset"><img src="{{ imageCDN(config('common.logo')) }}" alt="rukuka" width="90"></a>
      </div>
    </div>
  </div>
  <hr class="uk-margin-remove uk-padding-remove">
  <div  uk-sticky="bottom: #hash; animation: uk-animation-slide-top;">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-small uk-box-shadow-medium">
      <div class="uk-container uk-container-small">
        <div class="uk-grid-small" uk-grid>
          <div class="uk-width-1-4@m">
            <user-panel-mobile
              profile_link="{{ route('user') }}"
              bag_link="{{ route('bag') }}"
              login_link="{{ route('login') }}"
              auth="{{ Auth::check() ? 1 : 0 }}"
            ></user-panel-mobile>
            <div id="offcanvas-overlay-slide" uk-offcanvas="overlay: true">
              <navigation-mobile
                      men_link="{{ route('men') }}"
                      women_link="{{ route('women') }}"
                      kid_link="{{ route('kids') }}"
                      designer_link="{{ route('designer') }}"
                      locale="{{ json_encode(trans('app')) }}"
              ></navigation-mobile>
            </div>
            <div class="uk-navbar-left uk-flex-1 test-overlay" hidden>
              <div class="uk-navbar-item uk-width-expand">
                {{ Form::open(array('url' => '/search', 'method' =>'get','files' => true,'class' => 'uk-search uk-search-navbar uk-width-1-1')) }}
                <input class="uk-search-input" name="keyword" type="search" placeholder="find our product" autofocus>
                {{ Form::close() }}
              </div>
              <a class="uk-navbar-toggle" uk-close uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
