<div class="uk-section uk-section-muted uk-section-xsmall uk-visible@m">
  <div class="uk-container">
    <div class="uk-panel uk-grid" uk-grid>
      <div class="uk-width-1-6@m">
        <ul class="uk-nav uk-footer-nav">
          <li class="uk-text-uppercase"><b>{{ trans('app.helpyou') }}</b></li>
          <li><a href="{{ URL::to('help/order-status') }}">{{ trans('app.order_status') }}</a></li>
          <li><a href="{{ URL::to('help/shipping') }}">{{ trans('app.shipping') }}</a></li>
          <li><a href="{{ URL::to('help/international-orders') }}">{{ trans('app.international_orders') }}</a></li>
          <li><a href="{{ URL::to('help/need-some-help') }}">{{ trans('app.need_some_help') }}</a></li>
          <li><a href="{{ URL::to('help/our-services') }}">{{ trans('app.our_services') }}</a></li>
          <li><a href="{{ URL::to('help/size-charts') }}">{{ trans('app.size_chart') }}</a></li>
        </ul>
      </div>
      <div class="uk-width-1-6@m">
        <ul class="uk-nav uk-footer-nav">
          <li class="uk-text-uppercase"><b>{{ trans('app.order_shipping') }}</b></li>
          <li><a href="{{ route('tracking-page')}}"> {{trans('app.track_order') }}</a> </li>
        </ul>
      </div>
      <div class="uk-width-1-6@m">
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
      <div class="uk-width-1-6@m">
          <popular-search
          api="{{ route('menu')}}"
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
        <ul class="uk-nav uk-footer-nav">
          <li class="uk-text-uppercase">{{ trans('app.language') }}</li>
        </ul>
        <div class="uk-nav uk-footer-nav">
          @foreach (Config::get('languages') as $lang => $language)
            @if ($lang == App::getLocale())
              <u> <a class="uk-text-small" href="{{ route('lang.switch', $lang) }}">{{$language}}</a> </u>
            @endif
              @if ($lang != App::getLocale())
                <a class="uk-text-small" href="{{ route('lang.switch', $lang) }}"> {{$language}} </a>
              @endif
              {{ $loop->last ? '' : '| ' }}
          @endforeach
        </div>
        {{--<div class="uk-nav uk-footer-nav">--}}
            {{--<div class="uk-button uk-button-text uk-button-small" >{{ Config::get('languages')[App::getLocale()] }}</div>--}}
            {{--<div class="uk-drop uk-drop-bottom-left" uk-drop="delay-hide:0;" style="width: 150px">--}}
              {{--<div class="uk-card uk-card-border uk-background-default uk-card-small">--}}
                {{--<div class="uk-card-header" style="height: auto">--}}
                  {{--<ul class="uk-list uk-text-meta">--}}
                    {{--@foreach (Config::get('languages') as $lang => $language)--}}
                      {{--@if ($lang != App::getLocale())--}}
                        {{--<li>--}}
                          {{--<a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>--}}
                        {{--</li>--}}
                      {{--@endif--}}
                    {{--@endforeach--}}
                  {{--</ul>--}}
                {{--</div>--}}
              {{--</div>--}}
            {{--</div>--}}
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
    <ul class="uk-grid uk-grid-small" uk-grid>
      <li><a href="{{ URL::to('help/need-some-help')}}">{{ trans('app.need_some_help') }}</a></li>
      <li><a href="{{ URL::to('page/about-rukuka')}}">{{ trans('app.about_rukuka') }}</a></li>
      <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
    </ul>
    <ul class="uk-grid uk-grid-small" uk-grid>
      <li>{{ trans('app.copyright') }}</li>
      <li><a href="{{ route('tracking-page')}}"> {{trans('app.track_order') }}</a> </li>
      <li>
        @foreach (Config::get('languages') as $lang => $language)
          @if ($lang == App::getLocale())
            <u> <a class="uk-text-small" href="{{ route('lang.switch', $lang) }}">{{$language}}</a> </u>
          @endif
          @if ($lang != App::getLocale())
            <a class="uk-text-small" href="{{ route('lang.switch', $lang) }}"> {{$language}} </a>
          @endif
          {{ $loop->last ? '' : '| ' }}
        @endforeach
      </li>
    </ul>
  </div>
</div>
