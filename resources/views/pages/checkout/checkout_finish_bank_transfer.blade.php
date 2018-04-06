@extends('app_checkout')
@section('title', trans('app.title_payment') )
@section('content')
  <div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top uk-flex uk-flex-center" uk-grid>
      <div class="uk-width-3-4@m">
        <h3>{{ trans('app.checkout_almost') }} </h3>
        <div class="uk-card uk-card-default uk-card-border uk-margin-bottom">
            <div class="uk-card-body">
               {{ trans('app.order_number') }} : <br>
              <span class="uk-label uk-text-lead uk-light uk-visible@m">{{ $order->order_code }}</span>
              <span class="uk-label uk-text-small uk-light uk-hidden@m">{{ $order->order_code }}</span>

                <table class="uk-table uk-table-divider uk-table-hover">
                  <thead>
                      <tr>
                        <th>{{ trans('app.item') }}</th><th>{{ trans('app.unit_price') }}</th><th>{{ trans('app.qty') }}</th><th>{{ trans('app.subtotal') }}</th>
                      </tr>
                  </thead>
                  <tbody>

                      @foreach($detail as $product)
                        @php
                          $subtotal = number_format(($product['price'] * $product['qty']) / $kurs->value,2);
                        @endphp
                        <tr>
                          <td>{{ $product['product_name'] }} ({{ $product['size']}})</td><td>{{$kurs->symbol}} {{ number_format($product['price'] / $kurs->value,2) }}</td><td>{{ $product['qty'] }}</td><td>{{$kurs->symbol}} {{ $subtotal }}</td>
                        </tr>
                      @endforeach
                        <tr>
                          <td colspan="3">{{ trans('app.shipping_cost_label') }}</td><td>{{$kurs->symbol}} {{ number_format($shipping/ $kurs->value,2) }}</td>
                        </tr>
                        <tr>
                          <td colspan="3"><h4><b>{{ trans('app.total') }}</b></h4></td><td><h4><b>{{$kurs->symbol}} {{ number_format(($total  +  $shipping)/ $kurs->value,2)}} </b><br></h4></td>
                        </tr>
                  </tbody>
                </table>

          {{ trans('app.note') }} : <br>
          Silahkan lakukan pembayaran melalui transfer ke bank kami sebesar : <h5> {{$kurs->symbol}} {{number_format($totalwithshipping,2)}} </h5>
        </div>
      </div>
    </div>
  </div>

@endsection

