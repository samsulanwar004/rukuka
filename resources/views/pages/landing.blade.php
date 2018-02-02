@extends('app')

@section('content')
<div class="uk-container uk-container-small">
  	<div class="uk-grid-small uk-margin-top">
    	@include('partials.alert')
  	</div>
  	<div class="uk-grid-small uk-margin-small-bottom uk-margin-medium-top uk-margin-xlarge-bottom">
	  <div class="uk-panel uk-text-center">
	    <a href="{{ route('index') }}"><button class="uk-button uk-button-secondary">{{ trans('app.back_to_home') }}</button></a>
	  </div>
	</div>
</div>
@endsection
