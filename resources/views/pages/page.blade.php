@extends('app')

@section('content')

    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp

    @if($status['code'] == '000')
        <div class="uk-container uk-container-small uk-margin-large-top uk-margin-large-bottom">
            <h1>{!! $page[0]['title']!!}</h1>
            <div class="scroll">
                {!! $page[0]['content']!!}
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
