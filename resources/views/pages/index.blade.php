@extends('app')
@section('title', trans('app.title_homepage') )
@section('content')
    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp
                <ul class="uk-slider-items uk-grid uk-grid-collapse uk-child-width-1-2" uk-grid>
                    <li>
                      <div class="uk-inline-clip uk-transition-toggle">
                        <a href="{{ $home['homepage_url_men'] }}" class="uk-link-reset">
                          <div class="uk-inline">
                              <img src="{{ uploadCDN($home['homepage_banner_men']) }}" alt="rukuka homepage" class="uk-transition-scale-up uk-transition-opaque" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                              <div class="uk-position-center uk-panel uk-light uk-visible@m">
                                <span class="banner-highlight">{{ $home['homepage_text_men'] }}</span>
                              </div>
                            </div>
                            <span class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_men'] }}</span>
                          </a>
                        </div>
                        <hr class="uk-margin-remove-top uk-margin-bottom uk-visible@m" style="border-color: #333; border-width: 5px">
                    </li>
                    <li>
                      <div class="uk-inline-clip uk-transition-toggle">
                        <a href="{{ $home['homepage_url_women'] }}" class="uk-link-reset">
                          <div class="uk-inline">
                              <img src="{{ uploadCDN($home['homepage_banner_women']) }}" alt="rukuka homepage" class="uk-transition-scale-up uk-transition-opaque" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                              <div class="uk-position-center uk-panel uk-light uk-visible@m">
                                <span class="banner-highlight">{{ $home['homepage_text_women'] }}</span>
                              </div>
                            </div>
                            <span class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_women'] }}</span>
                          </a>
                        </div>
                        <hr class="uk-margin-remove-top uk-visible@m" style="border-color: #333; border-width: 5px">
                    </li>
                </ul>
@endsection
