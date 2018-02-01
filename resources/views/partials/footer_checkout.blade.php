<div class="uk-section uk-section-muted uk-section-xsmall">
        <div class="uk-container uk-container-small">
          <div class="uk-panel uk-grid" uk-grid>
            <div class="uk-width-1-5@m">
              <ul class="uk-nav uk-navbar-dropdown-nav">
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
              <ul class="uk-nav uk-navbar-dropdown-nav">
                <li class="uk-text-uppercase"><b>{{ trans('app.about_rukuka') }}</b></li>
                <li><a href="{{ URL::to('page/about-rukuka')}}">{{ trans('app.about_rukuka') }}</a></li>
                <li><a href="{{ URL::to('page/partners')}}">{{ trans('app.partners') }}</a></li>
                <li><a href="{{ URL::to('page/careers')}}">{{ trans('app.careers') }}</a></li>
                <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
                <li><a href="{{ URL::to('page/payment')}}">{{ trans('app.payment') }}</a></li>
                <li><a href="{{ URL::to('help/contact-us')}}">{{ trans('app.contact_us') }}</a></li>
              </ul>
            </div>

            <div class="uk-width-3-5@m uk-text-right">

            </div>
          </div>
          <div class="uk-panel uk-grid" uk-grid>
            <div class="uk-width-3-5@m">
              <p>
                <ul class="uk-grid uk-text-meta" uk-grid>
                <li><a href="{{ URL::to('help/need-some-help')}}">{{ trans('app.need_some_help') }}</a></li>
                <li><a href="{{ URL::to('page/about-rukuka')}}">{{ trans('app.about_rukuka') }}</a></li>
                <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
                </ul>
              </p>
            </div>
          </div>
        </div>
    </div>
    <div class="uk-section uk-section-default uk-section-xsmall uk-text-small">
        <div class="uk-container uk-container-small uk-text-meta">
          Copyright © 2017 kukaindonesia.com - All Rights Reseved.
        </div>
    </div>
