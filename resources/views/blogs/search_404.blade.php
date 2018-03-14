@extends('app_blog')
@section('title', trans('app.title_blog') )
@section('content')

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
                {{ Form::open(array('url' => 'search/editorial/','method' =>'get','files' => true,'class' => 'uk-search uk-search-large')) }}
                <span style="color: #B4B4B4;" uk-search-icon></span>
                <input style="font-size: xx-large;color: #B4B4B4;" class="uk-search-input" name="keyword" type="text" placeholder="Search...">
                {{ Form::close() }}
            </div>

        </div>
        <div class="uk-grid-small uk-margin-small-bottom">
            <div class="uk-panel uk-text-center">
                <a href="{{ '/editorial' }}"><button class="uk-button uk-button-default-warm uk-button-small"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</button></a>
            </div>
        </div>
    </div>

@endsection