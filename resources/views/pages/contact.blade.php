@extends('app')
@section('title', trans('app.title_contact') )
@section('content')

    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp

        <div class="uk-container uk-container-small uk-margin-top uk-margin-large-bottom">
            <div class="uk-grid-small uk-text-left">
                @include('partials.alert')
            </div>
          <div class="uk-flex uk-flex-center">
            <div class="uk-width-4-5@m">

              <div class="uk-text-justify uk-navbar-dropdown-grid uk-child-width-1-2" uk-grid>

                  @include('partials.help_sidebar')

                  <div class="uk-width-3-4@m">
                      <div class="scroll">
                          <h3>{!! $page['title'] !!}</h3>
                          {!! $page['content']!!}
                      </div>

                      {{ Form::open(array('url' => '/contact','class' => 'uk-margin-small-top')) }}
                      <label class="uk-text-uppercase">{{ trans('app.name') }}</label>
                      <div class="uk-margin-small" uk-grid>
                          <div class="uk-width-1-3">
                              <select name="title" class="uk-select" required>
                                  <option value="" disabled selected>{{ trans('app.title') }}</option>
                                  <option value="Mr.">Mr.</option>
                                  <option value="Mrs.">Mrs</option>
                              </select>
                              <br/><span style="color:red">{{ $errors->first('title')}}</span>
                          </div>

                          <div class="uk-width-1-3">
                              <input name="first_name" value="{{ old('first_name') }}" required class="uk-input" type="text" placeholder="{{ trans('app.first_name') }}">
                              <br/><span style="color:red">{{ $errors->first('first_name')}}</span>
                          </div>

                          <div class="uk-width-1-3">
                              <input name="last_name" value="{{ old('last_name') }}" required class="uk-input" type="text" placeholder="{{ trans('app.last_name') }}">
                              <br/><span style="color:red">{{ $errors->first('last_name')}}</span>
                          </div>
                      </div>

                      <div class="uk-margin-small uk-width-1-1">
                          <label class="uk-text-uppercase">{{ trans('app.email') }}</label>
                          <div class="uk-margin-bottom">
                              <input name="email" value="{{ old('email') }}" required class="uk-input" type="text" placeholder="{{ trans('app.email') }}">
                              <br/><span style="color:red">{{ $errors->first('email')}}</span>
                          </div>
                      </div>

                      <div class="uk-margin-small uk-width-1-1">
                          <label class="uk-text-uppercase">{{ trans('app.subject') }}</label>
                          <div class="uk-margin-bottom">
                              <input name="subject" value="{{ old('subject') }}" required class="uk-input" type="text" placeholder="{{ trans('app.subject') }}">
                              <br/><span style="color:red">{{ $errors->first('subject')}}</span>
                          </div>
                      </div>

                      <div class="uk-margin-small uk-width-1-1">
                          <label class="uk-text-uppercase">{{ trans('app.message') }}</label>
                          <div class="uk-margin-bottom">
                              <textarea name="message" rows="5" required class="uk-textarea" placeholder="{{ trans('app.message') }}"> {{ old('message') }} </textarea>
                              <br/><span style="color:red">{{ $errors->first('message')}}</span>
                          </div>
                      </div>

                      {{ Form::submit(trans('app.submit'), array('class' => 'uk-button uk-button-secondary uk-button-small uk-width-small'))}}
                      {{ Form::close() }}
                  </div>
              </div>
            </div>
          </div>

        </div>
@endsection
