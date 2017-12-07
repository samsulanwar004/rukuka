@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        <div class="uk-grid-small uk-margin-top" uk-grid>

            {{--MAIN BANNER--}}
            <div class="uk-text-center">
                <h3 class="uk-heading-line"><span>{{$men['men_main_title']}}</span></h3>
                <a href="{{ $men['men_main_url'] }}" class="uk-link-reset">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark">
                        <img src="/{{ $men['men_main_banner'] }}" alt="">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
            </div>
            {{--END MAIN BANNER--}}
        </div>

        {{--2 ROW BANNER  --}}
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div class="uk-width-1-2">
                <a href="/{{ $men['men_url_1'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $men['men_banner_1'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_1'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $men['men_text_1_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="/{{ $men['men_url_1'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $men['men_text_1_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_1'] }}" class="uk-text-muted uk-link">
                      {{ $men['men_text_1_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
            <div class="uk-width-1-2">
                <a href="/{{ $men['men_url_2'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $men['men_banner_2'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_2'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $men['men_text_2_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="/{{ $men['men_url_2'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $men['men_text_2_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_2'] }}" class="uk-text-muted uk-link">
                      {{ $men['men_text_2_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>

        </div>
        {{--END 2 ROW BANNER--}}

        {{--3 ROW BANNER--}}
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div class="uk-width-1-3">
                <a href="/{{ $men['men_url_3'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $men['men_banner_3'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_3'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $men['men_text_3_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="/{{ $men['men_url_3'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $men['men_text_3_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_3'] }}" class="uk-text-muted uk-link">
                      {{ $men['men_text_3_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
            <div class="uk-width-1-3">
                <a href="/{{ $men['men_url_4'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $men['men_banner_4'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_4'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $men['men_text_4_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="/{{ $men['men_url_4'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $men['men_text_4_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_4'] }}" class="uk-text-muted uk-link">
                      {{ $men['men_text_4_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
            <div class="uk-width-1-3">
                <a href="/{{ $men['men_url_5'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $men['men_banner_5'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_5'] }}" class="uk-text-muted">
                      <h3 class="uk-margin-remove">{{ $men['men_text_5_1'] }}</h3>
                  </a>
                </div>
                <div class="uk-hidden@m">
                  <a href="/{{ $men['men_url_5'] }}" class="uk-text-muted">
                      <h5 class="uk-margin-remove">{{ $men['men_text_5_1'] }}</h5>
                  </a>
                </div>
                <div class="uk-visible@m">
                  <a href="/{{ $men['men_url_5'] }}" class="uk-text-muted uk-link">
                      {{ $men['men_text_5_2'] }}<span uk-icon="icon: triangle-right"></span>
                  </a>
                </div>

            </div>
        </div>
        {{--END 3 ROW BANNER--}}
        <hr>
        <h3 class="uk-margin-small">TRENDING NOW</h3>
        <popular
                api="{{ route('populer')}}"
                product_api="{{ route('product.api') }}"
                bag_api="{{ route('persist.bag') }}"
                wishlist_api="{{ route('persist.wishlist') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
        ></popular>
    </div>
@endsection
