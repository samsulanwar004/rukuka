@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top uk-margin-bottom" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
	  <b>PERSONAL INFORMATION</b>
		<hr class="uk-margin-small">
	  <p>Welcome <b>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</b></p>
		<div class="uk-card uk-card-border">
			<div class="uk-card-body">
				<blockquote cite="#">
					We are excited for you to coming back here to rukuka, hopefully we can serve outfit as good as you want, and give inspirational everyday.
				</blockquote>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
