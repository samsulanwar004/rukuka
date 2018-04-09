@extends('app')
@section('title', trans('app.title_confirm') )
@section('content')

<div class="uk-container">
  	<div class="uk-grid-small uk-margin-top uk-margin-bottom uk-flex uk-flex-center">
      	<div class="uk-width-1-2@m ">
			<div class="uk-card uk-background-muted uk-box-shadow-small">
        		<div class="uk-card-body uk-text-center">
				<h3 class="uk-card-title uk-text-uppercase">
				{{ trans('app.confirm_result_title') }}
				</h3>
				<label class="uk-text-muted">{{ trans('app.confirm_result_text_1') }}</label>
				<h5 class="uk-margin-remove-bottom">{{ trans('app.confirm_result_amount') }}</h5>
				<h3 class="uk-margin-remove-top">
					IDR. {{ number_format($amount,2) }}
				</h3>
				<hr>
				{{ trans('app.confirm_result_text_2') }}<br>
				{{ trans('app.please') }} <a href="/help/contact-us" class="uk-text-primary">{{ trans('app.contact_us') }} </a> {{ trans('app.confirm_contact_us') }}

				</div>
				<div class="uk-card-footer">
					<div class="uk-panel uk-text-center">
						<a href="{{ route('index') }}" class="uk-button-text uk-button"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</a>
					</div>
				</div>
			</div>
		</div>
  	</div>

</div>
@endsection
