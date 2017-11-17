@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
      <b>EDIT PERSONAL PASSWORD</b>
			<hr class="uk-margin-small">
      <div class="uk-grid-small" uk-grid>
          <div class="uk-panel">
          <!-- <h3>SIGN IN</h3> -->
          <form class="uk-form-stacked" action="{{ route('user.reset.password') }}" method="post">
            {{ csrf_field() }}

            <div class="uk-margin">

              OLD PASSWORD
              <div class="uk-margin-small uk-grid-small uk-margin-bottom">
                  <div class="uk-margin-bottom">
                    <input class="uk-input uk-form-width-medium" name="old_password" id="old-password" type="password" placeholder="*OLD PASSWORD" required="required">
                  </div>

              </div>
              TYPE NEW PASSWORD
              <div class="uk-margin-small uk-grid-small uk-margin-bottom">
                  <div class="uk-margin-bottom">
                    <input class="uk-input uk-form-width-medium {{ $errors->has('password') ? ' uk-form-danger' : '' }}" name="new_password" id="new-password" type="password" placeholder="*NEW PASSWORD" required="required">
                  </div>
                  <div class="uk-margin-bottom">
                    <input class="uk-input uk-form-width-medium {{ $errors->has('confirmed') ? ' uk-form-danger' : '' }}" name="confirmed" id="confirmed" type="password" placeholder="*CONFIRM NEW PASSWORD" required="required">
                  </div>
              </div>

            </div>
            <button class="uk-button uk-button-secondary" type="submit">UPDATE PASSWORD</button>

            </form>
          </div>


      </div>
    </div>
</div>
</div>
@endsection
