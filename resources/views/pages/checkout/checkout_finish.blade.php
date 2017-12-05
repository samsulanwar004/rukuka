@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top uk-flex uk-flex-center" uk-grid>
        <div class="uk-width-3-4@m">
          <h3>Your Checkout Process is almost done!</h3>
          <div class="uk-card uk-card-default uk-card-border">
            <div class="uk-card-body">
              Order Number : <br> <span class="uk-label uk-text-lead uk-light">{{ $order->order_code }}</span> 
              <table class="uk-table uk-table-divider uk-table-hover">
                <thead>
                  <tr>
                    <th>Product Name</th><th>Product Price</th><th>Qty</th><th>Subtotal</th>
                  </tr>
                </thead>
                  <tbody>
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
                    <td colspan="3"><h4><b>Total</b></h4></td><td><h4><b>{{ $total +  $shipping}}</b></h4></td>
                  </tr>
                </tbody>
              </table>
              <div class="uk-text-center">
                <input type="submit" name="pay" value="pay now" class="uk-button uk-button-danger uk-width-1-2 uk-text-center">
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
