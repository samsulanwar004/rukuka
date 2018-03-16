@extends('app_blog')
@section('title', $posts['title'].' '.trans('app.title_blog_read') )
@section('content')

    <div class="uk-container uk-container-small">
        <div class="uk-text-center uk-margin-small-top">
            <div class="uk-inline">
                <a href="{{ $home['homepage_main_url'] }}" class="uk-link-reset">
                    <div class="uk-inline-clip uk-transition-toggle uk-light">
                            <img src="{{ uploadCDN($posts['photo_2']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'">
                    </div>
                </a>
            </div>
        </div>
        <div class="uk-grid uk-grid-small">
        <div>
          <h2 class="uk-margin-top">{{$posts['title']}}</h2>
          <span class="blog-body">{!! $posts['content']!!}</span>
          <p><h5> <i>rukuka.com , {{date_format($posts['created_at'],"F j, Y")}}</i></h5></p>
          <hr>
        </div>
        <div class="uk-margin-top uk-margin-bottom">
          <h5>{{ trans('app.other_people') }}</h5>
            <div class="uk-grid uk-grid-small" uk-grid>
            @foreach($postsRandom as $post)
                <div class="uk-width-1-3@m uk-inline uk-position-relative">
                  <div class="uk-inline uk-visible-toggle">
                      <div class="uk-inline-clip uk-light">
                          <a href="{{ URL::to('editorial/'.$post->slug)}}" class="uk-link-reset">
                              <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                                  <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                              <div class="uk-card uk-position-bottom-left uk-card-small">
                                  <div class="uk-card-body">
                                      <div class="uk-hidden@m">
                                          <div>
                                              <h5 class="uk-margin-remove uk-text-bold uk-text-small">{{$post->title}}</h5>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </a>
                      </div>
                      <div class="uk-inline-clip uk-dark uk-position-cover uk-invisible-hover">
                        <a href="{{ URL::to('editorial/'.$post->slug)}}" class="uk-link-reset">
                            <div class="uk-position-cover uk-background-default"></div>
                                <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                                  <div class="uk-visible@m">
                                      <div class="uk-position-top-left">
                                        <h4 class="uk-margin-remove">{{$post->category->name}}</h4>
                                          <h1 class="uk-margin-remove blog-title">{{$post->title}}</h1>
                                      </div>
                                      <div class="uk-position-bottom-right">
                                          <span class="uk-text-muted"><u>{{date_format($post['created_at'],"F j, Y")}}</u></span>
                                      </div>
                                  </div>
                                    <div class="uk-hidden@m">
                                        <div class="uk-position-bottom-left">
                                            <h4 class="uk-margin-remove uk-text-bold uk-text-small"><u>{{$post->title}}</u></h4>
                                        </div>
                                    </div>
                        </a>
                      </div>

                  </div>
                </div>

            @endforeach
            </div>
        </div>
      </div>
        <div class="uk-grid-small uk-margin-small-bottom">
            <div class="uk-panel uk-text-center">
                <a href="{{ URL::previous() }}"><button class="uk-button uk-button-default-warm uk-button-small"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</button></a>
            </div>
        </div>
    </div>

@endsection
