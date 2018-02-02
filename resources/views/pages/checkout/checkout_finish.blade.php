@extends('app_checkout')
@section('content')
  <div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top uk-flex uk-flex-center" uk-grid>
      <div class="uk-width-3-4@m">
        <h3>Your Checkout Process is almost done!</h3>
        <div class="uk-card uk-card-default uk-background-muted uk-box-shadow-small uk-margin-bottom">
            <div class="uk-card-body">
                <form role="form" id="payment-form" method="POST" action="javascript:void(0);" class="form_class">
                  Order Number :
                    <br>
                    <h4 class="uk-margin-small uk-visible@m">{{ $order->order_code }}</h4>
                    <h6 class="uk-margin-small uk-hidden@m">{{ $order->order_code }}</h6>
                  <div class="uk-margin-small uk-grid-small" >
                      <div>
                        Card Number :
                        <input class="uk-input uk-form-large" name="card_number" type="text" id="card-number" placeholder="insert your card number" maxlength="16" />
                      </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" >
                      <div>
                        Card Holder :
                        <input class="uk-input uk-form-large" name="card_holder" type="text" id="card_holder"  placeholder="insert card holder"/>
                      </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small " uk-grid>
                      <div >
                          <div class="form-group">
                            <label for="card-exp-month"><span class="hidden-xs">Exp </span>Year</label>
                            <input class="uk-input uk-input-small" type="text" name="card_exp_month" id="card-exp-year" placeholder="YYYY" size="5" maxlength="4"/>
                          </div>
                      </div>
                      <div >
                          <div class="form-group">
                              <label for="card-exp-year"><span class="hidden-xs">Exp </span>Month</label>
                              <input class="uk-input uk-input-small" type="text" name="card_exp_month" id="card-exp-month" placeholder="MM" size="3" maxlength="2"/>
                          </div>
                      </div>
                      <div >
                          <div class="form-group">
                              <label for="card-cvn">CVN CODE</label>
                              <input class="uk-input uk-input-small" type="password" id="card-cvn" placeholder="CVN" size="4" maxlength="3"/>
                          </div>
                      </div>
                    </div>
                    <div class="uk-overflow-auto">
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
                              <td colspan="3"><h4><b>Total</b></h4></td><td><h4><b>{{ $total  +  $shipping}}</b></h4></td>
                            </tr>
                      </tbody>
                    </table>
                    </div>
                    <div class="uk-text-center">
                        <button class="uk-button uk-button-secondary uk-width-1-2 uk-text-center" type="submit">Pay Now</button>
                    </div>


          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="overlay" style="display: none;"></div>
  <div id="three-ds-container" style="display: none;">
      <iframe height="450" width="550" id="sample-inline-frame" name="sample-inline-frame"> </iframe>
  </div>
</div>

        <?php $orderCode = $order->order_code;
        $userId    = $order->users_id; ?>

@endsection

@section('footer_scripts')
  <script src="https://js.xendit.co/v1/xendit.min.js"></script>
   <?php echo "<script>Xendit.setPublishableKey('".config('common.xendit_public_key')."');</script>"; ?>
  <script>
      $(function () {

          var $form = $('#payment-form');

          $form.submit(function (event) {
              hideResults();

              <?php echo "Xendit.setPublishableKey('".config('common.xendit_public_key')."')";?>

              // Disable the submit button to prevent repeated clicks:
              $form.find('.submit').prop('disabled', true);

              // Request a token from Xendit:
              var tokenData = getTokenData();


              Xendit.card.createToken(tokenData, xenditResponseHandler);


              // Prevent the form from being submitted:
              return false;
          });

          $('#bundle-authentication').change(function() {
              if(this.checked) {
                  $('.hide-if-multi').hide();
              } else {
                  $('.hide-if-multi').show();
              }
          });

          function xenditResponseHandler (err, creditCardCharge) {
              $form.find('.submit').prop('disabled', false);

              if (err) {
                  alert(err.error_code +" : "+err.message);
                  window.location = "{!! route('bag') !!}";
              }

              if (creditCardCharge.status == 'VERIFIED') {
                  var card_holder = document.getElementById("card_holder").value;
                  <?php echo "orderData = { 'order_code': '".$orderCode."','user_id': '".$userId."','signature': '".$signature."', 'totalwithshipping': '".$totalwithshipping."', 'card_holder' : card_holder };"; ?>
                  tokenData = getTokenData();

                  $.ajaxSetup({
                  headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
                  });

                  var request = $.ajax({
                      type: "POST",
                      url: "{!! route('checkout.final') !!}",
                      data: { order: orderData, request: tokenData, response: creditCardCharge, _token: getTokenValue()},
                  });

                  request.done(function(msg)
                  {
                      if(msg.status == "CAPTURED" ||msg.status == "AUTHORIZED")
                      {
                           window.location = "{!! route('user.history') !!}";
                      }
                      else
                      {
                          //alert(err.error_code +" : "+err.message);
                          window.location = "{!! route('user.history') !!}";

                      }
                  });

                  displaySuccess(creditCardCharge);


              } else if (creditCardCharge.status === 'IN_REVIEW') {
                  window.open(creditCardCharge.payer_authentication_url, 'sample-inline-frame');
                  $('.overlay').show();
                  $('#three-ds-container').show();
              } else if (creditCardCharge.status === 'FRAUD') {
                  displayError(creditCardCharge);
              } else if (creditCardCharge.status === 'FAILED') {
                  displayError(creditCardCharge);
              }
          }



          function displaySuccess (creditCardCharge) {
              $('#three-ds-container').hide();
              $('.overlay').hide();


              var requestData = {};
              $.extend(requestData, getTokenData(), getFraudData());
              if (shouldEnableMeta) {
                  requestData["meta_enabled"] = true;
              } else {
                  requestData["meta_enabled"] = false;
              }
              $('#success .request-data').text(JSON.stringify(requestData, null, 4));

          }

          function getTokenData () {
            var total = Math.round(({{$total}} + {{$shipping}}) * {{$rupiah}});
            var amount = total.toString();
              return {
                  amount: amount,
                  card_number: $form.find('#card-number').val(),
                  card_exp_month: $form.find('#card-exp-month').val(),
                  card_exp_year: $form.find('#card-exp-year').val(),
                  card_cvn: $form.find('#card-cvn').val(),
                  is_multiple_use: false,
                  should_authenticate: true
              };
          }


          function getFraudData () {
              return JSON.parse($form.find('#meta-json').val());
          }

          function hideResults() {
              $('#success').hide();
              $('#error').hide();
          }
      });

  </script>
@stop
