@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
	  <h3 class="uk-text-uppercase">{{ trans('app.order_history') }}</h3>
	  <ul class="uk-child-width-1-5 uk-margin" uk-tab="animation: uk-animation-slide-bottom">
      <li><a href="#"><b><h5 class="uk-text-uppercase uk-text-small">{{ trans('app.unpaid') }}</h5></b> </a> </li>
      <li><a href="#"><b><h5 class="uk-text-uppercase uk-text-small">{{ trans('app.unsent') }}</h5></b> </a> </li>
      <li><a href="#"><b><h5 class="uk-text-uppercase uk-text-small">{{ trans('app.unreceived') }}</h5></b> </a> </li>
      <li><a href="#"><b><h5 class="uk-text-uppercase uk-text-small">{{ trans('app.done') }}</h5></b> </a> </li>
      <li><a href="#"><b><h5 class="uk-text-uppercase uk-text-small">{{ trans('app.canceled') }}</h5></b> </a> </li>
	  </ul>
    <ul class="uk-switcher">
      <li>
        @if (count($onPaid))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
                <tr>
                    <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                    <th class="uk-text-center">{{ trans('app.details') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($onPaid as $item)
                  <tr class="uk-text-small">
                      <td><a>{{ $item->order_code }}</a>
                          <label>{{ trans('app.expired_date') }}</label> <br>{{ date('d-m-Y', strtotime($item->expired_date)) }}
                      </td>
                      <td>
                        <table class="uk-table uk-table-small uk-table-divider">
                          <tbody>
                            @php
                              $total = null;
                            @endphp
                            @foreach($item->details as $detail)
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
                                <td>{{ $exchange->symbol }} {{ number_format($item->shipping_cost/$exchange->value,2) }}</td>
                              </tr>
                              <tr class="uk-text-bold">
                                <td class="uk-text-right" colspan="3">{{ trans('app.total') }}</td>
                                  <td>{{ $exchange->symbol }} {{ number_format(($total+$item->shipping_cost)/$exchange->value,2) }}</td>
                              </tr>
                          </tbody>
                      </table>
                      </td>
                      <td><form action="/repayment" method="POST">
                          <input type="hidden" name="order_code" value="{{ $item->order_code }}">
                          <input type="hidden" name="signature" value="{{ sha1($item->order_code) }}">
                          {{ csrf_field() }}
                          <input  class="uk-button uk-button-secondary uk-button-small" type="submit" value="{{ trans('app.pay') }}"></form>
                      </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <label class="uk-text-center">{{ trans('app.no_data') }}</label>
        @endif
      </li>

      <li>
        @if (count($onSent))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
            <tr>
                <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                <th class="uk-text-center">{{ trans('app.details') }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($onSent as $item)
                    <tr class="uk-text-small">
                        <td><a>{{ $item->order_code }}</a></td>
                        <td>
                            <table class="uk-table uk-table-small uk-table-divider">
                                <tbody>
                                @php
                                    $total = null;
                                @endphp
                                @foreach($item->details as $detail)
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
                                    <td>{{ $exchange->symbol }} {{ number_format($item->shipping_cost/$exchange->value,2) }}</td>
                                </tr>
                                <tr class="uk-text-bold">
                                    <td class="uk-text-right" colspan="3">{{ trans('app.total') }}</td>
                                    <td>{{ $exchange->symbol }} {{ number_format(($total+$item->shipping_cost)/$exchange->value,2) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
              <label class="uk-text-center">{{ trans('app.no_data') }}</label>
        @endif
      </li>
      <li>
        @if (count($onReceived))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
                <tr>
                    <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                    <th class="uk-text-center">{{ trans('app.details') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($onReceived as $item)
                <tr class="uk-text-small">
                    <td><a>{{ $item->order_code }}</a></td>
                    <td>
                        <table class="uk-table uk-table-small uk-table-divider">
                            <tbody>
                            @php
                                $total = null;
                            @endphp
                            @foreach($item->details as $detail)
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
                                <td>{{ $exchange->symbol }} {{ number_format($item->shipping_cost/$exchange->value,2) }}</td>
                            </tr>
                            <tr class="uk-text-bold">
                                <td class="uk-text-right" colspan="3">{{ trans('app.total') }}</td>
                                <td>{{ $exchange->symbol }} {{ number_format(($total+$item->shipping_cost)/$exchange->value,2) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td><a href="{{URL::to('/tracking/trace/' . $item->order_code )}}" class="uk-button uk-button-secondary uk-button-small">{{ trans('app.track') }}</a></td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
              <label class="uk-text-center">{{ trans('app.no_data') }}</label>
        @endif
      </li>
      <li>
        @if (count($onDone))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
            <tr>
                <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                <th class="uk-text-center">{{ trans('app.details') }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($onDone as $item)
                <tr class="uk-text-small">
                      <td><a>{{ $item->order_code }}</a></td>
                      <td>
                        <table class="uk-table uk-table-divider">
                          <tbody>
                            @php
                              $total = null;
                            @endphp
                            @foreach($item->details as $detail)
                              <tr>
                                  <td>{{ $detail->product_name }} ({{ $detail->productStock->size }})</td>
                                  <td>{{ $exchange->symbol }} {{ number_format($detail->price/$exchange->value,2) }}</td>
                                  <td>x {{ $detail->qty }}</td>
                                  <td>{{ $exchange->symbol }} {{ number_format($detail->subtotal/$exchange->value,2) }}</td>
                                  <td><a href="/{{'review/'.$detail->productStock->product->slug}}" class="uk-button uk-button-small uk-button-secondary uk-text-uppercase">{{ trans ('app.review') }}</a></td>
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
                                <td>{{ $exchange->symbol }} {{ number_format($item->shipping_cost/$exchange->value,2) }}</td>
                            </tr>
                            <tr class="uk-text-bold">
                                <td class="uk-text-right" colspan="3">{{ trans('app.total') }}</td>
                                <td>{{ $exchange->symbol }} {{ number_format(($total+$item->shipping_cost)/$exchange->value,2) }}</td>
                            </tr>
                          </tbody>
                      </table>
                      </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
              <label class="uk-text-center">{{ trans('app.no_data') }}</label>
        @endif
      </li>
      <li>
        @if (count($onCanceled))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
            <tr>
                <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                <th class="uk-text-center">{{ trans('app.details') }}</th>
                <th> {{ trans('app.cancel_reason') }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($onCanceled as $item)
                <tr class="uk-text-small">
                      <td><a>{{ $item->order_code }}</a></td>
                      <td>
                          <table class="uk-table uk-table-small uk-table-divider">
                              <tbody>
                              @php
                                  $total = null;
                              @endphp
                              @foreach($item->details as $detail)
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
                                  <td>{{ $exchange->symbol }} {{ number_format($item->shipping_cost/$exchange->value,2) }}</td>
                              </tr>
                              <tr class="uk-text-bold">
                                  <td class="uk-text-right" colspan="3">{{ trans('app.total') }}</td>
                                  <td>{{ $exchange->symbol }} {{ number_format(($total+$item->shipping_cost)/$exchange->value,2) }}</td>
                              </tr>
                              </tbody>
                          </table>
                      </td>
                      <td> {{ $item->cancel_reason }}</td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
              <label class="uk-text-center">{{ trans('app.no_data') }}</label>
        @endif
      </li>
    </ul>
	</div>
</div>
</div>
@endsection
