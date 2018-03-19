@extends('app_blog')
@section('title', $keyword.' '.trans('app.title_search') )
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
                {{ Form::open(array('url' => '/search', 'method' =>'get','files' => true,'class' => 'uk-search uk-form-width-medium uk-first-column')) }}
                <button type="submit" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon></button>
                <div>
                    <div class="typeahead__container">
                        <div class="typeahead__field">
                                <span class="typeahead__query">
                                    <input class="js-typeahead-designers" type="search" class=" uk-search-input" name="keyword" autocomplete="off" required placeholder="{{ trans('app.search') }}">
                                    <button type="submit" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon></button>
                                </span>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

        </div>
        <div class="uk-grid-small uk-margin-small-bottom uk-margin-large-top">
            <div class="uk-panel uk-text-center">
                <a href="{{ '/' }}"><button class="uk-button uk-button-default-warm uk-button-small"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</button></a>
            </div>
        </div>
    </div>

@endsection