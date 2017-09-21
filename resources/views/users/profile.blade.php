@extends('app')

@section('content')
  	<div class="uk-grid-small uk-margin-top">
    	@include('partials.alert')
  	</div>
  	<div class="uk-grid-small uk-margin-small-bottom uk-margin-medium-top uk-margin-xlarge-bottom">
	  <div class="uk-panel uk-text-center">
	    <a href="{{ route('logout') }}"><button class="uk-button uk-button-secondary">Logout</button></a>
	  </div>
	</div>
@endsection

