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
      <li><a href="#"><b><h5 class="uk-text-uppercase">{{ trans('app.unpaid') }}</h5></b> </a> </li>
      <li><a href="#"><b><h5 class="uk-text-uppercase">{{ trans('app.unsent') }}</h5></b> </a> </li>
      <li><a href="#"><b><h5 class="uk-text-uppercase">{{ trans('app.unreceived') }}</h5></b> </a> </li>
      <li><a href="#"><b><h5 class="uk-text-uppercase">{{ trans('app.done') }}</h5></b> </a> </li>
      <li><a href="#"><b><h5 class="uk-text-uppercase">{{ trans('app.canceled') }}</h5></b> </a> </li>
	  </ul>
    <ul class="uk-switcher">
      <li>
        @if (count($onPaid))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
                <tr>
                    <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                    <th>{{ trans('app.details') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($onPaid as $item)
                  <tr>
                      <td><a href="#">#{{ $item->order_code }}</a></td>
                      <td>
                        <table class="uk-table uk-table-divider">
                          <tbody>
                            @php
                              $total = null;
                            @endphp
                            @foreach($item->details as $detail)
                              <tr>
                                  <td>{{ $detail->product_name }}</td>
                                  <td>{{ $detail->price }}</td>
                                  <td>x {{ $detail->qty }}</td>
                                  <td>{{ $detail->subtotal }}</td>
                              </tr>
                              @php
                                $total += $detail->subtotal;
                              @endphp
                            @endforeach
                              <tr>
                                <td colspan="3">{{ trans('app.total') }}</td><td>{{ $total }}</td></tr>
                              </tr>
                          </tbody>
                      </table>
                      </td>
                      <td><form action="/repayment" method="POST">
                      <input type="hidden" name="order_code" value="{{ $item->order_code }}">
                      <input type="hidden" name="signature" value="{{ sha1($item->order_code) }}">
                      {{ csrf_field() }}
                      <input  class="uk-button uk-button-secondary uk-width-1-1" type="submit" value="{{ trans('app.pay') }}"></form></td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <center>{{ trans('app.no_data') }}</center>
        @endif
      </li>
      <li>
        @if (count($onSent))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
                <tr>
                    <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                    <th>{{ trans('app.details') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($onSent as $item)
                  <tr>
                      <td><a href="#">#{{ $item->order_code }}</a></td>
                      <td>
                        <table class="uk-table uk-table-divider">
                          <tbody>
                            @php
                              $total = null;
                            @endphp
                            @foreach($item->details as $detail)
                              <tr>
                                  <td>{{ $detail->product_name }}</td>
                                  <td>{{ $detail->price }}</td>
                                  <td>x {{ $detail->qty }}</td>
                                  <td>{{ $detail->subtotal }}</td>
                              </tr>
                              @php
                                $total += $detail->subtotal;
                              @endphp
                            @endforeach
                              <tr>
                                <td colspan="3">{{ trans('app.total') }}</td><td>{{ $total }}</td></tr>
                              </tr>
                          </tbody>
                      </table>
                      </td>
                      <td><!-- <button class="uk-button uk-button-default" type="button">Pay</button> --></td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <center>{{ trans('app.no_data') }}</center>
        @endif
      </li>
      <li>
        @if (count($onReceived))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
                <tr>
                    <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                    <th>{{ trans('app.details') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($onReceived as $item)
                  <tr>
                      <td><a href="#">#{{ $item->order_code }}</a></td>
                      <td>
                        <table class="uk-table uk-table-divider">
                          <tbody>
                            @php
                              $total = null;
                            @endphp
                            @foreach($item->details as $detail)
                              <tr>
                                  <td>{{ $detail->product_name }}</td>
                                  <td>{{ $detail->price }}</td>
                                  <td>x {{ $detail->qty }}</td>
                                  <td>{{ $detail->subtotal }}</td>
                              </tr>
                              @php
                                $total += $detail->subtotal;
                              @endphp
                            @endforeach
                              <tr>
                                <td colspan="3">{{ trans('app.total') }}</td><td>{{ $total }}</td></tr>
                              </tr>
                          </tbody>
                      </table>
                      </td>
                      <td><a href="{{URL::to('/tracking/trace/' . $item->order_code )}}" class="uk-button uk-button-default uk-button-small">{{ trans('app.track') }}</a></td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <center>{{ trans('app.no_data') }}</center>
        @endif
      </li>
      <li>
        @if (count($onDone))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
                <tr>
                    <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                    <th>{{ trans('app.details') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($onDone as $item)
                  <tr>
                      <td><a href="#">#{{ $item->order_code }}</a></td>
                      <td>
                        <table class="uk-table uk-table-divider">
                          <tbody>
                            @php
                              $total = null;
                            @endphp
                            @foreach($item->details as $detail)
                              <tr>
                                  <td>{{ $detail->product_name }}</td>
                                  <td>{{ $detail->price }}</td>
                                  <td>x {{ $detail->qty }}</td>
                                  <td>{{ $detail->subtotal }}</td>
                              </tr>
                              @php
                                $total += $detail->subtotal;
                              @endphp
                            @endforeach
                              <tr>
                                <td colspan="3">{{ trans('app.total') }}</td><td>{{ $total }}</td></tr>
                              </tr>
                          </tbody>
                      </table>
                      </td>
                      <td><button class="uk-button uk-button-seconday uk-width-1-1" type="button">{{ trans('app.review') }}</button></td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <center>{{ trans('app.no_data') }}</center>
        @endif
      </li>
      <li>
        @if (count($onCanceled))
        <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
            <thead>
                <tr>
                    <th class="uk-width-small">{{ trans('app.order_number') }}</th>
                    <th>{{ trans('app.details') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($onCanceled as $item)
                  <tr>
                      <td><a href="#">#{{ $item->order_code }}</a></td>
                      <td>
                        <table class="uk-table uk-table-divider">
                          <tbody>
                            @php
                              $total = null;
                            @endphp
                            @foreach($item->details as $detail)
                              <tr>
                                  <td>{{ $detail->product_name }}</td>
                                  <td>{{ $detail->price }}</td>
                                  <td>x {{ $detail->qty }}</td>
                                  <td>{{ $detail->subtotal }}</td>
                              </tr>
                              @php
                                $total += $detail->subtotal;
                              @endphp
                            @endforeach
                              <tr>
                                <td colspan="3">{{ trans('app.total') }}</td><td>{{ $total }}</td></tr>
                              </tr>
                          </tbody>
                      </table>
                      </td>
                      <td><button class="uk-button uk-button-seconday uk-width-1-1" type="button">{{ trans('app.buy_again') }}</button></td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <center>{{ trans('app.no_data') }}</center>
        @endif
      </li>
    </ul>
	</div>
</div>
</div>
@endsection
