@extends('app')
@section('title', trans('app.title_login') )
@section('content')
<section class="uk-section uk-section-xsmall uk-background-norepeat uk-background-image@m uk-background-top-right" style=" background-color:#dadada; background-size: 400px">
<div class="uk-container">
  <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
  </div>
  @if($checkout)
    <h4 class="uk-margin-small-top uk-text-center uk-text-uppercase">{{ trans('app.checkout_text') }}</h4>
  @endif
  <div class="uk-flex uk-flex uk-flex-center" uk-grid>
    {{-- <div class="uk-width-4-5@m"> --}}
      {{-- <div class="uk-grid uk-margin-bottom" uk-grid> --}}
        <div class="uk-width-1-3@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-body">
              <h4>{{ trans('app.login') }}</h4>
                <form class="form-horizontal" method="POST" action="{{ route('authenticate') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="return_url" value="{{ $ref }}">
                  <ul class="uk-list">
                    <li>
                        <input class="uk-input {{ $errors->has('email_login') ? ' uk-form-danger' : '' }}" id="form-s-email" type="email" placeholder="{{ trans('app.email') }}" required="required" name="email_login" value="{{ old('email_login') }}">
                    </li>
                    <li>
                        <input class="uk-input" id="form-s-password" type="password" placeholder="{{ trans('app.password') }}" required="required" name="password_login">
                    </li>
                    <li>
                        <div class="checkbox uk-text-meta">
                          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('app.remember') }}
                        </div>
                    </li>
                    <li>
                        <button class="uk-button uk-button-secondary uk-width-1-1 uk-text-uppercase" type="submit">{{ trans('app.login') }}</button>
                    </li>

                    <li>
                      <a href="{{ route('social.login', ['provider' => 'facebook', 'return_url' => $ref]) }}" class="uk-button uk-button-primary uk-width-1-1 uk-button-small">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: facebook"></span>{{ trans('app.login_facebook') }}</a>
                    </li>
                    <li>
                      <a href="{{ route('social.login', ['provider' => 'google', 'return_url' => $ref]) }}" class="uk-button uk-button-danger uk-width-1-1 uk-button-small">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: google"></span> {{ trans('app.login_google') }} </a>
                    </li>
                    <li class="uk-text-right">
                        <a href="{{ route('page.forgot') }}" class="uk-text-meta"><i>{{ trans('app.forgot_password') }}</i></a>
                    </li>
                  </ul>
                </form>
            </div>
          </div>
        </div>
        <div class="uk-width-1-3@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-body">
              <h4>{{ trans('app.register') }}</h4>
                <form class="uk-form-stacked" action="{{ route('register') }}" method="POST">
                  {{ csrf_field() }}
                  <ul class="uk-list">
                    <li><input name="first_name" class="uk-input {{ $errors->has('first_name') ? ' uk-form-danger' : '' }}" type="text" placeholder="{{ trans('app.first_name') }}" required="required" value="{{ old('first_name') }}"></li>
                    <li><input name="last_name" class="uk-input {{ $errors->has('last_name') ? ' uk-form-danger' : '' }}" type="text" placeholder="{{ trans('app.last_name') }}" required="required" value="{{ old('last_name') }}"></li>
                  </ul>
                  <ul class="uk-list">
                    <li class="uk-text-muted">{{ trans('app.set_email_password') }}</li>
                    <li><input name="email" class="uk-input {{ $errors->has('email') ? ' uk-form-danger' : '' }}" id="email" type="email" placeholder="{{ trans('app.email') }}" required="required" value="{{ old('email') }}"></li>
                    <li><input name="password" class="uk-input {{ $errors->has('password') ? ' uk-form-danger' : '' }}" id="password" type="password" placeholder="{{ trans('app.password') }}" required="required"></li>
                    <li><input name="confirmed" class="uk-input {{ $errors->has('confirmed') ? ' uk-form-danger' : '' }}" id="confirmed" type="password" placeholder="{{ trans('app.confirm_password') }}" required="required"></li>
                  </ul>
                  <ul class="uk-list">
                    <li><input class="uk-checkbox" type="checkbox" name="subcriber" required="required" {{ old('subcriber') ? 'checked' : '' }}>
                    <span class="uk-text-meta">{{ trans('app.agreement_text_1') }}
                      {{--{{ trans('app.agreement_text_2') }} <a href="/page/terms-privacy">{{ trans('app.terms_privacy') }} {{ trans('app.agreement_text_3') }}</a> --}}
                    </span>
                    </li>
                    <li><button class="uk-button uk-button-secondary uk-width-1-1 uk-text-uppercase" type="submit">{{ trans('app.register') }}</button></li>
                    <li>
                      <a href="{{ route('social.login', ['provider' => 'facebook', 'return_url' => $ref]) }}" class="uk-button uk-button-primary uk-button-small uk-width-1-1">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: facebook"></span>{{ trans('app.login_facebook') }}</a>
                    </li>
                    <li>
                      <a href="{{ route('social.login', ['provider' => 'google', 'return_url' => $ref]) }}" class="uk-button uk-button-danger uk-width-1-1 uk-button-small">
                        <span class="uk-margin-small-right uk-icon" uk-icon="icon: google"></span>{{ trans('app.login_google') }}</a>
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
</div>
</section>
@endsection
