@extends('app-blog')

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
                <h3>Other people also read</h3>
            </div>
            <div class="uk-hidden@m">
                <h4>Other people also read</h4>
            </div>
            @foreach($postsRandom as $post)
              <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-1-1@m uk-width-1-3 uk-inline">
                        <div class="uk-inline">
                        <div class="uk-inline-clip uk-transition-toggle uk-light">
                            <a href="{{ URL::to('blog/'.$post->slug)}}" class="uk-link-reset">
                                <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                                <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_2'))}}'">
                                <div class="uk-card uk-position-bottom-left uk-card-small">
                                    <div class="uk-card-body">
                                      <div class="uk-visible@m">
                                        <div class="uk-transition-slide-left-small">
                                            <h1 class="uk-margin-remove uk-text-bold blog-subtitle">{{$post->title}}</h1>
                                        </div>
                                      </div>
                                      <div class="uk-hidden@m">
                                        <div>
                                            <span class="uk-margin-remove uk-text-small uk-light">{{$post->title}}</span>
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


    </div>
    @else
        <div class="uk-container uk-container-small">
            <div class="uk-section uk-section-default uk-section-xlarge uk-text-center">
                <h1>No Content</h1>
            </div>
        </div>
    @endif
@endsection
