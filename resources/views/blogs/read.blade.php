@extends('app-blog')

@section('content')
    @if($status['code'] == '010')
    <div class="uk-container uk-container-small">
        <div class="uk-section uk-section-default uk-section-large">
            <div class="scroll">
                {!! $posts[0]['content']!!}
            </div>
            <div class="uk-text-small uk-text-center uk-margin-large-top blog-grey-text">
                Ku Ka Indonesia, {{date_format($posts[0]['created_at'],"F j, Y")}}
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

