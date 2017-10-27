@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top" uk-grid>

    @php
      $leftTitle = explode('|', $women['left_title']);
      $rightTitle = explode('|', $women['right_title']);
      $title1 = explode('|', $women['title_1']);
      $title2 = explode('|', $women['title_2']);
      $title3 = explode('|', $women['title_3']);
    @endphp
    <div class="uk-text-center">
      <h3 class="uk-heading-line"><span>WHAT’S NEW FOR WOMEN</span></h3>
      <div class="uk-inline-clip uk-transition-toggle uk-dark">
          <img src="/{{ $women['main_banner'] }}" alt="">
          <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
          <!-- <div class="uk-overlay uk-overlay-default uk-padding-small uk-position-medium uk-position-bottom-right">HOT DEALS THIS WEEKEND, WITH 50% DISCOUNT, <br>
            SIGN UP NOW, ON KUKAINDONESIA.COM
          </div> -->
      </div>
    </div>
  </div>
  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-1-2@m">

            <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                <img src="/{{ $women['left_banner'] }}" alt="{{ $leftTitle[0] }}">
                <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                <div class="uk-overlay uk-overlay-default uk-padding-remove uk-position-medium uk-position-bottom-left">
                  <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW</button>
                </div>
            </div>
            <h3 class="uk-margin-remove">{{ $leftTitle[0] }}</h3>
            <a href="/{{ $women['left_link'] }}" class="uk-text-muted">
            {{ $leftTitle[1] }}<span uk-icon="icon: triangle-right"></span></a>
      </div>
      <div class="uk-width-1-2@m uk-inline">

          <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
              <img src="/{{ $women['right_banner'] }}" alt="{{ $rightTitle[0] }}">
              <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
              <div class="uk-overlay uk-overlay-default uk-padding-remove uk-position-medium uk-position-bottom-right">
                <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW</button>
              </div>
          </div>
          <h3 class="uk-margin-remove">{{ $rightTitle[0] }}</h3>
          <a href="/{{ $women['right_link'] }}" class="uk-text-muted">{{ $rightTitle[1] }}<span uk-icon="icon: triangle-right"></span></a>

      </div>
  </div>
  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-1-3@m">

            <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                <img src="/{{ $women['banner_1'] }}" alt="{{ $title1[0] }}">
                <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                <div class="uk-overlay uk-overlay-default uk-padding-remove uk-position-medium uk-position-bottom-left">
                  <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW</button>
                </div>
            </div>
            <h3 class="uk-margin-remove">{{ $title1[0] }}</h3>
            <a href="/{{ $women['link_1'] }}" class="uk-text-muted">{{ $title1[1] }}<span uk-icon="icon: triangle-right"></span></a>

      </div>
      <div class="uk-width-1-3@m uk-inline">

          <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
              <img src="/{{ $women['banner_2'] }}" alt="{{ $title2[0] }}">
              <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
              <div class="uk-overlay uk-overlay-default uk-padding-remove uk-position-medium uk-position-bottom-center">
                <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW</button>
              </div>
          </div>
          <h3 class="uk-margin-remove">{{ $title2[0] }}</h3>
          <a href="/{{ $women['link_2'] }}" class="uk-text-muted">{{ $title2[1] }}<span uk-icon="icon: triangle-right"></span></a>

      </div>
      <div class="uk-width-1-3@m uk-inline">
        <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
            <img src="/{{ $women['banner_3'] }}" alt="{{ $title3[0] }}">
            <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
            <div class="uk-overlay uk-overlay-default uk-padding-remove uk-position-medium uk-position-bottom-right">
              <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW</button>
            </div>
        </div>
        <h3 class="uk-margin-remove">{{ $title3[0] }}</h3>
        <a href="/{{ $women['link_3'] }}" class="uk-text-muted">{{ $title3[1] }}<span uk-icon="icon: triangle-right"></span></a>
      </div>
  </div>
  <h3 class="uk-text-center uk-heading-divider">TRENDING NOW</h3>
    <popular api="{{ route('populer')}}"></popular>
</div>
@endsection
