@extends('app')
@section('title', trans('app.title_womens') )
@section('content')
    <div class="uk-container">
        {{--MAIN BANNER--}}
        <div uk-slideshow="ratio: 10:3; min-height: 200; max-height: 600; animation:scale; autoplay: true;" class="uk-margin-top">
            <div class="uk-position-relative uk-visible-toggle uk-light">
                <ul class="uk-slideshow-items">
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
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
            </div>
        </div>
        {{--END MAIN BANNER--}}
        {{--END 2 ROW BANNER--}}
        <div uk-slider="clsActivated: uk-transition-active;" class="uk-margin-top">
                <div class="uk-position-relative uk-visible-toggle">
                    <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-2" uk-grid>
                        <li>
                          <div class="uk-panel uk-transition-toggle">
                            <a href="{{ $women['women_url_1'] }}" class="uk-link-reset">
                              <div class="uk-inline">
                                  <img src="{{ uploadCDN($women['women_banner_1']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                  <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m">
                                    <h2 class="blog-subtitle"><b>{{ $women['women_text_1_1'] }}</b></h2>
                                    <h4 class="uk-margin-remove-top blog-subtitle">{{ $women['women_text_1_1'] }}</h4>
                                    <a href="{{ $women['women_url_1'] }}" class="uk-button uk-button-default">{{ trans('app.subtitle_index_1') }}</a>
                                  </div>
                                </div>
                                <span class="uk-margin-small uk-dark uk-hidden@m">{{ $women['women_text_1_1'] }}</span>
                              </a>
                            </div>
                            <hr class="uk-margin-remove-top uk-margin-bottom" style="border-color: #333; border-width: 5px">
                        </li>
                        <li>
                          <div class="uk-panel uk-transition-toggle">
                            <a href="{{ $women['women_url_2'] }}" class="uk-link-reset">
                              <div class="uk-inline">
                                  <img src="{{ uploadCDN($women['women_banner_2']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                  <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m">
                                    <h2 class="blog-subtitle"><b>{{ $women['women_text_2_1'] }}</b></h2>
                                    <h4 class="uk-margin-remove-top blog-subtitle">{{ $women['women_text_2_1'] }}</h4>
                                    <a href="{{ $women['women_url_2'] }}" class="uk-button uk-button-default">{{ trans('app.subtitle_index_1') }}</a>
                                  </div>
                                </div>
                                <span class="uk-margin-small uk-dark uk-hidden@m">{{ $women['women_text_2_1'] }}</span>
                              </a>
                            </div>
                            <hr class="uk-margin-remove-top uk-margin-bottom" style="border-color: #333; border-width: 5px">
                        </li>
                    </ul>
                </div>
            </div>

            <div uk-slider="clsActivated: uk-transition-active;" class="uk-margin-top">
                    <div class="uk-position-relative uk-visible-toggle">
                        <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-3" uk-grid>
                            <li>
                              <div class="uk-panel uk-transition-toggle">
                                <a href="{{ $women['women_url_3'] }}" class="uk-link-reset">
                                  <div class="uk-inline">
                                      <img src="{{ uploadCDN($women['women_banner_3']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                      <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m">
                                        <h3 class="blog-subtitle"><b>{{ $women['women_text_3_1'] }}</b></h3>
                                        <h6 class="uk-margin-remove-top blog-subtitle">{{ $women['women_text_3_1'] }}</h6>
                                        <a href="{{ $women['women_url_3'] }}" class="uk-button uk-button-default">{{ trans('app.subtitle_index_1') }}</a>
                                      </div>
                                    </div>
                                    <span class="uk-margin-small uk-dark uk-hidden@m">{{ $women['women_text_3_1'] }}</span>
                                  </a>
                                </div>
                                <hr class="uk-margin-remove-top uk-margin-bottom" style="border-color: #333; border-width: 5px">
                            </li>
                            <li>
                              <div class="uk-panel uk-transition-toggle">
                                <a href="{{ $women['women_url_4'] }}" class="uk-link-reset">
                                  <div class="uk-inline">
                                      <img src="{{ uploadCDN($women['women_banner_4']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                      <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m">
                                        <h3 class="blog-subtitle"><b>{{ $women['women_text_4_1'] }}</b></h3>
                                        <h6 class="uk-margin-remove-top blog-subtitle">{{ $women['women_text_4_1'] }}</h6>
                                        <a href="{{ $women['women_url_4'] }}" class="uk-button uk-button-default">{{ trans('app.subtitle_index_1') }}</a>
                                      </div>
                                    </div>
                                    <span class="uk-margin-small uk-dark uk-hidden@m">{{ $women['women_text_4_1'] }}</span>
                                  </a>
                                </div>
                                <hr class="uk-margin-remove-top uk-margin-bottom" style="border-color: #333; border-width: 5px">
                            </li>
                            <li>
                              <div class="uk-panel uk-transition-toggle">
                                <a href="{{ $women['women_url_5'] }}" class="uk-link-reset">
                                  <div class="uk-inline">
                                      <img src="{{ uploadCDN($women['women_banner_5']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                      <div class="uk-position-medium uk-position-bottom uk-panel uk-light uk-visible@m">
                                        <h3 class="blog-subtitle"><b>{{ $women['women_text_5_1'] }}</b></h3>
                                        <h6 class="uk-margin-remove-top blog-subtitle">{{ $women['women_text_5_1'] }}</h6>
                                        <a href="{{ $women['women_url_5'] }}" class="uk-button uk-button-default">{{ trans('app.subtitle_index_1') }}</a>
                                      </div>
                                    </div>
                                    <span class="uk-margin-small uk-dark uk-hidden@m">{{ $women['women_text_5_1'] }}</span>
                                  </a>
                                </div>
                                <hr class="uk-margin-remove-top uk-margin-bottom" style="border-color: #333; border-width: 5px">
                            </li>
                        </ul>
                    </div>
                </div>

        {{--END 3 ROW BANNER--}}
      </div>
        <div class="uk-container uk-margin-top">
        <h4 class="uk-margin-small uk-text-uppercase uk-text-center"><b>{{ trans('app.title_index_3') }}</b></h4>
        <popular
                api="{{ route('populer', 'Women')}}"
                product_api="{{ route('product.api') }}"
                bag_api="{{ route('persist.bag') }}"
                wishlist_api="{{ route('persist.wishlist') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                aws_link="{{ config('filesystems.s3url') }}"
                default_image="{{ json_encode(config('common.default')) }}"
                locale="{{ json_encode(trans('app')) }}"
        ></popular>
    </div>
@endsection
