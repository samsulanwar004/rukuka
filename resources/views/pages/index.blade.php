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

      </div>
      <div class="uk-margin js-slideshow-animation" uk-slideshow="ratio: 10:3; min-height: 150; max-height: 600;">

            <div class="uk-position-relative uk-visible-toggle uk-light">

                <ul class="uk-slideshow-items">
                  <li>
                    <video playsinline uk-cover uk-video="automute: true; autoplay: true" loop>
                      <source src="{{ config('common.video_slide') }}" type="video/mp4">
                    </video>
                  </li>
                  @foreach ($slider as $item)
                    <li>
                      <a href="{{ $item->url }}" class="uk-link-reset">
                      <div class="uk-position-cover" uk-slideshow-parallax="scale: 1.2,1.2,1">
                        <img src="{{ uploadCDN($item->banner) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'" uk-cover>
                      </div>
                      <div class="uk-position-cover" uk-slideshow-parallax="opacity: 0,0,0.2; background-color: #000,#000"></div>
                    </a>
                    </li>

                  @endforeach
                </ul>

                <a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                <div class="uk-position-bottom-center uk-position-medium">
                    <ul class="uk-slideshow-nav uk-dotnav"></ul>
                </div>

            </div>

        </div>
    </div>
  <div class="uk-container uk-container-small">
      {{--BLOG--}}

    <h2 class="uk-text-center uk-margin-top-large uk-visible@m">New Arrival</h2>
    <h4 class="uk-text-center uk-margin-small-top uk-hidden@m">New Arrival</h4>
{{--END BLOG--}}
    <div uk-slider="clsActivated: uk-transition-active; autoplay: true">

            <div class="uk-position-relative uk-visible-toggle">

                <ul class="uk-slider-items uk-child-width-1-3 uk-child-width-1-3@m">
                    <li>
                      <div class="uk-inline">
                      <div class="uk-overlay-primary uk-position-cover"></div>
                      <div class="uk-inline">
                      <div class="uk-overlay-primary uk-position-cover"></div>
                      <a href="{{ $home['homepage_url_1'] }}" class="uk-link-reset">
                        <img src="{{ uploadCDN($home['homepage_banner_1']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small  uk-visible@m">{{ $home['homepage_text_1'] }}</h2></div>
                        <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_1'] }}</h5>
                      </a>
                    </div>
                      </div>
                    </li>
                    <li>
                      <div class="uk-inline">
                      <div class="uk-overlay-primary uk-position-cover"></div>
                      <a href="{{ $home['homepage_url_2'] }}" class="uk-link-reset">
                        <img src="{{ uploadCDN($home['homepage_banner_2']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small  uk-visible@m">{{ $home['homepage_text_2'] }}</h2></div>
                        <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_2'] }}</h5>
                      </a>
                    </div>
                    </li>
                    <li>
                      <div class="uk-inline">
                      <div class="uk-overlay-primary uk-position-cover"></div>
                      <a href="{{ $home['homepage_url_3'] }}" class="uk-link-reset">
                        <img src="{{ uploadCDN($home['homepage_banner_3']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small  uk-visible@m">{{ $home['homepage_text_3'] }}</h2></div>
                        <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_3'] }}</h5>
                      </a>
                    </div>
                    </li>
                    <li>
                      <div class="uk-inline">
                      <div class="uk-overlay-primary uk-position-cover"></div>
                      <a href="{{ $home['homepage_url_4'] }}" class="uk-link-reset">
                        <img src="{{ uploadCDN($home['homepage_banner_4']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small  uk-visible@m">{{ $home['homepage_text_4'] }}</h2></div>
                        <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_4'] }}</h5>
                      </a>
                    </div>
                    </li>
                    <li>
                      <div class="uk-inline">
                      <div class="uk-overlay-primary uk-position-cover"></div>
                      <a href="{{ $home['homepage_url_5'] }}" class="uk-link-reset">
                        <img src="{{ uploadCDN($home['homepage_banner_5']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small  uk-visible@m">{{ $home['homepage_text_5'] }}</h2></div>
                        <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_5'] }}</h5>
                      </a>
                    </div>
                    </li>
                    <li>
                      <div class="uk-inline">
                      <div class="uk-overlay-primary uk-position-cover"></div>
                      <a href="{{ $home['homepage_url_6'] }}" class="uk-link-reset">
                        <img src="{{ uploadCDN($home['homepage_banner_6']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small  uk-visible@m">{{ $home['homepage_text_6'] }}</h2></div>
                        <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_6'] }}</h5>
                      </a>
                    </div>
                    </li>
                </ul>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

            </div>

            {{-- <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul> --}}

        </div>
        <hr class="uk-margin-large-top" style="border-color: #333; border-width: 3px">
        <h2 class="uk-text-center uk-visible@m">Happenings Right Now!</h2>
        <h4 class="uk-text-center uk-hidden@m">Happenings Right Now!</h4>

        <div uk-slider="clsActivated: uk-transition-active;">
                <div class="uk-position-relative uk-visible-toggle">
                    <ul class="uk-slider-items uk-child-width-1-3" uk-grid>
                        <li>
                            <div class="uk-panel uk-transition-toggle">
                              <div class="uk-inline">
                              <div class="uk-overlay-primary uk-position-cover"></div>
                              <a href="{{ $home['homepage_url_7'] }}" class="uk-link-reset">
                                <img src="{{ uploadCDN($home['homepage_banner_7']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small">{{ $home['homepage_text_7'] }}</h2></div>
                                <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_7'] }}</h5>
                              </a>
                            </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-panel uk-transition-toggle">
                              <div class="uk-inline">
                              <div class="uk-overlay-primary uk-position-cover"></div>
                              <a href="{{ $home['homepage_url_8'] }}" class="uk-link-reset">
                                <img src="{{ uploadCDN($home['homepage_banner_8']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small">{{ $home['homepage_text_8'] }}</h2></div>
                                <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_8'] }}</h5>
                              </a>
                            </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-panel uk-transition-toggle">
                              <div class="uk-inline">
                              <div class="uk-overlay-primary uk-position-cover"></div>
                              <a href="{{ $home['homepage_url_9'] }}" class="uk-link-reset">
                                <img src="{{ uploadCDN($home['homepage_banner_9']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m"><h2 class="uk-transition-slide-bottom-small">{{ $home['homepage_text_9'] }}</h2></div>
                                <h5 class="uk-margin-small uk-dark uk-hidden@m">{{ $home['homepage_text_9'] }}</h5>
                              </a>
                            </div>
                            </div>
                        </li>
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

                </div>



            </div>
      {{-- <div class="uk-grid-small" uk-grid>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_1'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_1']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small">
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
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small">
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
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small">
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
      </div> --}}

      {{-- <div class="uk-grid-small" uk-grid>
          <div class="uk-width-1-3 uk-inline">
              <div class="uk-inline uk-visible@m">
                  <div class="uk-inline-clip uk-transition-toggle uk-light">
                      <a href="{{ $home['homepage_url_7'] }}" class="uk-link-reset">
                          <img src="{{ uploadCDN($home['homepage_banner_7']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover">
                          </div>
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small">
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
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small">
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
                          <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small">
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
--}}
</div>
  <div class="uk-container">
    <hr class="uk-margin-large-top">
    <h4 class="uk-text-uppercase">{{ trans('app.popular') }}</h4>
  	<popular
      api="{{ route('populer', 'Homepage')}}"
      product_api="{{ route('product.api') }}"
      bag_api="{{ route('persist.bag') }}"
      wishlist_api="{{ route('persist.wishlist') }}"
      auth="{{ Auth::check() ? 1 : 0 }}"
      aws_link="{{ config('filesystems.s3url') }}"
      default_image="{{ json_encode(config('common.default')) }}"
      bag_link="{{ route('bag') }}"
      locale="{{ json_encode(trans('app')) }}"
      exchange="{{ json_encode($exchange) }}"
    ></popular>
    </div>


@endsection
