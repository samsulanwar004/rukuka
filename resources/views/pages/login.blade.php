@extends('app')

@section('content')
<div class="uk-container uk-container-small">
  <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
  </div>
  <div class="uk-flex uk-flex">
    <div class="uk-width-4-5@m">
      <div class="uk-grid uk-margin-top uk-margin-xlarge-bottom" uk-grid>
        <div class="uk-width-1-2@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-body">
              <h3>LOGIN</h3>
                <form class="form-horizontal" method="POST" action="{{ route('authenticate') }}">
                    {{ csrf_field() }}
                  <ul class="uk-list">
                    <li>
                        <input class="uk-input {{ $errors->has('email_login') ? ' uk-form-danger' : '' }}" id="form-s-email" type="email" placeholder="*Email" required="required" name="email_login" value="{{ old('email_login') }}">
                    </li>
                    <li>
                        <input class="uk-input" id="form-s-password" type="password" placeholder="*Password" required="required" name="password_login">
                    </li>
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </li>
                    <li>
                        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">LOGIN</button>
                    </li>
                    <li>
                        <a href="{{ route('page.forgot') }}" class="uk-text-danger"><i>forgot your password?</i></a>
                    </li>
                    <li>
                      <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="uk-button uk-button-primary uk-width-1-1 uk-button-small">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: facebook"></span>Login with Facebook</a>
                    </li>
                  </ul>
                </form>
            </div>
          </div>
        </div>
        <div class="uk-width-1-2@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-body">
              <h3>REGISTER</h3>
                  <!-- <h3>SIGN IN</h3> -->
                <form class="uk-form-stacked" action="{{ route('register') }}" method="POST">
                  {{ csrf_field() }}
                    <!-- <legend class="uk-legend">PERSONAL INFORMATION</legend> -->
                  <ul class="uk-list">
                    <li>Full Name</li>
                    <li><input name="first_name" class="uk-input {{ $errors->has('first_name') ? ' uk-form-danger' : '' }}" type="text" placeholder="*FIRST NAME" required="required" value="{{ old('first_name') }}"></li>
                    <li><input name="last_name" class="uk-input {{ $errors->has('last_name') ? ' uk-form-danger' : '' }}" type="text" placeholder="*LAST NAME" required="required" value="{{ old('last_name') }}"></li>
                  </ul>
                  <ul class="uk-list">
                    <li>Set Username and Password</li>
                    <li><input name="email" class="uk-input {{ $errors->has('email') ? ' uk-form-danger' : '' }}" id="email" type="email" placeholder="*EMAIL ADDRESS" required="required" value="{{ old('email') }}"></li>
                    <li><input name="password" class="uk-input {{ $errors->has('password') ? ' uk-form-danger' : '' }}" id="password" type="password" placeholder="*PASSWORD" required="required"></li>
                    <li><input name="confirmed" class="uk-input {{ $errors->has('confirmed') ? ' uk-form-danger' : '' }}" id="confirmed" type="password" placeholder="*CONFIRM PASSWORD" required="required"></li>
                  </ul>
                  <ul class="uk-list">
                    <li><input class="uk-checkbox" type="checkbox" name="subcriber" required="required" {{ old('subcriber') ? 'checked' : '' }}>
                    <span class="uk-text-meta">By clicking the "register" button, I agree to recieve KuKa news by e-mail, sms or telephone.
                    See our <a href="#">Privacy Policy</a> for further information.</span></li>
                    <li><button class="uk-button uk-button-secondary uk-width-1-1" type="submit">REGISTER</button></li>
                    <li><a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="uk-button uk-button-primary uk-button-small uk-width-1-1">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: facebook"></span>Register with Facebook</a></li>
                  </ul>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
