@extends('app')

@section('content')
<div class="uk-container uk-container-small">
  	<div class="uk-grid-small uk-margin-top">
    	@include('partials.alert')
  	</div>
  	    <form class="form-horizontal" method="POST" action="{{ route('reset') }}">
            {{ csrf_field() }}

          <ul class="uk-list uk-text-center uk-margin-large-bottom">
			  <h4>Please input your new password</h4>
          	<input type="hidden" name="token" value="{{ old('email', $code) }}">

            <li>
                <input name="password" class="uk-input uk-form-width-medium {{ $errors->has('password') ? ' uk-form-danger' : '' }}" id="password" type="password" placeholder="*PASSWORD" required="required">
            </li>

            <li>
            	<input name="confirmed" class="uk-input uk-form-width-medium {{ $errors->has('confirmed') ? ' uk-form-danger' : '' }}" id="confirmed" type="password" placeholder="*CONFIRM PASSWORD" required="required">
            </li>

            <li class="uk-margin-medium-top">
            	<button class="uk-button uk-button-secondary" type="submit">SUBMIT</button>
            </li>
          </ul>
        </form>
</div>
@endsection
