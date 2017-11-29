@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top" uk-grid>
        <div class="uk-width-3-4@m">
          <table class="uk-table">
            <tr>
              <td>No Order</td><td colspan="3">{{ $order->order_code }}</td>
            </tr>
            <tr>
              <td>Product Name</td><td>Product Price</td><td>Qty</td><td>Subtotal</td>
            </tr>
            @foreach($detail as $product)
              @php 
                $subtotal = $product['price'] * $product['qty'];
              @endphp
              <tr>
                <td>{{ $product['product_name'] }}</td><td>{{ $product['price'] }}</td><td>{{ $product['qty'] }}</td><td>{{ $subtotal }}</td>
              </tr>
            @endforeach
            <tr>
              <td colspan="3">Shipping Cost</td><td>{{ $shipping }}</td>
            </tr>
            <tr>
              <td colspan="3">Total</td><td>{{ $total +  $shipping}}</td>
            </tr>
          </table>
        </div>
    </div>
</div>
@endsection