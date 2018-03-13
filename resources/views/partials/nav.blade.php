<div class="uk-section-xsmall uk-background-default uk-margin-remove uk-padding-remove" style="border-color: #333; border-width: 5px" uk-sticky="bottom: #hash; animation: uk-animation-slide-top;">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-remove-vertical">
        <div class="uk-container">
          <div class="uk-grid-small" uk-grid>
              <div class="uk-width-1-3@m uk-flex uk-flex-middle">
                <div class="uk-panel">
                    {{ Form::open(array('url' => '/search', 'method' =>'get','files' => true,'class' => 'uk-search uk-form-width-medium uk-first-column')) }}
                    <button type="submit" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon></button>
                    <input type="text" class=" uk-search-input" name="keyword" required placeholder="{{ trans('app.search') }}">
                    {{ Form::close() }}
                </div>
              </div>
              <div class="uk-width-1-3@m">
                <div class="uk-panel uk-text-center">
                      <a href="/" class="uk-link-reset">
                        <div class="uk-inline">
                          <img src="{{ imageCDN(config('common.logo')) }}" alt="rukuka" width="90">
                          <div class="uk-overlay uk-position-top">
                            <p style="margin-top: -20px;margin-left: 45px;font-size: 12px;">BETA</p>
                          </div>
                        </div>
                      </a>
                </div>
              </div>
              <user-panel
                profile_link="{{ route('user') }}"
                history_link="{{ route('user.history') }}"
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
                logout_link="{{ route('logout') }}"
                aws_link="{{ config('filesystems.s3url') }}"
                default_image="{{ json_encode(config('common.default')) }}"
                locale="{{ json_encode(trans('app')) }}"
                exchange_api="{{ route('exchange') }}"
              ></user-panel>
          </div>

        </div>
    </div>
    <navigation
      api="{{ route('menu')}}"
      men_link="{{ route('men') }}"
      women_link="{{ route('women') }}"
      kid_link="{{ route('kids') }}"
      designer_link="{{ route('designer') }}"
      aws_link="{{ config('filesystems.s3url') }}"
      default_image="{{ json_encode(config('common.default')) }}"
      locale="{{ json_encode(trans('app')) }}"
    ></navigation>
  </div>
  <div class="uk-section uk-section-xsmall uk-padding-remove">
    <div class="uk-container">
      <div class="uk-alert-alert" uk-alert>
          <a href="#" class="uk-alert-close" uk-close></a>
          <p class="uk-text-center">
              {{ trans('app.header_note') }} <a href="https://rukuka.com/lookbook/amazon-fashion-week"> <b> <u>{{ trans('app.afw') }}</u> </b> </a></b>
          </p>
      </div>
    </div>
  </div>
