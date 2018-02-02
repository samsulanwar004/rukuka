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

					<h3 class="uk-card-title uk-text-center uk-text-uppercase">
					{{ trans('app.status_shipment') }}
					</h3>

					<div class="uk-overflow-auto">
						<table class="uk-table uk-table-small uk-table-divider">
							<thead>
							<tr>
								<th class="uk-table-small"><b>{{ trans('app.the_shipment') }}</b></th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>{{ trans('app.barcode') }}</td>
								<td>{{ $resultTrackAndTrace['data']['order']->airwaybill }}</td>
							</tr>
							<tr>
								<td>{{ trans('app.from') }}</td>
								<td>ID </td>
							</tr>
							<tr>
								<td>{{ trans('app.to') }}</td>
								<td>{{ $resultTrackAndTrace['data']['order']->address->country }}</td>
							</tr>
							</tbody>
						</table>
					</div>
					
					<div class="uk-overflow-auto">
						<table class="uk-table uk-table-small uk-table-striped ">
							<thead>
							<tr>
								<th class="uk-table-small"><b>{{trans('app.detail_status')}}</b></th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<th>{{trans('app.no')}}</th>
								<th>{{trans('app.office')}}</th>
								<th>{{trans('app.date')}}</th>
								<th>{{trans('app.time')}}</th>
								<th>{{trans('app.status')}}</th>
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

				@if(\Request::route()->getName() == 'tracking-result')

					<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
						<div class="uk-panel uk-text-center">
							<a href="{{ route('tracking-page') }}"><button class="uk-button uk-button-secondary">{{ trans('app.back_to_tracking') }}</button></a>
							<a href="{{ route('index') }}"><button class="uk-button uk-button-secondary">{{ trans('app.back_to_home') }}</button></a>
						</div>
					</div>
				
				@else
					<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
						<div class="uk-panel uk-text-center">
							<a href="{{ url('account/history') }}"><button class="uk-button uk-button-secondary">{{ trans('app.back_to_history') }}</button></a>
						</div>
					</div>
				@endif
			</div>
		</div>
  	</div>

</div>
@endsection
