@extends('app')

@section('content')

    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp

    <div class="uk-container uk-container-small uk-margin-large-top uk-margin-large-bottom">
        <h1>{!! $page['title']!!}</h1>
        <div class="scroll">
            {!! $page['content']!!}
        </div>
    </div>

@endsection
