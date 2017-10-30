@extends('app')

@section('content')
<div class="uk-container uk-container-small">
  	<div class="uk-grid-small uk-margin-top">
    	@include('partials.alert')
  	</div>
  	    <form class="form-horizontal" method="POST" action="{{ route('forgot') }}">
            {{ csrf_field() }}
          <ul class="uk-list">
            <li>
                <input class="uk-input uk-form-width-medium {{ $errors->has('email') ? ' uk-form-danger' : '' }}" id="form-s-email" type="email" placeholder="*Email" required="required" name="email" value="{{ old('email') }}">
                <button class="uk-button uk-button-secondary" type="submit">SUBMIT</button>

            </li>
          </ul>
        </form>
  	<div class="uk-grid-small uk-margin-small-bottom uk-margin-medium-top uk-margin-xlarge-bottom">
	  <div class="uk-panel uk-text-center">
	    <a href="{{ route('index') }}"><button class="uk-button uk-button-secondary">Back To Home</button></a>
	  </div>
	</div>
</div>
@endsection
