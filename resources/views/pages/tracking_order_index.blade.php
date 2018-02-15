@extends('app')
@section('title', trans('app.title_tracking') )
@section('content')

<div class="uk-container uk-container-small">
  	<div class="uk-grid-small uk-margin-top uk-margin-bottom">
		<div>
			<div class="uk-card uk-card-default uk-card-large uk-card-body">

				<h3 class="uk-card-title uk-text-center uk-text-uppercase">
				{{ trans('app.check_order') }}
				</h3>

				<div class="uk-overflow-auto">
					<form class="form-horizontal" method="post" action="{{ route('tracking-result') }}">
		            	{{ csrf_field() }}
		            	<ul class="uk-list uk-text-center">
							<label>{{ trans('app.input_title') }}</label>
							<li>
								<input class="uk-input uk-form-width-medium " type="text" placeholder="{{ trans('app.input_email') }}" required="required" name="email" value="">
							</li>
				            <li>
								<input class="uk-input uk-form-width-medium " type="text" placeholder="{{ trans('app.input_order') }}" required="required" name="order_code" value="">
				            </li>
							<li>
								<button class="uk-button uk-button-medium uk-button-secondary" type="submit">{{ trans('app.submit') }}</button>
							</li>
				        </ul>
	                </form>
				</div>
				
				<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
					<div class="uk-panel uk-text-center">
						<a href="{{ route('index') }}"><button class="uk-button uk-button-secondary">{{ trans('app.back_to_home') }}</button></a>
					</div>
				</div>
			</div>
		</div>
  	</div>

</div>
@endsection
