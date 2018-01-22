@extends('app')

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

                  @include('partials.help-sidebar')

                  <div class="uk-width-3-4@m">
                      <div class="scroll">
                          <h3>{!! $page[0]['title'] !!}</h3>
                          {!! $page[0]['content']!!}
                      </div>

                      {{ Form::open(array('url' => '/contact','class' => 'uk-margin-small-top')) }}
                      <label>NAME</label>
                      <div class="uk-margin-small" uk-grid>
                          <div class="uk-width-1-3">
                              <select name="title" class="uk-select" required>
                                  <option value="" disabled selected>Title</option>
                                  <option value="Mr.">Mr.</option>
                                  <option value="Mrs.">Mrs</option>
                              </select>
                              <br/><span style="color:red">{{ $errors->first('title')}}</span>
                          </div>

                          <div class="uk-width-1-3">
                              <input name="first_name" value="{{ old('first_name') }}" required class="uk-input" type="text" placeholder="First Name">
                              <br/><span style="color:red">{{ $errors->first('first_name')}}</span>
                          </div>

                          <div class="uk-width-1-3">
                              <input name="last_name" value="{{ old('last_name') }}" required class="uk-input" type="text" placeholder="Last Name">
                              <br/><span style="color:red">{{ $errors->first('last_name')}}</span>
                          </div>
                      </div>

                      <div class="uk-margin-small uk-width-1-1">
                          <label>EMAIL</label>
                          <div class="uk-margin-bottom">
                              <input name="email" value="{{ old('email') }}" required class="uk-input" type="text" placeholder="Your Email Address">
                              <br/><span style="color:red">{{ $errors->first('email')}}</span>
                          </div>
                      </div>

                      <div class="uk-margin-small uk-width-1-1">
                          <label>SUBJECT</label>
                          <div class="uk-margin-bottom">
                              <input name="subject" value="{{ old('subject') }}" required class="uk-input" type="text" placeholder="Your Subject">
                              <br/><span style="color:red">{{ $errors->first('subject')}}</span>
                          </div>
                      </div>

                      <div class="uk-margin-small uk-width-1-1">
                          <label>MESSAGE</label>
                          <div class="uk-margin-bottom">
                              <textarea name="message" rows="5" required class="uk-textarea" placeholder="Your Message"> {{ old('message') }} </textarea>
                              <br/><span style="color:red">{{ $errors->first('message')}}</span>
                          </div>
                      </div>

                      {{ Form::submit('Submit', array('class' => 'uk-button uk-button-secondary uk-button-small uk-width-small'))}}
                      {{ Form::close() }}
                  </div>
              </div>
            </div>
          </div>

        </div>
@endsection
