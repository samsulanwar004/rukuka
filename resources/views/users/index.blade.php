@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
	  <b>PERSONAL INFORMATION</b>
		<hr class="uk-margin-small">
	  <p>Welcome <b>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</b></p>
	</div>
</div>
</div>
@endsection
