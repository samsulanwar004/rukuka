@extends('app')

@section('content')
    <div class="uk-grid-small uk-margin-top">
        @include('partials.alert')
        <div class="uk-panel uk-text-center">
          <h2>PLEASE LOGIN OR REGISTER</h2>
        </div>
    </div>
  <div class="uk-grid-small uk-grid-divider uk-margin-top uk-margin-xlarge-bottom" uk-grid>
    <div class="uk-width-1-2@m">

      <div class="uk-panel uk-text-right">


      <h3>SIGN IN</h3>
        <form class="form-horizontal" method="POST" action="{{ route('authenticate') }}">
            {{ csrf_field() }}
          <ul class="uk-list">
            <li>
                <input class="uk-input uk-form-width-medium {{ $errors->has('email_login') ? ' uk-form-danger' : '' }}" id="form-s-email" type="email" placeholder="*Email" required="required" name="email_login" value="{{ old('email_login') }}">

            </li>
            <li>
                <input class="uk-input uk-form-width-medium" id="form-s-password" type="password" placeholder="*Password" required="required" name="password_login">

            </li>
            <li>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </li>
            <li>
                <button class="uk-button uk-button-secondary" type="submit">SIGN IN</button>
            </li>
            <li>
                <a href="#">forgot your password?</a>
            </li>
            <li>
              <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="uk-button uk-button-primary">
                <span class="uk-margin-small-right uk-icon" uk-icon="icon: facebook"></span>Login with Facebook</a>
            </li>
          </ul>
        </form>
    </div>


    </div>
    <div class="uk-width-1-2@m">
      <h3>REGISTER</h3>
      <div class="uk-grid-small" uk-grid>
          <div class="uk-panel">
          <!-- <h3>SIGN IN</h3> -->
          <form class="uk-form-stacked" action="{{ route('register') }}" method="POST">
            {{ csrf_field() }}
            <div class="uk-margin">
              <!-- <legend class="uk-legend">PERSONAL INFORMATION</legend> -->
              FULL NAME
              <div class="uk-margin-small uk-grid-small uk-child-width-1-2" uk-grid>
                  <div>
                      <input name="first_name" class="uk-input {{ $errors->has('first_name') ? ' uk-form-danger' : '' }}" type="text" placeholder="*FIRST NAME" required="required" value="{{ old('first_name') }}">
                  </div>
                  <div>
                      <input name="last_name" class="uk-input {{ $errors->has('last_name') ? ' uk-form-danger' : '' }}" type="text" placeholder="*LAST NAME" required="required" value="{{ old('last_name') }}">
                  </div>
              </div>
              PHONE NUMBER
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                      <input name="phone_number" class="uk-input {{ $errors->has('phone_number') ? ' uk-form-danger' : '' }}" id="form-s-tel" type="tel" placeholder="*PHONE NUMBER" required="required" value="{{ old('phone_number') }}">
                  </div>
                  <div class="uk-inline">
                    <a class="uk-icon-link" uk-icon="icon: question"></a>
                    <div uk-drop="pos: right-center">
                        <div class="uk-card uk-card-body uk-card-default uk-padding-small uk-text-small">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </div>
                    </div>
                  </div>
              </div>
              DATE OF BIRTH
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    <div uk-form-custom="target: > * > span:first">
                        <select class="uk-select uk-form-width-large" name="day" required="required">
                            <option value="">* DD </option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option {{ old('day') == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <span></span>
                            <span uk-icon="icon: chevron-down"></span>
                        </button>
                    </div>
                  </div>
                  <div>
                    <div uk-form-custom="target: > * > span:first">
                        <select class="uk-select uk-form-width-large" name="month" required="required">
                            <option value="">* MM</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option {{ old('month') == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <span></span>
                            <span uk-icon="icon: chevron-down"></span>
                        </button>
                    </div>
                  </div>
                  <div>
                    <div uk-form-custom="target: > * > span:first">
                        <select  class="uk-select uk-form-width-large" name="year" required="required">
                            <option value="">* YYYY</option>
                            @php
                                $yearNow = date('Y');
                                $start = $yearNow - 80;
                            @endphp
                            @for ($i = $start; $i <= $yearNow; $i++)
                                <option {{ old('year') == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <span></span>
                            <span uk-icon="icon: chevron-down"></span>
                        </button>
                    </div>
                  </div>

              </div>
              GENDER
              <div class="uk-margin-small uk-grid-small uk-margin-bottom" uk-grid>
                  <div>
                      <input class="uk-radio" type="radio" name="gender" value="m" required="required" {{ old('gender') == 'm' ? 'checked' : '' }}> Men
                      <input class="uk-radio" type="radio" name="gender" value="f" required="required" {{ old('gender') == 'f' ? 'checked' : '' }}> Women
                  </div>
              </div>
              <!-- <legend class="uk-legend">LOGIN INFORMATION</legend> -->
              SET USERNAME AND PASSWORD
              <div class="uk-margin-small uk-grid-small uk-margin-bottom">
                  <div class="uk-margin-bottom">
                    <input name="email" class="uk-input uk-form-width-medium {{ $errors->has('email') ? ' uk-form-danger' : '' }}" id="email" type="email" placeholder="*EMAIL ADDRESS" required="required" value="{{ old('email') }}">
                  </div>
                  <div class="uk-margin-bottom">
                    <input name="password" class="uk-input uk-form-width-medium {{ $errors->has('password') ? ' uk-form-danger' : '' }}" id="password" type="password" placeholder="*PASSWORD" required="required">
                  </div>
                  <div class="uk-margin-bottom">
                    <input name="confirmed" class="uk-input uk-form-width-medium {{ $errors->has('confirmed') ? ' uk-form-danger' : '' }}" id="confirmed" type="password" placeholder="*CONFIRM PASSWORD" required="required">
                  </div>
              </div>
              <!-- <legend class="uk-legend">COMMUNICATION PREFERENCES</legend> -->
              <div class="uk-margin-small uk-grid-small uk-margin-bottom" uk-grid>
                  <div>
                      <input class="uk-checkbox" type="checkbox" name="subcriber" required="required" {{ old('subcriber') ? 'checked' : '' }}>
                      By clicking the "register" button, I agree to recieve KuKa news by e-mail, sms or telephone.
                      See our <a href="#">Privacy Policy</a> for further information.
                  </div>
              </div>

            </div>
            <button class="uk-button uk-button-secondary" type="submit">REGISTER</button>

            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="uk-button uk-button-primary">
                <span class="uk-margin-small-right uk-icon" uk-icon="icon: facebook"></span>Register with Facebook</a>

            </form>
          </div>


      </div>

    </div>
  </div>
@endsection

