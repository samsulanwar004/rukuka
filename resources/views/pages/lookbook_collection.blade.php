@extends('app')
@section('title', trans('app.title_lookbook') )
@section('content')
    <div class="uk-container uk-container-small">
        {{-- <div uk-slideshow="animation: push; autoplay:true">
            <div class="uk-position-relative uk-visible-toggle uk-light">
                <ul class="uk-slideshow-items">
                    <li>
                        <div class="uk-position-cover">
                            <img src="{{ uploadCDN($lookbook->banner) }}" alt="rukuka lookbook" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'" uk-cover>
                        </div>
                        <div class="uk-position-cover" uk-slideshow-parallax="opacity: 0,0,0.2; background-color: #000,#000"></div>
                        <div class="uk-position-center uk-position-medium uk-text-center">
                            <div uk-slideshow-parallax="scale: 1,1,0.8">
                                <h1 class="uk-heading-primary uk-visible@m" uk-slideshow-parallax="x: 200,0,0">{{ $lookbook->name }}</h1>
                                <h4 class="uk-hidden@m">{{ $lookbook->name }}</h4>
                                <p class="uk-text-lead uk-visible@m" uk-slideshow-parallax="x: 400,0,0;">{{ $lookbook->title }}</p>
                                <p class="uk-text-lead uk-visible@m" uk-slideshow-parallax="x: 400,0,0;">{{ $lookbook->subtitle }}</p>
                                <h5 class="uk-hidden@m uk-margin-remove uk-text-meta">{{ $lookbook->title }}</h5>
                                <h6 class="uk-hidden@m uk-margin-remove uk-text-meta">{{ $lookbook->subtitle }}</h6>
                            </div>
                        </div>
                    </li>
                </ul>
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
            </div>
            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>
        </div> --}}
        <div class="js-slideshow-animation" uk-slideshow="ratio: 7:3">
            <div class="uk-position-relative uk-visible-toggle uk-light">
                <ul class="uk-slideshow-items">
                    <li>
                        <video controls autoplay loop playsinline uk-cover="automute: false" uk-video="automute: false">
                            <source src="{{ config('common.video_slide2') }}" type="video/mp4">
                        </video>
                    </li>
                </ul>
            </div>
        </div>
        <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($lookbook->lookbookCollections as $post)
            <div class="uk-width-1-2 uk-inline">
                <div class="uk-inline uk-visible-toggle">
                    <div class="uk-inline-clip uk-light">
                        <a href="{{ URL::to('lookbook/'.$lookbook->slug.'/'.$post->slug)}}" class="uk-link-reset">
                            <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                            <img src="{{ uploadCDN($post->photo) }}" alt="{{$post->name}}" onerror="this.src = '{{imageCDN(config('common.default.image_4'))}}'">
                        </a>
                    </div>
                    <div class="uk-inline-clip uk-dark uk-position-cover uk-invisible-hover">
                        <a href="{{ URL::to('lookbook/'.$lookbook->slug.'/'.$post->slug)}}" class="uk-link-reset">
                            <div class="uk-position-cover uk-background-default"></div>
                            <img src="{{ uploadCDN($post->photo) }}" alt="{{$post->name}}" onerror="this.src = '{{imageCDN(config('common.default.image_4'))}}'">
                            <div class="uk-visible@m">
                                <div class="uk-position-top-left">
                                    <h4 class="uk-margin-remove">{{ $lookbook->name }}</h4>
                                    <h1 class="uk-margin-remove blog-title">{{$post->name}}</h1>
                                </div>
                            </div>
                            <div class="uk-hidden@m">
                                <div class="uk-card uk-position-bottom-left uk-card-small">
                                    <div class="uk-card-body">
                                        <div class="uk-hidden@m">
                                            <div>
                                                <h5 class="uk-margin-remove uk-text-bold uk-text-small">{{$post->name}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>

        <div class="uk-grid-small uk-margin-small-bottom">
            <div class="uk-panel uk-text-center">
                <a href="{{ url('/'.Request::segment(1)) }}"><button class="uk-button uk-button-default-warm uk-button-small"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</button></a>
            </div>
        </div>

    </div>
@endsection
