@extends('app')
@section('title', trans('app.title_blog') )
@section('content')

    <div class="uk-container">
        @include('partials.category_blog')
        <div class="uk-section uk-section-default uk-section-xlarge uk-text-center">
            <h2>{{ trans('app.no_content') }}</h2>
        </div>
    </div>

@endsection
