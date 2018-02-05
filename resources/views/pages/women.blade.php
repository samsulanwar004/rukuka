@extends('app')

@section('content')
    <div class="uk-container uk-container-small">


            {{--MAIN BANNER--}}
            {{-- <div class="uk-text-center">
                <div class="uk-inline">
                    <ul id="component-tab-left" class="uk-switcher">
                        @foreach ($slider as $item)
                            <a href="{{ $item->url }}" class="uk-link-reset">
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
            </div> --}}
            <div uk-slideshow="ratio: 10:3; min-height: 200; max-height: 600; animation:scale; autoplay: true;" class="uk-margin-top">

                <div class="uk-position-relative uk-visible-toggle uk-light">

                    <ul class="uk-slideshow-items">
                      @foreach ($slider as $item)
                        <li>
                            <div class="uk-position-cover" uk-slideshow-parallax="scale: 1.2,1.2,1">
                                <img src="{{ uploadCDN($item->banner) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'" uk-cover>
                            </div>
                            <div class="uk-position-cover" uk-slideshow-parallax="opacity: 0,0,0.2; background-color: #000,#000"></div>
                        </li>
                      @endforeach

                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                </div>

              
            </div>
            {{--END MAIN BANNER--}}


        {{--2 ROW BANNER  --}}
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div class="uk-width-1-2">
                <a href="{{ $women['women_url_1'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($women['women_banner_1']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_1'] }}" class="uk-text-muted">
                    <h3 class="uk-margin-remove">{{ $women['women_text_1_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $women['women_url_1'] }}" class="uk-text-muted">
                    <h5 class="uk-margin-remove">{{ $women['women_text_1_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_1'] }}" class="uk-text-muted uk-link">
                      {{ $women['women_text_1_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
            <div class="uk-width-1-2">
                <a href="{{ $women['women_url_2'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($women['women_banner_2']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_2'] }}" class="uk-text-muted">
                    <h3 class="uk-margin-remove">{{ $women['women_text_2_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $women['women_url_2'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $women['women_text_2_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_2'] }}" class="uk-text-muted uk-link">
                      {{ $women['women_text_2_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>

        </div>
        {{--END 2 ROW BANNER--}}

        {{--3 ROW BANNER--}}
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div class="uk-width-1-3">
                <a href="{{ $women['women_url_3'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($women['women_banner_3']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_3'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $women['women_text_3_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $women['women_url_3'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $women['women_text_3_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_3'] }}" class="uk-text-muted uk-link">
                      {{ $women['women_text_3_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
            <div class="uk-width-1-3">
                <a href="{{ $women['women_url_4'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($women['women_banner_4']) }}" alt="rukuka mens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_4'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $women['women_text_4_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $women['women_url_4'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $women['women_text_4_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_4'] }}" class="uk-text-muted uk-link">
                      {{ $women['women_text_4_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
            <div class="uk-width-1-3">
                <a href="{{ $women['women_url_5'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($women['women_banner_5']) }}" alt="rukuka womens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_5'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $women['women_text_5_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $women['women_url_5'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $women['women_text_5_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $women['women_url_5'] }}" class="uk-text-muted uk-link">
                      {{ $women['women_text_5_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
        </div>
        {{--END 3 ROW BANNER--}}
        <hr>

        <h4 class="uk-margin-small">TRENDING NOW</h4>
        <popular
                api="{{ route('populer', 'Women')}}"
                product_api="{{ route('product.api') }}"
                bag_api="{{ route('persist.bag') }}"
                wishlist_api="{{ route('persist.wishlist') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                aws_link="{{ config('filesystems.s3url') }}"
                default_image="{{ json_encode(config('common.default')) }}"
        ></popular>
    </div>
@endsection
