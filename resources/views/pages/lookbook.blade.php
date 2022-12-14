@extends('app_blog')
@section('title', trans('app.title_lookbook') )
@section('content')

    <div class="uk-container uk-container-small">
        @include('partials.category_blog')

        <div id="blog" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($lookbook as $post)
                <div class="uk-width-1-2 uk-inline">
                    <div class="uk-inline uk-visible-toggle">
                        <div class="uk-inline-clip uk-light">
                            <a href="{{ URL::to('lookbook/'.$post->slug)}}" class="uk-link-reset">
                                <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                                <img src="{{ uploadCDN($post->banner) }}" alt="{{$post->name}}" onerror="this.src = '{{imageCDN(config('common.default.image_4'))}}'">
                            </a>
                        </div>
                        <div class="uk-inline-clip uk-dark uk-position-cover uk-invisible-hover">
                            <a href="{{ URL::to('lookbook/'.$post->slug)}}" class="uk-link-reset">
                                <div class="uk-position-cover uk-background-default"></div>
                                <img src="{{ uploadCDN($post->banner) }}" alt="{{$post->name}}" onerror="this.src = '{{imageCDN(config('common.default.image_4'))}}'">
                                <div class="uk-visible@m">
                                    <div class="uk-position-top-left">
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

    </div>



@endsection
