<div class="uk-section-xsmall uk-box-shadow-medium uk-background-default uk-margin-remove uk-padding-remove">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-smal uk-padding-remove-vertical">
        <div class="uk-container uk-container-small">
          <div class="uk-grid-small" uk-grid>
              <div class="uk-width-1-3 uk-flex uk-flex-middle">
                <div class="uk-panel uk-visible@m">
                  <a href="{{ route('bag') }}" class="uk-button uk-button-small uk-button-default-warm uk-text-uppercase">{{ trans('app.back_to_shopping_bag') }}</a>
                </div>
                <div class="uk-panel uk-hidden@m">
                  <a href="{{ route('bag') }}" class="uk-button uk-button-small uk-button-default-warm uk-text-uppercase"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.bag_label') }}</a>
                </div>
              </div>
              <div class="uk-width-1-3">
                <div class="uk-panel uk-text-center">
                  <a href="/" class="uk-link-reset"><img src="{{ imageCDN(config('common.logo')) }}" alt="rukuka" width="80"></a>
                </div>
              </div>
          </div>
        </div>
    </div>
  </div>
