@extends('app')

@section('content')

<div class="uk-container uk-container-small">
  	<div class="uk-grid-small uk-margin-top uk-margin-bottom">
		<div>
			<div class="uk-card uk-card-default uk-card-large uk-card-body">
				@if($resultTrackAndTrace['error'] != '000')

					<h3 class="uk-card-title uk-text-center">
						{{ $resultTrackAndTrace['message'] }}
					</h3>

				@else

					<h3 class="uk-card-title uk-text-center">
					THE STATUS OF THE SHIPMENT
					</h3>

					<div class="uk-overflow-auto">
						<table class="uk-table uk-table-small uk-table-divider">
							<thead>
							<tr>
								<th class="uk-table-small">The Shipment</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>Barcode</td>
								<td>{{ $resultTrackAndTrace['data']['order']->airwaybill }}</td>
							</tr>
							<tr>
								<td>From</td>
								<td>ID </td>
							</tr>
							<tr>
								<td>To</td>
								<td>{{ $resultTrackAndTrace['data']['order']->address->country }}</td>
							</tr>
							</tbody>
						</table>
					</div>
					
					<div class="uk-overflow-auto">
						<table class="uk-table uk-table-small uk-table-striped ">
							<thead>
							<tr>
								<th class="uk-table-small">Detail Status</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<th>No</th>
								<th>Office</th>
								<th>Date</th>
								<th>Time</th>
								<th>Status</th>
							</tr>
							
							@foreach ($resultTrackAndTrace['data']['tracking'] as $key => $trackingData)
							    <tr>
									<td>{{++$key}}</td>
									<td>{{$trackingData->office}}</td>
									<td>{{explode(' ', $trackingData->eventDate)[0]}}</td>
									<td>{{explode(' ', $trackingData->eventDate)[1]}}</td>
									<td>{{$trackingData->eventName}}</td>
								</tr>
							@endforeach

							</tbody>
						</table>
					</div>

				@endif
				
				@if(\Request::route()->getName() == 'result-track-and-trace-order-guest')
					
					<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
						<div class="uk-panel uk-text-center">
							<a href="{{ route('show-track-and-trace-order-guest') }}">#Click here to Input other orde code</a>
						</div>
					</div>

					<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
						<div class="uk-panel uk-text-center">
							<a href="{{ route('index') }}"><button class="uk-button uk-button-secondary">Back To Home</button></a>
						</div>
					</div>
				
				@else
					
					<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
						<div class="uk-panel uk-text-center">
							<a href="{{ url('account/history') }}">#Click here back to history</a>
						</div>
					</div>

					<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
						<div class="uk-panel uk-text-center">
							<a href="{{ route('index') }}"><button class="uk-button uk-button-secondary">Back To Home</button></a>
						</div>
					</div>

				@endif

				
			</div>
		</div>
  	</div>

</div>
@endsection
