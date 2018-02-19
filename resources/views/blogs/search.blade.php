@extends('app-blog')
@section('title', $keyword.' '.trans('app.title_blog_search') )
@section('content')
    @if($status['code'] == '000')
    <div class="uk-container uk-container-small">
        <div class="uk-text-lead uk-text-uppercase uk-text-center">
            <h3 class="uk-margin-small">  {{ trans('app.search_result') }}:</h3>
        </div>
        <div class="uk-heading-line uk-text-lead uk-text-center blog-grey-text">
            <span>"{{$keyword}}"</span>
        </div>
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-1">
                <div class="uk-panel uk-text-right">
                    {{ Form::open(array('url' => 'search/blog', 'method' =>'get','files' => true,'class' => 'uk-search uk-form-width-medium uk-first-column')) }}
                    <button type="submit" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon></button>
                    <input type="text" class=" uk-search-input" name="keyword"  placeholder="{{ trans('app.search') }}">
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div id="blog" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($posts as $post)
              <div class="uk-width-1-3@m uk-width-1-2 uk-inline">
                  <div class="uk-inline">
                      <div class="uk-inline-clip uk-light">
                          <a href="{{ URL::to('blog/'.$post->slug)}}" class="uk-link-reset">
                              <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                                  <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                              <div class="uk-card uk-position-bottom-left uk-card-small">
                                  <div class="uk-card-body">
                                      <div class="uk-visible@m">
                                          <h1 class="uk-margin-remove uk-text-bold blog-subtitle">{{$post->title}}</h1>
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
              </div>
            @endforeach
        </div>
    </div>

    @else
        <div class="uk-container uk-container-small">
            <div class="uk-text-small uk-text-uppercase uk-text-center uk-margin-medium-top">
                <span>{{ trans('app.nothing_found') }}</span>
            </div>
            <div class="uk-text-large uk-text-center uk-margin-medium-bottom blog-grey-text">
                <span>{{$keyword}}</span>
            </div>
            <div class="uk-section uk-section-default uk-text-small uk-text-uppercase uk-section-small uk-text-center">
                <div><span>{{ trans('app.another_keyword') }}</span></div>
                <div>
                    {{ Form::open(array('url' => 'search/blog/','method' =>'get','files' => true,'class' => 'uk-search uk-search-large')) }}
                        <span style="color: #B4B4B4;" uk-search-icon></span>
                        <input style="font-size: xx-large;color: #B4B4B4;" class="uk-search-input" name="keyword" type="text" placeholder="Search...">
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    @endif


@endsection
