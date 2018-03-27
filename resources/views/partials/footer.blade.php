<div class="uk-section uk-section-muted uk-section-xsmall uk-visible@m">
  <div class="uk-container">
    <div class="uk-panel uk-grid" uk-grid>
      <div class="uk-width-1-6@m">
        <ul class="uk-nav uk-footer-nav">
          <li class="uk-text-uppercase"><b>{{ trans('app.help_care') }}</b></li>
          <li><a href="{{ URL::to('help/contact-us')}}">{{ trans('app.contact_us') }}</a></li>
          <li><a href="{{ URL::to('help/returns-exchanges') }}">{{ trans('app.returns_exchanges') }}</a></li>
          <li><a href="{{ URL::to('help/size-charts') }}">{{ trans('app.size_chart') }}</a></li>
          <li><a href="{{ URL::to('help/payment')}}">{{ trans('app.payment') }}</a></li>
        </ul>
      </div>
      <div class="uk-width-1-6@m">
        <ul class="uk-nav uk-footer-nav">
          <li class="uk-text-uppercase"><b>{{ trans('app.order_shipping') }}</b></li>
          <li><a href="{{ route('tracking-page')}}"> {{trans('app.track_order') }}</a> </li>
          <li><a href="{{ URL::to('help/shipping-handling')}}">{{ trans('app.shipping_handling') }}</a></li>
        </ul>
      </div>
      <div class="uk-width-1-6@m">
        <ul class="uk-nav uk-footer-nav">
          <li class="uk-text-uppercase"><b>{{ trans('app.about_rukuka') }}</b></li>
          <li><a href="{{ URL::to('page/about-us')}}">{{ trans('app.about_us') }}</a></li>
          <li><a href="{{ URL::to('page/partners')}}">{{ trans('app.partners') }}</a></li>
          <li><a href="{{ URL::to('page/careers')}}">{{ trans('app.careers') }}</a></li>
          <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
        </ul>
      </div>
      <div class="uk-width-1-6@m">
          <popular-search
          popular_search="{{ route('popular-search') }}"
          locale="{{ json_encode(trans('app')) }}"
          ></popular-search>
      </div>
      <div class="uk-width-expand@m">
        <subcriber
                api="{{ route('subcriber') }}"
                locale="{{ json_encode(trans('app')) }}"
        ></subcriber>
        <p class="uk-margin-small">
          <ul class="uk-nav uk-footer-nav">
            <li class="uk-text-uppercase">{{ trans('app.connect_us') }}</li>
          </ul>
        <ul class="uk-grid-small" uk-grid>
          <li><a href="{{ trans('app.facebook') }}" target="_blank"   class="uk-icon-link" uk-icon="icon: facebook"></a></li>
          <li><a href="{{ trans('app.instagram') }}" target="_blank" class="uk-icon-link" uk-icon="icon: instagram"></a></li>
          <li><a href="{{ trans('app.email_to') }}" class="uk-icon-link" uk-icon="icon: mail"></a></li>
        </ul>
        </p>
        {{--<ul class="uk-nav uk-footer-nav">--}}
          {{--<li class="uk-text-uppercase">{{ trans('app.language') }}</li>--}}
        {{--</ul>--}}
        {{--<div class="uk-nav uk-footer-nav">--}}
          {{--@foreach (Config::get('languages') as $lang => $language)--}}
            {{--@if ($lang == App::getLocale())--}}
              {{--<u> <a class="uk-text-small" href="{{ route('lang.switch', $lang) }}">{{$language}}</a> </u>--}}
            {{--@endif--}}
              {{--@if ($lang != App::getLocale())--}}
                {{--<a class="uk-text-small" href="{{ route('lang.switch', $lang) }}"> {{$language}} </a>--}}
              {{--@endif--}}
              {{--{{ $loop->last ? '' : '| ' }}--}}
          {{--@endforeach--}}
        {{--</div>--}}
      </div>
    </div>
    <p>
    <span class="uk-text-meta uk-margin-top">{{ trans('app.copyright') }}</span>
    </p>
  </div>
