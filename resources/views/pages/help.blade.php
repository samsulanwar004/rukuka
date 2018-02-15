@extends('app')
@section('title', $page['title'].' '.trans('app.title_helps') )
@section('content')

    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp

        <div class="uk-container uk-container-small uk-margin-top uk-margin-large-bottom">
          <div class="uk-flex uk-flex-center">
            <div class="uk-width-4-5@m">

              <div class="uk-text-justify uk-navbar-dropdown-grid uk-child-width-1-2" uk-grid>

                  @include('partials.help-sidebar')

                  <div class="uk-width-3-4@m">
                      <div class="scroll">
                          <h3>{!! $page['title'] !!}</h3>
                          {!! $page['content']!!}
                      </div>
                  </div>
              </div>
            </div>
          </div>

        </div>
@endsection
