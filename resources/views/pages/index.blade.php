@extends('app')

@section('content')
    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp
    <div class="uk-text-center">
      <div class="uk-container uk-container-small">
        <div class="uk-grid-small uk-text-left">
            @include('partials.alert')
        </div>
        <div class="uk-panel uk-padding-small uk-visible@m">
          <span class="uk-text-lead">{{$home['homepage_main_title']}}</span>
        </div>
        <div class="uk-panel uk-padding-small uk-hidden@m">
            <h4>{{$home['homepage_main_title']}}</h4>
        </div>
      </div>
      <div class="uk-inline">
          <a href="{{ $home['homepage_main_url'] }}" class="uk-link-reset">
            <div class="uk-inline-clip uk-transition-toggle uk-light">
                <img src="{{ uploadCDN($home['homepage_main_banner']) }}" alt="rukuka banner">
                <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
            </div>
          </a>
      </div>
    </div>
  <div class="uk-container uk-container-small">
      {{--BLOG--}}
    <div class="uk-card-border uk-card-small uk-margin-top">
    <div class="uk-card-body">
    <div class="uk-grid-small" uk-grid>

        <div class="uk-width-2-5@m uk-width-1-3 uk-flex uk-flex-middle">
          <div class="uk-visible@m">
            <h2>rukuka New Arrival</h2>
          </div>
          <div class="uk-hidden@m">
            <h4>rukuka New Arrival</h4>
          </div>
        </div>
        <div class="uk-width-3-5@m uk-width-2-3">
          <div class="uk-visible@m">
            <h2>
                <a href="{{ $home['homepage_content_url_1'] }}">{{$home['homepage_content_text_1']}}</a>
                <a href="{{ $home['homepage_content_url_2'] }}">{{$home['homepage_content_text_2']}}</a>
                <a href="{{ $home['homepage_content_url_3'] }}">{{$home['homepage_content_text_3']}}</a>
                <a href="/blog">{{$home['homepage_text_blog_1']}}</a>
            </h2>
          </div>
          <div class="uk-hidden@m">
            <h4>
                <a href="{{ $home['homepage_content_url_1'] }}">{{$home['homepage_content_text_1']}}</a>
                <a href="{{ $home['homepage_content_url_2'] }}">{{$home['homepage_content_text_2']}}</a>
                <a href="{{ $home['homepage_content_url_3'] }}">{{$home['homepage_content_text_3']}}</a>
            </h4>
          </div>
        </div>
    </div>
    </div>
  </div>
{{--END BLOG--}}
      <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_1'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_1']) }}" alt="">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_1'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_1'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_1']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_1'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_2'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_2']) }}" alt="rukuka banner">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_2'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_2'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_2']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_2'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_3'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_3']) }}" alt="rukuka banner">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_3'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_3'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_3']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_3'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_4'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_4']) }}" alt="rukuka banner">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_4'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_4'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_4']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_4'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_5'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_5']) }}" alt="rukuka banner">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_5'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_5'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_5']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_5'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_6'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_6']) }}" alt="rukuka banner">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_6'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_6'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_6']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_6'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_7'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_7']) }}" alt="rukuka banner">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_7'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_7'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_7']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_7'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_8'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_8']) }}" alt="rukuka banner">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_8'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_8'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_8']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_8'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_9'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_9']) }}" alt="rukuka banner">
                          <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_9'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_9'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_9']) }}" alt="rukuka banner">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_9'] }}</h5>
                  </a>
              </div>
          </div>
      </div>

  	<h3>MOST POPULAR</h3>
  	<popular
      api="{{ route('populer')}}"
      product_api="{{ route('product.api') }}"
      bag_api="{{ route('persist.bag') }}"
      wishlist_api="{{ route('persist.wishlist') }}"
      auth="{{ Auth::check() ? 1 : 0 }}"
    ></popular>
    </div>
@endsection
