@extends('app')
@section('title', trans('app.title_account') )
@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top uk-margin-bottom" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
	  <h4 class="uk-text-uppercase">{{ trans('app.personal_info') }}</h4>
	  <p>{{ trans('app.welcome') }} <b>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</b></p>
		<div class="uk-card uk-card-border">
			<div class="uk-card-body">
				<blockquote cite="#">
					{{ trans('app.personal_message') }}
				</blockquote>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
