<div class="uk-section-xsmall uk-box-shadow-medium uk-background-default uk-margin-remove uk-padding-remove">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-smal uk-padding-remove-vertical">
        <div class="uk-container uk-container-small">
          <div class="uk-grid-small" uk-grid>
              <div class="uk-width-1-3 uk-flex uk-flex-middle">
                <div class="uk-panel uk-visible@m">
                  <a href="{{ route('bag') }}" class="uk-button uk-button-small uk-button-default-warm">BACK TO SHOPPING BAG</a>
                </div>
                <div class="uk-panel uk-hidden@m">
                  <a href="{{ route('bag') }}" class="uk-button uk-button-small uk-button-default-warm"><span class="uk-icon" uk-icon="icon: chevron-left"></span>BAG</a>
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
    {{-- <div class="uk-section uk-section-xsmall uk-section-muted uk-padding-small-top uk-hidden@m"  uk-sticky="bottom: #hash; animation: uk-animation-slide-top;">
      <div class="uk-container uk-container-small">
        <ul class="uk-grid-small uk-child-width-1-4 uk-flex-between uk-flex-middle" uk-grid >
          <li class="uk-text-center">
            <a href="#"> <h6 class="uk-margin-remove"><span class="uk-icon" uk-icon="icon: chevron-left; ratio:0.5"></span> back</h6></a>
          </li>
          <li class="uk-text-center">
            <a href="#"><h6 class="uk-margin-remove">shipping address</h6></a>
          </li>
          <li class="uk-text-center">
            <a href="#"><h6 class="uk-margin-remove">shipping option</h6></a>
          </li>
          <li class="uk-text-center">
            <a href="#"><h6 class="uk-margin-remove"ß>review</h6></a>
          </li>
        </ul>
      </div>

    </div> --}}

  </div>
