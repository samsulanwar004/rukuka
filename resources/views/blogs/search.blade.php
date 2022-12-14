@extends('app')
@section('title', $keyword.' '.trans('app.title_blog_search') )
@section('content')

    <div class="uk-container">
        @include('partials.category_blog')
        <div class="uk-text-lead uk-text-uppercase uk-text-center">
            <h3 class="uk-margin-small">  {{ trans('app.search_result') }}:</h3>
        </div>
        <div class="uk-heading-line uk-text-lead uk-text-center blog-grey-text">
            <span>"{{$keyword}}"</span>
        </div>
        <div id="blog" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($posts as $post)
              <div class="uk-width-1-2@m uk-width-1-2 uk-inline">
                <div class="uk-inline uk-visible-toggle">
                    <div class="uk-inline-clip uk-light">
                        <a href="{{ URL::to('editorial/'.$post->slug)}}" class="uk-link-reset">
                            <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                            <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                        </a>
                    </div>
                    <div class="uk-inline-clip uk-dark uk-position-cover uk-invisible-hover">
                      <a href="{{ URL::to('editorial/'.$post->slug)}}" class="uk-link-reset">
                          <div class="uk-position-cover uk-background-default"></div>
                              <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                                <div class="uk-visible@m">
                                    <div class="uk-position-top-left">
                                        <h1 class="uk-margin-remove blog-title">{{$post->title}}</h1>
                                    </div>
                                    <div class="uk-position-bottom-right">
                                        <h4 class="uk-text-muted">{{date_format($post['created_at'],"F j, Y")}}</h4>
                                    </div>
                                </div>
                          <div class="uk-hidden@m">
                              <div class="uk-card uk-position-bottom-left uk-card-small">
                                  <div class="uk-card-body">
                                      <div class="uk-hidden@m">
                                          <div>
                                              <h5 class="uk-margin-remove uk-text-bold uk-text-small">{{$post->title}}</h5>
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
