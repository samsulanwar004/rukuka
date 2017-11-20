@extends('app-blog')

@section('content')

    @if($status['code'] == '000')
    <div class="uk-container uk-container-small">
        <div class="uk-text-lead uk-text-uppercase uk-text-center uk-margin-medium-top"><span>search results for:</span></div>
        <div class="uk-heading-line uk-text-lead uk-text-center uk-margin-medium-bottom"><span>{{$title}}</span></div>
        <div id="blog" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($posts as $post)
                <div class="uk-width-1-3@m uk-width-1-2@s uk-inline">
                    <div class="uk-inline">
                        <div class="uk-inline-clip uk-transition-toggle uk-light">
                            <a href="{{ URL::to('blog/'.$post->slug)}}" class="uk-link-reset">
                                @if(count($post->photo_1))
                                    <img src="/{{ $post->photo_1 }}" alt="{{$post->title}}">
                                @else
                                    {{ Html::image("images/blog-default.jpg") }}
                                @endif
                                <div class="uk-card uk-position-bottom-left uk-card-small">
                                    <div class="uk-card-body">
                                        <div class="uk-transition-slide-left-small">
                                            <h1 class="uk-margin-remove uk-text-bold blog-heading">{{$post->title}}</h1>
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
                <span>Sorry, Nothing Found.</span>
            </div>
            <div class="uk-text-large uk-text-center uk-margin-medium-bottom blog-grey-text">
                <span>{{$keyword}}</span>
            </div>
            <div class="uk-section uk-section-default uk-text-small uk-text-uppercase uk-section-small uk-text-center">
                <div><span>try searching with other keywords</span></div>
                <div>
                    {{ Form::open(array('url' => '/blog/search','files' => true,'class' => 'uk-search uk-search-large')) }}
                        <span style="color: #B4B4B4;" uk-search-icon></span>
                        <input style="font-size: xx-large;color: #B4B4B4;" class="uk-search-input" name="search" type="text" placeholder="Search...">
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    @endif


@endsection

