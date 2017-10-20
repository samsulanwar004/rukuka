@extends('app')

@section('content')

<div class="uk-grid-small uk-margin-top" uk-grid>

    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp
    <div class="uk-text-center">
      <div class="uk-inline-clip uk-transition-toggle uk-dark">
          <img src="/{{ $home['main_banner'] }}" alt="">
          <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
          <!-- <div class="uk-overlay uk-overlay-default uk-padding-small uk-position-medium uk-position-bottom-right">HOT DEALS THIS WEEKEND, WITH 50% DISCOUNT, <br>
            SIGN UP NOW, ON KUKAINDONESIA.COM
          </div> -->
      </div>
    </div>
  </div>
  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-1-3@m">

            <div class="uk-inline-clip uk-transition-toggle uk-dark">
                <img src="/{{ $home['women_banner'] }}" alt="">
                <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>

            </div>
            <h3 class="uk-margin-remove">{{ $womenTitle[0] }}</h3>
            <a href="/{{ $home['women_link'] }}" class="uk-text-muted">{{ $womenTitle[1] }}<span uk-icon="icon: triangle-right"></span></a>
      </div>
      <div class="uk-width-1-3@m uk-inline">

          <div class="uk-inline-clip uk-transition-toggle uk-dark">
              <img src="/{{ $home['men_banner'] }}" alt="">
              <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>

          </div>
          <h3 class="uk-margin-remove">{{ $menTitle[0] }}</h3>
          <a href="/{{ $home['men_link'] }}" class="uk-text-muted">{{ $menTitle[1] }}<span uk-icon="icon: triangle-right"></span></a>

      </div>
      <div class="uk-width-1-3@m uk-inline">

          <div class="uk-inline-clip uk-transition-toggle uk-dark">
              <img src="/{{ $home['kid_banner'] }}" alt="">
              <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
          </div>
          <h3 class="uk-margin-remove">{{ $kidTitle[0] }}</h3>
          <a href="/{{ $home['kid_link'] }}" class="uk-text-muted">{{ $kidTitle[1] }}<span uk-icon="icon: triangle-right"></span></a>

      </div>
  </div>
  <hr>
  <!-- <div class="uk-text-left">
  <h2><span><b>Shop New Arrivals</b></span></h2>
  </div> -->
  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-1-5@m">

            <h5 class="uk-margin-remove">New Arrival</h5>
            <h3 class="uk-margin-remove">For Women</h3>
            <a href="#" class="uk-text-muted">Shop Now<span uk-icon="icon: triangle-right"></span></a>
      </div>
      <div class="uk-width-1-5@m uk-inline">

          <h5 class="uk-margin-remove">New Arrival</h5>
          <h3 class="uk-margin-remove">For Men</h3>
          <a href="#" class="uk-text-muted">Shop Now<span uk-icon="icon: triangle-right"></span></a>

      </div>
      <div class="uk-width-1-5@m uk-inline">
          <h5 class="uk-margin-remove">New Arrival</h5>
          <h3 class="uk-margin-remove">For Kids</h3>
          <a href="#" class="uk-text-muted">Shop NOw<span uk-icon="icon: triangle-right"></span></a>

      </div>
      <div class="uk-width-2-5@m uk-inline">

          <h3 class="uk-margin-remove uk-text-danger">Lets See On The Blog</h3>
          <a href="#" class="uk-text-muted">Inspiration and Interesting People Out There,<span uk-icon="icon: triangle-right"></span></a>

      </div>
  </div>
  <hr>
  <div class="uk-text-left">
  <h2><span><b>Shop & Collection</b></span></h2>
  </div>
  <div class="uk-grid-small uk-margin-top uk-margin-bottom uk-child-width-1-2@m" uk-grid>
      <div class="uk-panel">

            <div class="uk-inline-clip uk-transition-toggle uk-dark">
                <img src="/{{ $home['left_banner'] }}" alt="">
                <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                <div class="uk-overlay uk-overlay-default uk-padding-small uk-position-medium uk-position-bottom-left"><b>FOR WOMEN</b> <br>Our Clothes, Your Style
                </div>

            </div>
            <h3 class="uk-margin-remove">{{ $leftTitle[0] }}</h3>
            <a href="/{{ $home['left_link'] }}" class="uk-text-muted">{{ $leftTitle[1] }}<span uk-icon="icon: triangle-right"></span></a>
      </div>
      <div class="uk-panel">

          <div class="uk-inline-clip uk-transition-toggle uk-dark">
              <img src="/{{ $home['right_banner'] }}" alt="">
              <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
              <div class="uk-overlay uk-overlay-default uk-padding-small uk-position-medium uk-position-bottom-right"><b>FOR MEN</b> <br>Our broken-in tees
              </div>
          </div>
          <h3 class="uk-margin-remove">{{ $rightTitle[0] }}</h3>
          <a href="/{{ $home['right_link'] }}" class="uk-text-muted">{{ $rightTitle[1] }}<span uk-icon="icon: triangle-right"></span></a>
      </div>
  </div>
  <hr>
  <div class="uk-text-left">
  	<h2><span>Most Popular</span></h2>
  </div>
  	<popular api="{{ route('populer')}}"></popular>
  <hr>
  <div class="uk-text-left">
  <h2><span><b>KuKa <i>Stories</i>: The Blog</b></span></h2>
  </div>

  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-3-4@m">

            <div class="uk-inline-clip uk-transition-toggle uk-dark">
                <img src="images/pak_denny_jpeg.jpg" alt="">
                <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                <div class="uk-overlay uk-overlay-default uk-position-medium uk-position-bottom-left">
                  <h2><a href="#">What are the rules of party dressing?</a></h2>
                  <a href="#">See all the Story from KuKa Blog<span uk-icon="icon: triangle-right" class="uk-icon"></span></a>
                  <!-- <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW FOR WOMEN</button> -->
                </div>
            </div>
            <!-- <h3 class="uk-margin-remove">2017: Women in Style</h3>
            <a href="#" class="uk-text-muted">Shop all this amazing outfit now<span uk-icon="icon: triangle-right"></span></a> -->
      </div>
      <div class="uk-width-1-4@m uk-inline">

          <h3 class="uk-margin-remove">How can we help?</h3>
          <ul class="uk-list">
            <li><a href="#">Find my nearest store</a></li>
            <li><a href="#">Track my order </a></li>
            <li><a href="#">See the latest Style Guide on Pinterest </a></li>
            <li><a href="#">Sign in to My Account </a></li>
            <li><a href="#">Share how great our product </a></li>
          </ul>

      </div>
  </div>
@endsection
