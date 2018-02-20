@extends('app')
@section('title', trans('app.title_tracking') )
@section('content')

<div class="uk-container uk-container-small">
  	<div class="uk-grid-small uk-margin-top uk-margin-bottom uk-flex uk-flex-center">
      <div class="uk-width-1-2@m ">


			<div class="uk-card uk-background-muted uk-box-shadow-small">
        <div class="uk-card-body">
				<h3 class="uk-card-title uk-text-center uk-text-uppercase">
				{{ trans('app.check_order') }}
				</h3>

				<div class="uk-overflow-auto">
					<form class="form-horizontal" method="post" action="{{ route('tracking-result') }}">
		            	{{ csrf_field() }}
		            	<ul class="uk-list uk-text-center">
							<label class="uk-text-muted">{{ trans('app.input_title') }}</label>
							<li>
								<input class="uk-input" type="text" placeholder="{{ trans('app.input_email') }}" required="required" name="email" value="">
							</li>
				            <li>
								<input class="uk-input" type="text" placeholder="{{ trans('app.input_order') }}" required="required" name="order_code" value="">
				            </li>
							<li>
								<button class="uk-button uk-button-medium uk-button-secondary uk-width-1-1" type="submit">{{ trans('app.submit') }}</button>
							</li>
				        </ul>
	                </form>
				</div>


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
