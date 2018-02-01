<div class="uk-section uk-section-muted uk-section-xsmall uk-visible@m">
  <div class="uk-container uk-container-small">
    <div class="uk-panel uk-grid" uk-grid>
      <div class="uk-width-1-5@m">
        <ul class="uk-nav uk-footer-nav">
          <li class="uk-text-uppercase"><b>{{ trans('app.helpyou') }}</b></li>
          <li><a href="{{ URL::to('help/order-status') }}">{{ trans('app.order_status') }}</a></li>
          <li><a href="{{ URL::to('help/shipping-handling') }}">{{ trans('app.shipping_handling') }}</a></li>
          <li><a href="{{ URL::to('help/returns-exchanges') }}">{{ trans('app.returns_exchanges') }}</a></li>
          <li><a href="{{ URL::to('help/international-orders') }}">{{ trans('app.international_orders') }}</a></li>
          <li><a href="{{ URL::to('help/need-some-help') }}">{{ trans('app.need_some_help') }}</a></li>
          <li><a href="{{ URL::to('help/our-services') }}">{{ trans('app.our_services') }}</a></li>
          <li><a href="{{ URL::to('help/size-charts') }}">{{ trans('app.size_chart') }}</a></li>
        </ul>

      </div>
      <div class="uk-width-1-5@m">
        <ul class="uk-nav uk-footer-nav">
          <li class="uk-text-uppercase"><b>{{ trans('app.about_rukuka') }}</b></li>
          <li><a href="{{ URL::to('page/about-rukuka')}}">{{ trans('app.about_rukuka') }}</a></li>
          <li><a href="{{ URL::to('page/partners')}}">{{ trans('app.partners') }}</a></li>
          <li><a href="{{ URL::to('page/careers')}}">{{ trans('app.careers') }}</a></li>
          <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
          <li><a href="{{ URL::to('page/payment')}}">{{ trans('app.payment') }}</a></li>
          <li><a href="{{ URL::to('help/contact-us')}}">{{ trans('app.contact_us') }}</a></li>
        </ul>

      </div>
      <div class="uk-width-1-5@m">
          <popular-search
          popular_search="{{ route('popular-search') }}"
          locale="{{ json_encode(trans('app')) }}"
          ></popular-search>
      </div>
      <div class="uk-width-2-5@m">
        <subcriber
        api="{{ route('subcriber') }}"
        locale="{{ json_encode(trans('app')) }}"
        ></subcriber>
        <p class="uk-margin-medium">
          <ul class="uk-nav uk-footer-nav">
            <li class="uk-text-uppercase">{{ trans('app.connect_us') }}</li>
          </ul>
        <ul class="uk-grid-small" uk-grid>
          <li><a class="uk-icon-link" uk-icon="icon: twitter"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: pinterest"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: facebook"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: google-plus"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: instagram"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: tumblr"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: mail"></a></li>
        </ul>
      </p>
        <li class="uk-nav uk-footer-nav">
            <a class="uk-button uk-button-text uk-button-small" href="#">{{ Config::get('languages')[App::getLocale()] }}</a>
            <div class="uk-drop uk-drop-bottom-left" uk-drop="delay-hide:0; mode: click" style="width: 150px">
              <div class="uk-card uk-card-border uk-background-default uk-card-small">
                <div class="uk-card-body">
                  <ul class="uk-list uk-text-meta">
                    @foreach (Config::get('languages') as $lang => $language)
                      @if ($lang != App::getLocale())
                        <li>
                          <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
        </li>
      </div>
    </div>
    <p>
    <span class="uk-text-meta uk-margin-top">Copyright © 2017 rukuka.com - All Rights Reseved.</span>
    </p>
  </div>
</div>
<div class="uk-section uk-section-muted uk-section-xsmall uk-text-small uk-hidden@m">
  <div class="uk-container uk-container-small uk-text-meta">
    <ul class="uk-grid" uk-grid>
      <li><a href="{{ URL::to('help/need-some-help')}}">{{ trans('app.need_some_help') }}</a></li>
      <li><a href="{{ URL::to('page/about-rukuka')}}">{{ trans('app.about_rukuka') }}</a></li>
      <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
    </ul>
    <p>Copyright © 2017 rukuka.com - All Rights Reseved.</p>
  </div>
</div>