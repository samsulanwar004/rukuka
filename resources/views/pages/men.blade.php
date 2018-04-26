@extends('app')
@section('title', trans('app.title_mens') )
@section('content')
    <div class="uk-container">
        {{--MAIN BANNER--}}
        <div uk-slideshow="ratio: 10:4; animation:scale; autoplay: true;" class="uk-margin-top">
            <div class="uk-position-relative uk-visible-toggle uk-light">
                <ul class="uk-slideshow-items">
                  @foreach ($slider as $item)
                    <li>
                      <a href="{{ $item->url }}" class="uk-link-reset">
                        <div class="uk-position-cover">
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

        {{--2 ROW BANNER--}}
        <div class="uk-margin-top">
            <div class="uk-position-relative uk-visible-toggle">
                <ul class="uk-grid uk-grid-small uk-child-width-1-2@m" uk-grid>
                    <li>
                        <div class="uk-panel uk-transition-toggle">
                            <a href="{{ $men['men_url_1'] }}" class="uk-link-reset">
                                <div class="uk-inline">
                                    <img src="{{ uploadCDN($men['men_banner_1']) }}" alt="rukuka mens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                    <div class="uk-position-large uk-position-bottom uk-panel uk-light uk-visible@m">
                                        <h2 class="blog-subtitle"><b>{{ $men['men_text_1_1'] }}</b></h2>
                                    </div>
                                    <div class="uk-overlay-primary uk-padding-xsmall uk-position-bottom uk-panel uk-light uk-hidden@m" style="background: rgba(0,0,0,.80)">
                                      <h5><b>{{ $men['men_text_1_1'] }}</b></h5>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <hr class="uk-margin-remove-top uk-margin-bottom uk-visible@m" style="border-color: #333; border-width: 5px">
                    </li>
                    <li>
                        <div class="uk-panel uk-transition-toggle">
                            <a href="{{ $men['men_url_2'] }}" class="uk-link-reset">
                                <div class="uk-inline">
                                    <img src="{{ uploadCDN($men['men_banner_2']) }}" alt="rukuka mens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                    <div class="uk-position-large uk-position-bottom uk-panel uk-light uk-visible@m">
                                        <h2 class="blog-subtitle"><b>{{ $men['men_text_2_1'] }}</b></h2>
                                    </div>
                                    <div class="uk-overlay-primary uk-padding-xsmall uk-position-bottom uk-panel uk-light uk-hidden@m" style="background: rgba(0,0,0,.80)">
                                      <h5><b>{{ $men['men_text_2_2'] }}</b></h5>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <hr class="uk-margin-remove-top uk-visible@m" style="border-color: #333; border-width: 5px">
                    </li>
                </ul>
            </div>
        </div>
        {{--END 2 ROW BANNER--}}

        {{--3 ROW BANNER--}}
        <div class="uk-margin-top">
            <div class="uk-position-relative uk-visible-toggle">
                <ul class="uk-grid uk-grid-small uk-child-width-1-3@m" uk-grid>
                    <li>
                        <div class="uk-panel uk-transition-toggle">
                            <a href="{{ $men['men_url_3'] }}" class="uk-link-reset">
                                <div class="uk-inline">
                                    <img src="{{ uploadCDN($men['men_banner_3']) }}" alt="rukuka mens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                    <div class="uk-position-large uk-position-bottom uk-panel uk-light uk-visible@m">
                                        <h3 class="blog-subtitle"><b>{{ $men['men_text_3_1'] }}</b></h3>
                                    </div>
                                    <div class="uk-overlay-primary uk-padding-xsmall uk-position-bottom uk-panel uk-light uk-hidden@m" style="background: rgba(0,0,0,.80)">
                                      <h5><b>{{ $men['men_text_3_2'] }}</b></h5>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <hr class="uk-margin-remove-top uk-margin-bottom uk-visible@m" style="border-color: #333; border-width: 5px">
                    </li>
                    <li>
                        <div class="uk-panel uk-transition-toggle">
                            <a href="{{ $men['men_url_4'] }}" class="uk-link-reset">
                                <div class="uk-inline">
                                    <img src="{{ uploadCDN($men['men_banner_4']) }}" alt="rukuka mens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                    <div class="uk-position-large uk-position-bottom uk-panel uk-light uk-visible@m">
                                        <h3 class="blog-subtitle"><b>{{ $men['men_text_4_1'] }}</b></h3>
                                    </div>
                                    <div class="uk-overlay-primary uk-padding-xsmall uk-position-bottom uk-panel uk-light uk-hidden@m" style="background: rgba(0,0,0,.80)">
                                      <h5><b>{{ $men['men_text_4_2'] }}</b></h5>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <hr class="uk-margin-remove-top uk-visible@m" style="border-color: #333; border-width: 5px">
                    </li>
                    <li>
                        <div class="uk-panel uk-transition-toggle">
                            <a href="{{ $men['men_url_5'] }}" class="uk-link-reset">
                                <div class="uk-inline">
                                    <img src="{{ uploadCDN($men['men_banner_5']) }}" alt="rukuka mens" onerror="this.src = '{{imageCDN(config('common.default.image_3'))}}'">
                                    <div class="uk-position-large uk-position-bottom uk-panel uk-light uk-visible@m">
                                        <h3 class="blog-subtitle"><b>{{ $men['men_text_5_1'] }}</b></h3>
                                    </div>
                                    <div class="uk-overlay-primary uk-padding-xsmall uk-position-bottom uk-panel uk-light uk-hidden@m" style="background: rgba(0,0,0,.80)">
                                      <h5><b>{{ $men['men_text_5_1'] }}</b></h5>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <hr class="uk-margin-remove-top uk-margin-bottom uk-visible@m" style="border-color: #333; border-width: 5px">
                    </li>
                </ul>
            </div>
        </div>
        {{--END 3 ROW BANNER--}}

      </div>

    <div class="uk-container uk-margin-top">
        <h4 class="uk-margin-small uk-text-uppercase uk-text-center"><b>{{ trans('app.title_index_3') }}</b></h4>
        <popular
                api="{{ route('populer', 'Men')}}"
                product_api="{{ route('product.api') }}"
                bag_api="{{ route('persist.bag') }}"
                wishlist_api="{{ route('persist.wishlist') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                aws_link="{{ config('filesystems.s3url') }}"
                default_image="{{ json_encode(config('common.default')) }}"
                locale="{{ json_encode(trans('app')) }}"
                bag_link="{{ route('bag') }}"
        ></popular>
    </div>

    <div class="uk-grid-small uk-margin-bottom uk-margin-small-top">
        <div class="uk-panel uk-text-center">
            <a  href="/shop?menu=mens&parent=all" class="uk-button uk-button-small uk-button-text uk-text-uppercase">{{ trans('app.show_all_product') }}</a>
        </div>
    </div>

@endsection
