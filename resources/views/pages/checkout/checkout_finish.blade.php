@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top uk-flex uk-flex-center" uk-grid>
        <div class="uk-width-3-4@m">
          <h3>Your Checkout Process is almost done!</h3>
          <div class="uk-card uk-card-default uk-card-border">
            <div class="uk-card-body">
              <form action="#" method="post" name="form_name" id="form_id" class="form_class" >
                  {{ csrf_field() }}
                    Order Number : <br><span class="uk-label uk-text-lead uk-light">{{ $order->order_code }}</span>
                    <div class="uk-margin-small uk-grid-small" uk-grid>
                      <div>
                        Card Number :
                        <input class="uk-input uk-input-small" name="card_number" id="card_number" type="text" value="" required="required" placeholder="insert your card number" size="18" maxlength="16">
                      </div>
                    </div>
                    <div class="uk-margin-small uk-grid-small" uk-grid>
                      <div>
                        Total Amount :
                        <input class="uk-input uk-input-small" name="card_amount" id="card_amount" type="text" value="{{ $total +  $shipping}}" required="required" readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class="uk-margin-small uk-grid-small">
                          <div class="form-group">
                            <label for="card-exp-month"><span class="hidden-xs">Exp </span>Year</label>
                            <input class="uk-input uk-input-small" type="text" name="card_exp_month" id="card_exp_year" placeholder="card_exp_year" size="5" maxlength="4" /> <br/>
                          </div>
                      </div>
                      <div class="uk-margin-small uk-grid-small">
                          <div class="form-group">
                              <label for="card-exp-year"><span class="hidden-xs">Exp </span>Month</label>
                              <input class="uk-input uk-input-small" type="text" name="card_exp_month" id="card_exp_month" placeholder="card_exp_month" size="3" maxlength="2" /> <br/>
                          </div>
                      </div>
                      <div class="uk-margin-small uk-grid-small">
                          <div class="form-group">
                              <label for="card-cvn">CVN CODE</label>
                              <input class="uk-input uk-input-small" type="password" name="card_cvn" id="card_cvn" placeholder="card_cvn" size="4" maxlength="3" /> <br/>
                          </div>
                      </div>
                    </div>

              

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

              

              <div class="uk-text-center">
                <input class="uk-button uk-button-danger uk-width-1-2 uk-text-center" type="button" name="submit_name" id="btn_name" value="Pay" onclick="pay()"/>        
            </div>
         </form>
          </div>
        </div>
    </div>
    <div id="three-ds-container" style="display: none;">
                <iframe height="450" width="550" id="sample-inline-frame" name="sample-inline-frame"> </iframe>
            </div>
</div>
<?php $orderCode = $order->order_code;
      $userId    = $order->users_id; ?>
<script src="https://js.xendit.co/v1/xendit.min.js"></script>
<?php echo "<script>Xendit.setPublishableKey('".config('common.xendit_public_key')."');</script>"; ?>
<script type="text/javascript">
orderData = { 'order_code': '<? echo $orderCode; ?>','user_id': '<? echo $userId; ?>'};

  // Submit form with name function.
  function pay() {
    var cardNumber = document.getElementById("card_number").value;
    var cardAmount = document.getElementById("card_amount").value;
    var cardexpMonth = document.getElementById("card_exp_month").value;
    var cardExpYear = document.getElementById("card_exp_year").value;
    var cardCvn = document.getElementById("card_cvn").value;
      if (validation()) // Calling validation function
      {

        var x = document.getElementsByName('form_name');
        x[0].submit(); 
        tokenData = getTokenData();
        Xendit.card.createToken(tokenData, function (err, data) {
            
              if (err) 
                {
                  alert(err.error_code +" : "+err.message);
                  window.location = "{!! route('bag') !!}";  
                }

              if (data.status === 'VERIFIED') 
                { 

                    $.ajaxSetup({
                     headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
                    });   

                    var request = $.ajax({
                        type: "POST",
                        url: "{!! route('checkout.final') !!}",
                        data: {order: orderData, request: tokenData, response: data, _token: getTokenValue()},
                    });

                    request.done(function(msg) 
                    {
                        if(msg.status == "CAPTURED" ||msg.status == "AUTHORIZED")
                        {  
                             window.location = "{!! route('user.history') !!}";
                        }
                        else
                        {   
                            
                            window.location = "{!! route('bag') !!}";
                        }
                    });

                    displaySuccess(data);

                } 
                
                else if (data.status === 'IN_REVIEW') 
                {
                   window.open(data.payer_authentication_url, 'sample-inline-frame');
                   $('.overlay').show();
                   $('#three-ds-container').show();
                } 
                
                else if (creditCardCharge.status === 'FRAUD') 
                {
                   window.location = "{!! route('bag') !!}";
                } 
                else if (creditCardCharge.status === 'FAILED') 
                {
                   window.location = "{!! route('bag') !!}";
                }
                
            });
        }
    }



  // Name and Email validation Function.
  function validation() {
      var cardNumber = document.getElementById("card_number").value;
      var cardAmount = document.getElementById("card_amount").value;
      var cardexpMonth = document.getElementById("card_exp_month").value;
      var cardExpYear = document.getElementById("card_exp_year").value;
      var cardCvn = document.getElementById("card_cvn").value;

      if (cardNumber === '' || cardAmount === '' || cardexpMonth === '' || cardExpYear === '' || cardCvn === '') 
      {
          alert("Please fill all fields...!!!!!!");
          return false;
      }
  
      else if((isNaN(cardNumber)) || (isNaN(cardAmount)) || (isNaN(cardexpMonth)) || (isNaN(cardExpYear)) || (isNaN(cardCvn)))
      {
          alert("Input number only...!!!!!!");
          return false;
      }

      else 
      {
          return true;
      }
  }

  function getTokenData() {
    var total = document.getElementById("card_amount").value * {{$rupiah}};
    var amount = total.toString();
                    return {
                        amount: amount,
                        card_number: document.getElementById("card_number").value,
                        card_exp_month: document.getElementById("card_exp_month").value,
                        card_exp_year: document.getElementById("card_exp_year").value,
                        card_cvn: document.getElementById("card_cvn").value,
                        is_multiple_use: false,
                        should_authenticate: true
                    };
  }
  
  function displaySuccess (creditCardCharge) {
      $('#three-ds-container').hide();
      $('.overlay').hide();
  }

</script>
@endsection
