@extends('app')
@section('title', trans('app.title_confirm') )
@section('content')

<div class="uk-container uk-container-large">
  	<div class="uk-grid-small uk-margin-top uk-margin-bottom uk-flex uk-flex-center">
      	<div class="uk-width-1-2@m ">
			<div class="uk-card uk-background-muted uk-box-shadow-small">
        		<div class="uk-card-body uk-text-center">
				<h3 class="uk-card-title uk-text-uppercase">
				{{ trans('app.confirm_result_title') }}
				</h3>
				<label class="uk-text-muted">{{ trans('app.confirm_result_text_1') }}</label>
				<h5 class="uk-text-muted uk-margin-remove-bottom">{{ trans('app.confirm_result_amount') }}</h5>
				<h3 class="uk-margin-remove-top">
					IDR {{ $amount }}
				</h3>
				<hr>
				<label class="uk-text-muted">{{ trans('app.confirm_result_text_2') }}</label><br>
				<label class="uk-text-muted">{{ trans('app.please') }}</label> <a href="/help/contact-us">{{ trans('app.contact_us') }} </a> {{ trans('app.confirm_contact_us') }}

				</div>
				<div class="uk-card-footer">
					<div class="uk-panel uk-text-center">
						<a href="{{ route('index') }}"><button class="uk-button uk-button-default uk-button-small"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</button></a>
					</div>
				</div>
			</div>
		</div>
  	</div>

</div>
@endsection
