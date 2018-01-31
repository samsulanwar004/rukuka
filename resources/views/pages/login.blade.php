@extends('app')

@section('content')
<section class="uk-section uk-section-muted uk-section-xsmall">
<div class="uk-container">
  <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
  </div>
  @if($checkout)
    <h4 class="uk-margin-small-top uk-text-center">YOUR CHECKOUT PROCESS START HERE!</h4>
  @endif
  <div class="uk-flex uk-flex uk-flex-center" uk-grid>
    {{-- <div class="uk-width-4-5@m"> --}}
      {{-- <div class="uk-grid uk-margin-bottom" uk-grid> --}}
        <div class="uk-width-1-3@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-body">
              <h4>LOGIN</h4>
                <form class="form-horizontal" method="POST" action="{{ route('authenticate') }}">
                    {{ csrf_field() }}
                  <ul class="uk-list">
                    <li>
                        <input class="uk-input {{ $errors->has('email_login') ? ' uk-form-danger' : '' }}" id="form-s-email" type="email" placeholder="Email" required="required" name="email_login" value="{{ old('email_login') }}">
                    </li>
                    <li>
                        <input class="uk-input" id="form-s-password" type="password" placeholder="Password" required="required" name="password_login">
                    </li>
                    <li>
                        <div class="checkbox uk-text-meta">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </li>
                    <li>
                        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">LOGIN</button>
                    </li>

                    <li>
                      <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="uk-button uk-button-primary uk-width-1-1 uk-button-small">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: facebook"></span>Login with Facebook</a>
                    </li>
                    <li>
                      <a href="{{ route('social.login', ['provider' => 'google']) }}" class="uk-button uk-button-danger uk-width-1-1 uk-button-small">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: google"></span>Login with Google</a>
                    </li>
                    <li class="uk-text-right">
                        <a href="{{ route('page.forgot') }}" class="uk-text-meta"><i>forgot your password?</i></a>
                    </li>
                  </ul>
                </form>
            </div>
          </div>
        </div>
        <div class="uk-width-1-3@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-body">
              <h4>REGISTER</h4>
                  <!-- <h3>SIGN IN</h3> -->
                <form class="uk-form-stacked" action="{{ route('register') }}" method="POST">
                  {{ csrf_field() }}
                    <!-- <legend class="uk-legend">PERSONAL INFORMATION</legend> -->
                  <ul class="uk-list">
                    {{-- <li>Full Name</li> --}}
                    <li><input name="first_name" class="uk-input {{ $errors->has('first_name') ? ' uk-form-danger' : '' }}" type="text" placeholder="First Name" required="required" value="{{ old('first_name') }}"></li>
                    <li><input name="last_name" class="uk-input {{ $errors->has('last_name') ? ' uk-form-danger' : '' }}" type="text" placeholder="Last Name" required="required" value="{{ old('last_name') }}"></li>
                  </ul>
                  <ul class="uk-list">
                    <li class="uk-text-muted">Set Email and Password</li>
                    <li><input name="email" class="uk-input {{ $errors->has('email') ? ' uk-form-danger' : '' }}" id="email" type="email" placeholder="Email Address" required="required" value="{{ old('email') }}"></li>
                    <li><input name="password" class="uk-input {{ $errors->has('password') ? ' uk-form-danger' : '' }}" id="password" type="password" placeholder="Password" required="required"></li>
                    <li><input name="confirmed" class="uk-input {{ $errors->has('confirmed') ? ' uk-form-danger' : '' }}" id="confirmed" type="password" placeholder="Confirm Password" required="required"></li>
                  </ul>
                  <ul class="uk-list">
                    <li><input class="uk-checkbox" type="checkbox" name="subcriber" required="required" {{ old('subcriber') ? 'checked' : '' }}>
                    <span class="uk-text-meta">By clicking the "register" button, I agree to recieve ruKuKa news by e-mail, sms or telephone.
                    See our <a href="#">Privacy Policy</a> for further information.</span></li>
                    <li><button class="uk-button uk-button-secondary uk-width-1-1" type="submit">REGISTER</button></li>
                    <li>
                      <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="uk-button uk-button-primary uk-button-small uk-width-1-1">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: facebook"></span>Register with Facebook</a>
                    </li>
                    <li>
                      <a href="{{ route('social.login', ['provider' => 'google']) }}" class="uk-button uk-button-danger uk-width-1-1 uk-button-small">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: google"></span>Register with Google</a>
                    </li>
                  </ul>
                </form>
            </div>
          </div>
        </div>
        @if($checkout)
        <div class="uk-width-1-3@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-body">
              <h3>GUEST CHECKOUT</h3>
                <form class="form-horizontal" method="POST" action="{{ route('checkout.as.guest') }}">
                    {{ csrf_field() }}
                  <ul class="uk-list">
                    <li>
                        <input class="uk-input {{ $errors->has('email_guest') ? ' uk-form-danger' : '' }}" type="email" placeholder="Email" required="required" name="email_guest" value="{{ old('email_guest') }}">
                    </li>


                    <li>
                        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">continue</button>
                    </li>


                  </ul>
                </form>
            </div>
          </div>
        </div>
        @endif
      {{-- </div> --}}
    {{-- </div> --}}
  </div>
<hr>
</div>
</section>
@endsection
