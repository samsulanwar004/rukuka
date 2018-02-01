@extends('app')

@section('content')

<div class="uk-container uk-container-small">
  	<div class="uk-grid-small uk-margin-top uk-margin-bottom">
		<div>
			<div class="uk-card uk-card-default uk-card-large uk-card-body">

				<h3 class="uk-card-title uk-text-center">
				CHECK THE STATUS OF THE SHIPMENT
				</h3>

				<div class="uk-overflow-auto">
					<form class="form-horizontal" method="post" action="{{ route('tracking-result') }}">
		            	{{ csrf_field() }}
		            	<ul class="uk-list uk-text-center">
				            <li>
				                <input class="uk-input uk-form-width-medium " id="" type="text" placeholder="*Input your order code" required="required" name="order_code" value="">
				                <button class="uk-button uk-button-medium uk-button-secondary" type="submit">PROCESS</button>
				            </li>
				        </ul>
	                </form>
				</div>
				
				<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
					<div class="uk-panel uk-text-center">
						<a href="{{ route('index') }}"><button class="uk-button uk-button-secondary">Back To Home</button></a>
					</div>
				</div>
			</div>
		</div>
  	</div>

</div>
@endsection
