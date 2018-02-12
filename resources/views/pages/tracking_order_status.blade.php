@extends('app')

@section('content')

<div class="uk-container uk-container-small">
  	<div class="uk-grid-small uk-margin-top uk-margin-bottom">
		<div>
			<div class="uk-card uk-card-default uk-card-large uk-card-body">
				@if($tracking['error'] == '000')
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
								<td>{{ $tracking['data']['order']->airwaybill }}</td>
							</tr>
							<tr>
								<td>{{ trans('app.from') }}</td>
								<td>ID </td>
							</tr>
							<tr>
								<td>{{ trans('app.to') }}</td>
								<td>{{ $tracking['data']['order']->address->country }}</td>
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

							@foreach ($tracking['data']['tracking'] as $key => $trackingData)
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

				@elseif($tracking['error'] == '100')

					<div class="uk-visible@m">
						<h3 class="uk-text-center uk-text-uppercase">
							{{ trans('app.order_status') }}
						</h3>
						<label>{{ trans('app.payment_confirm_unpaid') }}</label>
						<table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
							<thead>
							<tr>
								<th class="uk-width-small">{{ trans('app.order_number') }}</th>
								<th class="uk-text-center">{{ trans('app.details') }}</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<tr class="uk-text-small">
								<td><a>{{ $tracking['data']->order_code }}</a>
									<label>{{ trans('app.expired_date') }}</label> <br>{{ date('d-m-Y', strtotime($tracking['data']->expired_date)) }}
								</td>
								<td>
									<table class="uk-table uk-table-small uk-table-divider">
										<tbody>
										@php
											$total = null;
										@endphp
										@foreach($tracking['data']->details as $detail)
											<tr>
												<td>{{ $detail->product_name }} ({{ $detail->productStock->size }})</td>
												<td>{{ $exchange->symbol }} {{ number_format($detail->price/$exchange->value,2) }}</td>
												<td>x {{ $detail->qty }}</td>
												<td>{{ $exchange->symbol }} {{ number_format($detail->subtotal/$exchange->value,2) }}</td>
											</tr>
											@php
												$total += $detail->subtotal;
											@endphp
										@endforeach
										<tr>
											<td class="uk-text-right" colspan="3">{{ trans('app.subtotal') }}</td>
											<td>{{ $exchange->symbol }} {{ number_format($total/$exchange->value,2) }}</td>
										</tr>
										<tr>
											<td class="uk-text-right" colspan="3">{{ trans('app.shipping_cost_label') }}</td>
											<td>{{ $exchange->symbol }} {{ number_format($tracking['data']->shipping_cost/$exchange->value,2) }}</td>
										</tr>
										<tr class="uk-text-bold">
											<td class="uk-text-right" colspan="3">{{ trans('app.total') }}</td>
											<td>{{ $exchange->symbol }} {{ number_format(($total+$tracking['data']->shipping_cost)/$exchange->value,2) }}</td>
										</tr>
										</tbody>
									</table>
								</td>
								<td><form action="/repayment" method="POST">
										<input type="hidden" name="order_code" value="{{ $tracking['data']->order_code }}">
										<input type="hidden" name="signature" value="{{ sha1($tracking['data']->order_code) }}">
										{{ csrf_field() }}
										<input  class="uk-button uk-button-secondary uk-button-small" type="submit" value="{{ trans('app.pay') }}"></form>
								</td>
							</tr>

							</tbody>
						</table>
						<label>*{{ $tracking['message'] }}</label>
					</div>

					{{--mobile--}}
					<div class="uk-hidden@m">
						<h4 class="uk-text-center uk-text-uppercase">
							{{ trans('app.order_status') }}
						</h4>
						<label>{{ trans('app.payment_confirm_unpaid') }}</label>
						<h6 class="uk-margin-small">{{ trans('app.order_number') }} : {{ $tracking['data']->order_code }}</h6>
						<h6 class="uk-margin-small"><label>{{ trans('app.expired_date') }}</label> {{ date('d-m-Y', strtotime($tracking['data']->expired_date)) }}</h6>
						<div>
							@php
								$total = null;
							@endphp
							<table class="uk-table uk-table-striped uk-table-small uk-background-muted uk-box-shadow-small">


								@foreach($tracking['data']->details as $detail)
									<tr>
										<td>{{ $detail->product_name }} ({{ $detail->productStock->size }})</td>
										<td>{{ $exchange->symbol }} {{ number_format($detail->price/$exchange->value,2) }}</td>
										<td>x {{ $detail->qty }}</td>
										<td>{{ $exchange->symbol }} {{ number_format($detail->subtotal/$exchange->value,2) }}</td>
									</tr>
									@php
										$total += $detail->subtotal;
									@endphp
								@endforeach
								<tr>
									<td class="uk-text-right" colspan="3">{{ trans('app.subtotal') }}</td>
									<td>{{ $exchange->symbol }} {{ number_format($total/$exchange->value,2) }}</td>
								</tr>
								<tr>
									<td class="uk-text-right" colspan="3">{{ trans('app.shipping_cost_label') }}</td>
									<td>{{ $exchange->symbol }} {{ number_format($tracking['data']->shipping_cost/$exchange->value,2) }}</td>
								</tr>
								<tr class="uk-text-bold">
									<td class="uk-text-right" colspan="3">{{ trans('app.total') }}</td>
									<td>{{ $exchange->symbol }} {{ number_format(($total+$tracking['data']->shipping_cost)/$exchange->value,2) }}</td>
								</tr>
								<tr>
									<td colspan="4" class=" uk-text-right">
										<form action="/repayment" method="POST">
											<input type="hidden" name="order_code" value="{{ $tracking['data']->order_code }}">
											<input type="hidden" name="signature" value="{{ sha1($tracking['data']->order_code) }}">
											{{ csrf_field() }}
											<input  class="uk-button uk-button-secondary uk-button-small" type="submit" value="{{ trans('app.pay') }}"></form>
									</td>
								</tr>
							</table>
							<hr class="uk-margin" style="border-color: #333; border-width: 3px">

						</div>
						<label>*{{ $tracking['message'] }}</label>
					</div>
					{{--end mobile--}}


				@else
					<h3 class="uk-card-title uk-text-center">
						{{ $tracking['message'] }}
					</h3>
				@endif

				<div class="uk-grid-small uk-margin-xlarge-top uk-margin-small-bottom">
					<div class="uk-panel uk-text-center">
						<a href="{{ route('tracking-page') }}"><button class="uk-button uk-button-secondary">{{ trans('app.back_to_tracking') }}</button></a>
						<a href="{{ route('index') }}"><button class="uk-button uk-button-secondary">{{ trans('app.back_to_home') }}</button></a>
					</div>
				</div>



			</div>
		</div>
  	</div>

</div>
@endsection
