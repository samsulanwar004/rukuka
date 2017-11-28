@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        <div class="uk-grid-small uk-margin-top" uk-grid>

            {{--MAIN BANNER--}}
            <div class="uk-text-center">
                <h3 class="uk-heading-line"><span>{{$kids['kids_main_title']}}</span></h3>
                <a href="{{ $kids['kids_main_url'] }}" class="uk-link-reset">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark">
                        <img src="/{{ $kids['kids_main_banner'] }}" alt="">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
            </div>
            {{--END MAIN BANNER--}}
        </div>

        {{--2 ROW BANNER  --}}
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div class="uk-width-1-2@m">
                <a href="/{{ $kids['kids_url_1'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $kids['kids_banner_1'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <a href="/{{ $kids['kids_url_1'] }}" class="uk-text-muted">
                    <h3 class="uk-margin-remove">{{ $kids['kids_text_1_1'] }}</h3>
                </a>
                <a href="/{{ $kids['kids_url_1'] }}" class="uk-text-muted uk-link">
                    {{ $kids['kids_text_1_2'] }}<span uk-icon="icon: triangle-right"></span>
                </a>
            </div>
            <div class="uk-width-1-2@m">
                <a href="/{{ $kids['kids_url_2'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $kids['kids_banner_2'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <a href="/{{ $kids['kids_url_2'] }}" class="uk-text-muted">
                    <h3 class="uk-margin-remove">{{ $kids['kids_text_2_1'] }}</h3>
                </a>
                <a href="/{{ $kids['kids_url_2'] }}" class="uk-text-muted uk-link">
                    {{ $kids['kids_text_2_2'] }}<span uk-icon="icon: triangle-right"></span>
                </a>
            </div>

        </div>
        {{--END 2 ROW BANNER--}}

        {{--3 ROW BANNER--}}
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div class="uk-width-1-3@m">
                <a href="/{{ $kids['kids_url_3'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $kids['kids_banner_3'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <a href="/{{ $kids['kids_url_3'] }}" class="uk-text-muted">
                    <h3 class="uk-margin-remove">{{ $kids['kids_text_3_1'] }}</h3>
                </a>
                <a href="/{{ $kids['kids_url_3'] }}" class="uk-text-muted uk-link">
                    {{ $kids['kids_text_3_2'] }}<span uk-icon="icon: triangle-right"></span>
                </a>
            </div>
            <div class="uk-width-1-3@m">
                <a href="/{{ $kids['kids_url_4'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $kids['kids_banner_4'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <a href="/{{ $kids['kids_url_4'] }}" class="uk-text-muted">
                    <h3 class="uk-margin-remove">{{ $kids['kids_text_4_1'] }}</h3>
                </a>
                <a href="/{{ $kids['kids_url_4'] }}" class="uk-text-muted uk-link">
                    {{ $kids['kids_text_4_2'] }}<span uk-icon="icon: triangle-right"></span>
                </a>
            </div>
            <div class="uk-width-1-3@m">
                <a href="/{{ $kids['kids_url_5'] }}" class="uk-text-muted">
                    <div class="uk-inline-clip uk-transition-toggle uk-dark uk-margin-small-bottom">
                        <img src="/{{ $kids['kids_banner_5'] }}" alt="{{ $leftTitle[0] }}">
                        <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                        <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                    </div>
                </a>
                <a href="/{{ $kids['kids_url_5'] }}" class="uk-text-muted">
                    <h3 class="uk-margin-remove">{{ $kids['kids_text_5_1'] }}</h3>
                </a>
                <a href="/{{ $kids['kids_url_5'] }}" class="uk-text-muted uk-link">
                    {{ $kids['kids_text_5_2'] }}<span uk-icon="icon: triangle-right"></span>
                </a>
            </div>
        </div>
        {{--END 3 ROW BANNER--}}

        <h3 class="uk-text-center uk-heading-divider">TRENDING NOW</h3>
        <popular api="{{ route('populer')}}"></popular>
    </div>
@endsection
