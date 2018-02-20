@extends('app-blog')
@section('title', $posts['title'].' '.trans('app.title_blog_read') )
@section('content')
    @if($status['code'] == '010')
    <div class="uk-container uk-container-small">
      <div class="uk-grid uk-grid-small" uk-grid>
        <div class="uk-width-5-6@m">
          <h2 class="uk-margin-top">{{$posts['title']}}</h2>
          {!! $posts['content']!!}
          <p><h5> <i>rukuka.com , {{date_format($posts['created_at'],"F j, Y")}}</i></h5></p>
          <hr>
        </div>
        <div class="uk-width-1-6@m uk-margin-top uk-margin-bottom">
          <h5>{{ trans('app.other_people') }}</h5>
            <div class="uk-grid uk-grid-small" uk-grid>
            @foreach($postsRandom as $post)

                <div class="uk-width-1-1@m uk-width-1-2 uk-inline uk-position-relative">
                  <div class="uk-inline-clip uk-light">
                      <a href="{{ URL::to('blog/'.$post->slug)}}" class="uk-link-reset">
                          <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                          <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                          <div class="uk-card uk-position-bottom-left uk-card-small">
                              <div class="uk-card-body">
                                  <div class="uk-visible@m">
                                      <h5 class="uk-margin-remove uk-text-bold">{{$post->title}}</h5>
                                  </div>
                                  <div class="uk-hidden@m">
                                      <div>
                                          <h5 class="uk-margin-remove uk-text-bold uk-text-small">{{$post->title}}</h5>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>
                </div>

            @endforeach
            </div>
        </div>
      </div>
        <div class="uk-grid-small uk-margin-small-bottom">
            <div class="uk-panel uk-text-center">
                <a href="{{ URL::previous() }}"><button class="uk-button uk-button-default uk-button-small"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</button></a>
            </div>
        </div>

    </div>
    @else
        <div class="uk-container uk-container-small">
            <div class="uk-section uk-section-default uk-section-xlarge uk-text-center">
                <h1>{{ trans('app.no_content') }}</h1>
            </div>
        </div>
    @endif
@endsection
