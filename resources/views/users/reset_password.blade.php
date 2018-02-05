@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
      <h4 class="uk-text-uppercase">{{ trans('app.edit_personal_password') }}</h4>

          <div class="uk-panel">
          <form class="uk-form-stacked" action="{{ route('user.reset.password') }}" method="post">
            {{ csrf_field() }}

            <div class="uk-margin">

                <label class="uk-text-uppercase"> {{ trans('app.old_password') }}</label>
              <div class="uk-margin-small uk-grid-small uk-margin-bottom">
                  <div class="uk-margin-bottom">
                    <input class="uk-input uk-form-width-medium" name="old_password" id="old-password" type="password" placeholder="*{{ trans('app.old_password') }}" required="required">
                  </div>

              </div>
                <label class="uk-text-uppercase">{{ trans('app.type_password') }}</label>
              <div class="uk-margin-small uk-grid-small uk-margin-bottom">
                  <div class="uk-margin-bottom">
                    <input class="uk-input uk-form-width-medium {{ $errors->has('password') ? ' uk-form-danger' : '' }}" name="new_password" id="new-password" type="password" placeholder="*{{ trans('app.new_password') }}" required="required">
                  </div>
                  <div class="uk-margin-bottom">
                    <input class="uk-input uk-form-width-medium {{ $errors->has('confirmed') ? ' uk-form-danger' : '' }}" name="confirmed" id="confirmed" type="password" placeholder="*{{ trans('app.confirm_new_password') }}" required="required">
                  </div>
              </div>

            </div>
            <button class="uk-button uk-button-secondary uk-text-uppercase uk-margin-bottom" type="submit">{{ trans('app.update_password') }}</button>
            </form>
          </div>

    </div>
</div>
</div>
@endsection
