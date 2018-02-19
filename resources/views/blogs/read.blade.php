@extends('app-blog')
@section('title', $posts[0]['title'].' '.trans('app.title_blog_read') )
@section('content')
    @if($status['code'] == '010')
    <div class="uk-container uk-container-small">

      <div class="uk-grid" uk-grid>
        <div class="uk-width-2-3@m">
          <h2 class="uk-margin-top">{{$posts[0]['title']}}</h2>
          {!! $posts[0]['content']!!}
          <p><h5> <i>rukuka.com , {{date_format($posts[0]['created_at'],"F j, Y")}}</i></h5></p>
          <hr>
        </div>
        <div class="uk-width-1-3@m uk-margin-top uk-margin-bottom">

            <div class="uk-panel uk-margin-top uk-margin-bottom">
                <div class="uk-card uk-card-border uk-card-small">
                    <div class="uk-card-body">
                        <div class="uk-visible@m">
                            <ul>
                                @foreach($category as $value)
                                   <a href="{{ URL::to('blog/category/'.$value->slug)}}"><h3>{{$value->name}}</h3></a>
                                @endforeach
                            </ul>
                        </div>
                        <div class="uk-hidden@m">
                            <ul class="uk-grid" uk-grid>
                                @foreach($category as $value)
                                    <a href="{{ URL::to('blog/category/'.$value->slug)}}"><h5>{{$value->name}}</h5></a>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="uk-visible@m">
                <h3>{{ trans('app.other_people') }}</h3>
            </div>
            <div class="uk-hidden@m">
                <h4>{{ trans('app.other_people') }}</h4>
            </div>
            @foreach($postsRandom as $post)
              <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-1-1@m uk-width-1-2 uk-inline">
                        <div class="uk-inline">
                        <div class="uk-inline-clip uk-transition-toggle uk-light">
                            <a href="{{ URL::to('blog/'.$post->slug)}}" class="uk-link-reset">
                                <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                                <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                                <div class="uk-card uk-position-bottom-left uk-card-small">
                                    <div class="uk-card-body">
                                        <div class="uk-transition-slide-left-small uk-visible@m">
                                            <h1 class="uk-margin-remove uk-text-bold blog-subtitle">{{$post->title}}</h1>
                                        </div>
                                        <div class="uk-hidden@m">
                                            <div class="uk-transition-slide-left-small">
                                                <h5 class="uk-margin-remove uk-text-bold uk-text-small">{{$post->title}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
              </div>
            @endforeach
        </div>
      </div>
        <div class="uk-grid-small uk-margin-small-bottom">
            <div class="uk-panel uk-text-center">
                <a href="{{ URL::previous() }}"><button class="uk-button uk-button-secondary">{{ trans('app.back_to_home') }}</button></a>
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