</div>
<div class="uk-section uk-section-muted uk-section-xsmall uk-text-small uk-hidden@m">
  <div class="uk-container uk-container-small uk-text-meta">
    <subcriber
            api="{{ route('subcriber') }}"
            locale="{{ json_encode(trans('app')) }}"
    ></subcriber>
    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
      <li class="uk-parent">
          <a href="#" class="uk-text-uppercase"><b>{{ trans('app.help_care') }}</b></a>
          <ul class="uk-nav-sub">
            <li><a href="{{ URL::to('help/contact-us')}}">{{ trans('app.contact_us') }}</a></li>
            <li><a href="{{ URL::to('help/returns-exchanges') }}">{{ trans('app.returns_exchanges') }}</a></li>
            <li><a href="{{ URL::to('help/size-charts') }}">{{ trans('app.size_chart') }}</a></li>
            <li><a href="{{ URL::to('help/payment')}}">{{ trans('app.payment') }}</a></li>

          </ul>
      </li>
      <li class="uk-parent">
          <a href="#" class="uk-text-uppercase"><b>{{ trans('app.order_shipping') }}</b></a>
          <ul class="uk-nav-sub">
            <li><a href="{{ route('tracking-page')}}"> {{trans('app.track_order') }}</a> </li>
            <li><a href="{{ URL::to('help/shipping-handling')}}">{{ trans('app.shipping_handling') }}</a></li>
          </ul>
      </li>
      <li class="uk-parent">
          <a href="#" class="uk-text-uppercase"><b>{{ trans('app.about_rukuka') }}</b></a>
          <ul class="uk-nav-sub">
            <li><a href="{{ URL::to('page/about-us')}}">{{ trans('app.about_us') }}</a></li>
            <li><a href="{{ URL::to('page/partners')}}">{{ trans('app.partners') }}</a></li>
            <li><a href="{{ URL::to('page/careers')}}">{{ trans('app.careers') }}</a></li>
            <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
          </ul>
      </li>
  </ul>
  <hr class="uk-margin-small">
  <ul class="uk-grid-xsmall" uk-grid>
    <li class="uk-text-uppercase">{{ trans('app.connect_us') }}</li>
    <li><a href="{{ trans('app.facebook') }}" target="_blank"   class="uk-icon-link" uk-icon="icon: facebook"></a></li>
    <li><a href="{{ trans('app.instagram') }}" target="_blank" class="uk-icon-link" uk-icon="icon: instagram"></a></li>
    <li><a href="{{ trans('app.email_to') }}" class="uk-icon-link" uk-icon="icon: mail"></a></li>
  </ul>
    <hr class="uk-margin-small">
    <ul class="uk-grid uk-grid-small uk-flex uk-flex-top uk-flex-between" uk-grid>
      <li>{{ trans('app.copyright') }}</li>
      <li>
        {{--@foreach (Config::get('languages') as $lang => $language)--}}
          {{--@if ($lang == App::getLocale())--}}
            {{--<u> <a class="uk-text-small" href="{{ route('lang.switch', $lang) }}">{{$language}}</a> </u>--}}
          {{--@endif--}}
          {{--@if ($lang != App::getLocale())--}}
            {{--<a class="uk-text-small" href="{{ route('lang.switch', $lang) }}"> {{$language}} </a>--}}
          {{--@endif--}}
          {{--{{ $loop->last ? '' : '| ' }}--}}
        {{--@endforeach--}}
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang == App::getLocale())
                @php
                  $currency_code = $language
                @endphp
            @endif
        @endforeach
        <a class="uk-button uk-button-text uk-button-small" href="#flag-modal" uk-toggle><img src="{{ imageCDN('flag1x1/'.App::getLocale().'.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt="">
        {{ $currency_code }}
        </a>
      </li>
    </ul>
  </div>
</div>
