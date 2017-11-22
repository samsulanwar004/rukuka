@extends('app-blog')

@section('content')
    @if($status['code'] == '010')
    <div class="uk-container uk-container-small">
      <h3 class="uk-margin-top">{{$posts[0]['title']}}</h3>
      <div class="uk-panel">
          {!! $posts[0]['content']!!}
      </div>
      <div class="uk-text-small uk-text-center uk-margin-large-top blog-grey-text">
          Ku Ka Indonesia, {{date_format($posts[0]['created_at'],"F j, Y")}}
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
