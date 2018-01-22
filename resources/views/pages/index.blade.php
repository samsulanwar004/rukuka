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
            <h5>{{$home['homepage_main_title']}}</h5>
        </div>
      </div>
      <div class="uk-inline">
          {{-- <a href="{{ $home['homepage_main_url'] }}" class="uk-link-reset">
            <div class="uk-inline-clip uk-transition-toggle uk-light">
                <img src="{{ uploadCDN($home['homepage_main_banner']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'">
                <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
            </div>
          </a> --}}

          <ul id="component-tab-left" class="uk-switcher">



            @foreach ($slider as $item)
              <a href="{{ $home['homepage_main_url'] }}" class="uk-link-reset">
              <li>
                <img src="{{ uploadCDN($item->banner) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'">
              </li>
            </a>
            @endforeach

          </ul>
          <div class="uk-position-small uk-position-bottom-center">
            <ul class="uk-dotnav" uk-switcher="connect: #component-tab-left; animation: uk-animation-fade" >
              @foreach ($slider as $item)
                <li><a href="#">item1</a></li>
              @endforeach
            </ul>
          </div>
      </div>
    </div>
  <div class="uk-container uk-container-small">
      {{--BLOG--}}
    <div class="uk-card-border uk-card-small uk-margin-top uk-margin-bottom">
    <div class="uk-card-body">
    <div class="uk-grid-small" uk-grid>

        <div class="uk-width-2-5@m uk-width-1-3 uk-flex uk-flex-middle">
          <div class="uk-visible@m">
            <h2>rukuka New Arrival</h2>
          </div>
          <div class="uk-hidden@m">
            <h5 class="uk-margin-remove">New Arrival</h5>
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
            <h5 class="uk-margin-remove">
                <a href="{{ $home['homepage_content_url_1'] }}">{{$home['homepage_content_text_1']}}</a>
                <a href="{{ $home['homepage_content_url_2'] }}">{{$home['homepage_content_text_2']}}</a>
                <a href="{{ $home['homepage_content_url_3'] }}">{{$home['homepage_content_text_3']}}</a>
            </h5>
          </div>
        </div>
    </div>
    </div>
  </div>
{{--END BLOG--}}
      <div class="uk-grid-small" uk-grid>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_1'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_1']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                              <div class="uk-card-body">
                                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove uk-text-center"><b>{{ $home['homepage_text_1'] }}</b></h3></div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="uk-inline uk-hidden@m">
                  <a href="{{ $home['homepage_url_1'] }}" class="uk-link-reset">
                      <img src="{{ uploadCDN($home['homepage_banner_1']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_1'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_2'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_2']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
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
                      <img src="{{ uploadCDN($home['homepage_banner_2']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_2'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_3'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_3']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
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
                      <img src="{{ uploadCDN($home['homepage_banner_3']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_3'] }}</h5>
                  </a>
              </div>
          </div>
      </div>
      <div class="uk-grid-small" uk-grid>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_4'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_4']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
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
                      <img src="{{ uploadCDN($home['homepage_banner_4']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_4'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_5'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_5']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
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
                      <img src="{{ uploadCDN($home['homepage_banner_5']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_5'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_6'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_6']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
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
                      <img src="{{ uploadCDN($home['homepage_banner_6']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_6'] }}</h5>
                  </a>
              </div>
          </div>
      </div>
      <div class="uk-grid-small" uk-grid>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_7'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_7']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
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
                      <img src="{{ uploadCDN($home['homepage_banner_7']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_7'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_8'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_8']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
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
                      <img src="{{ uploadCDN($home['homepage_banner_8']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_8'] }}</h5>
                  </a>
              </div>
          </div>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_9'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_9']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
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
                      <img src="{{ uploadCDN($home['homepage_banner_9']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                      <h5 class="uk-margin-remove">{{ $home['homepage_text_9'] }}</h5>
                  </a>
              </div>
          </div>
      </div>

  	<h3>MOST POPULAR</h3>
  	<popular
      api="{{ route('populer', 'Homepage')}}"
      product_api="{{ route('product.api') }}"
      bag_api="{{ route('persist.bag') }}"
      wishlist_api="{{ route('persist.wishlist') }}"
      auth="{{ Auth::check() ? 1 : 0 }}"
      aws_link="{{ config('filesystems.s3url') }}"
      default_image="{{ json_encode(config('common.default')) }}"
    ></popular>
    </div>
@endsection
