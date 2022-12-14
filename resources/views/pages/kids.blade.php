@extends('app')
@section('title', trans('app.title_kids') )
@section('content')
    <div class="uk-container uk-container-small">
        <div class="uk-grid-small uk-margin-top" uk-grid>

            {{--MAIN BANNER--}}
            <div class="uk-text-center">
                <h3 class="uk-heading-line"><span>{{$kids['kids_main_title']}}</span></h3>
                {{--<a href="{{ $kids['kids_main_url'] }}" class="uk-link-reset">--}}
                    {{--<div class="uk-inline-clip uk-transition-toggle uk-dark">--}}
                        {{--<img src="{{ uploadCDN($kids['kids_main_banner']) }}" alt="rukuka kids" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'">--}}
                        {{--<div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>--}}
                        {{--<div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>--}}
                    {{--</div>--}}
                {{--</a>--}}
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
            </div>
            {{--END MAIN BANNER--}}
        </div>

        {{--2 ROW BANNER  --}}
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div class="uk-width-1-2">
                <a href="{{ $kids['kids_url_1'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($kids['kids_banner_1']) }}" alt="rukuka kids" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_1'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $kids['kids_text_1_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $kids['kids_url_1'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $kids['kids_text_1_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_1'] }}" class="uk-text-muted uk-link">
                      {{ $kids['kids_text_1_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>
            </div>
            <div class="uk-width-1-2">
                <a href="{{ $kids['kids_url_2'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($kids['kids_banner_2']) }}" alt="rukuka kids" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_2'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $kids['kids_text_2_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $kids['kids_url_2'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $kids['kids_text_2_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_2'] }}" class="uk-text-muted uk-link">
                      {{ $kids['kids_text_2_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>

        </div>
        {{--END 2 ROW BANNER--}}

        {{--3 ROW BANNER--}}
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div class="uk-width-1-3">
                <a href="{{ $kids['kids_url_3'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($kids['kids_banner_3']) }}" alt="rukuka kids" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_3'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $kids['kids_text_3_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $kids['kids_url_3'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $kids['kids_text_3_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_3'] }}" class="uk-text-muted uk-link">
                      {{ $kids['kids_text_3_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
            <div class="uk-width-1-3">
                <a href="{{ $kids['kids_url_4'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($kids['kids_banner_4']) }}" alt="rukuka kids" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_4'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $kids['kids_text_4_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $kids['kids_url_4'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $kids['kids_text_4_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_4'] }}" class="uk-text-muted uk-link">
                      {{ $kids['kids_text_4_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
            <div class="uk-width-1-3">
                <a href="{{ $kids['kids_url_5'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="{{ uploadCDN($kids['kids_banner_5']) }}" alt="rukuka kids" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_5'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $kids['kids_text_5_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="{{ $kids['kids_url_5'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $kids['kids_text_5_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="{{ $kids['kids_url_5'] }}" class="uk-text-muted uk-link">
                      {{ $kids['kids_text_5_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
        </div>
        {{--END 3 ROW BANNER--}}
        <hr>
        <h4 class="uk-margin-small uk-text-uppercase">{{ trans('app.trending') }}</h4>
        <popular
                api="{{ route('populer', 'Kids')}}"
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
