@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top">
        @include('partials.alert')
    </div>
    <div class="uk-grid-small uk-margin-top" uk-grid>
        <div class="uk-width-3-4@m">
            <b>C H E C K O U T</b>
            <hr class="uk-margin-remove-vertical"></hr>
            <div class="uk-grid uk-grid-small uk-grid-divider uk-child-width-1-4@m uk-margin-small" uk-grid>
                <div>
                    <a href="{{ route('checkout') }}" class="uk-button uk-button-text">SHIPPING ADDRESS</a>
                </div>
                <div class="uk-text-center">
                    <a href="{{ route('checkout.shipping') }}" class="uk-button uk-button-text">SHIPPING OPTION</a>
                </div>
{{--                 <div class="uk-text-center">
                    <a href="{{ route('checkout.billing') }}" class="uk-button uk-button-text">BILLING</a>
                </div> --}}
                <div class="uk-text-center">
                    <button class="uk-button uk-button-text" disabled><b>REVIEW</b></button>
                </div>
            </div>
            <hr class="uk-margin-small">
            <h4 class="uk-margin-remove">PLEASE CONFIRM YOUR ORDER</h4>

{{--               <hr class="uk-margin-small">
              <b>BILLING OPTION</b>
              <hr class="uk-margin-small">
              <div class="uk-grid uk-grid-small" grid>
                <div class="uk-width-1-3@m">
                  <ul class="uk-list uk-text-meta">
                      <li>{{ $defaultCreditcard->first_name }}</li>
                      <li>{{ $defaultCreditcard->company }}</li>
                      <li>{{ $defaultCreditcard->address_line }}</li>
                      <li>{{ $defaultCreditcard->city }}</li>
                      <li>{{ $defaultCreditcard->city }}, {{ $defaultCreditcard->country }} {{ $defaultCreditcard->postal }}</li>
                      <li>{{ $defaultCreditcard->country }}</li>
                      <li>{{ $defaultCreditcard->phone_number }}</li>
                  </ul>
                </div>
                <div class="uk-width-1-3@m">
                  <input type="hidden" name="card_number" value="{{ $defaultCreditcard->card_number }}" id="card-number-hidden">
                  <ul class="uk-list uk-text-meta">
                      <li><span id="card"></span></li>
                      <li><span id="card-number"></span></li>
                      <li><img src="#" id="card_img" width="50px"></li>
                      <li>{{ $defaultCreditcard->name }}</li>
                      <li>IDR {{ $total }}</li>
                  </ul>
                </div>
              </div> --}}
            <hr class="uk-margin-small">
            <b>SHIPPING DETAILS</b>
            <hr class="uk-margin-small">
            <div class="uk-grid uk-grid-small" grid>
              <div class="uk-width-1-3@m">
                <ul class="uk-list uk-text-meta">
                  <li>{{ $defaultAddress->first_name }} {{ $defaultAddress->last_name}}</li>
                  <li>{{ $defaultAddress->company }}</li>
                  <li>{{ $defaultAddress->address_line }}</li>
                  <li>{{ $defaultAddress->city }}</li>
                  <li>{{ $defaultAddress->city }}, {{ $defaultAddress->country }} {{ $defaultAddress->postal }}</li>
                  <li>{{ $defaultAddress->country }}</li>
                  <li>{{ $defaultAddress->phone_number }}</li>
                </ul>
              </div>
              <div class="uk-width-2-3@m">
                TODAY: {{ \Carbon\Carbon::now()->toDayDateTimeString() }}
                <table class="uk-table uk-table-divider uk-table-hover">
                    <tbody>
                        <tr class="uk-active">
                            <td>
                                <input type="radio" class="uk-radio" name="shipping" value="1" required="required" checked> </td>
                            <td> DHL Express (3 - 6 Ekonomi Days) </td>
                            <td> IDR 500.000</td>
                        </tr>
                    </tbody>
                </table>
                <form action="{{ route('order') }}" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" name="order" value="ok">
                  <input type="submit" name="submit" id="submit" style="display: none;">
                </form>
              </div>
            </div>
            <hr class="uk-margin-small">
              <item-checkout
                 bag_api="{{ route('persist.bag') }}"
              ></item-checkout>
            <hr class="uk-margin-small">
        </div>
        <summary-checkout></summary-checkout>
    </div>
</div>
@endsection

@section('footer_scripts')
{{-- <script src="{{ elixir('js/creditcard.js') }}"></script> --}}
<script type="text/javascript">
   $(function () {

      // $('#card-number-hidden').validateCreditCard(function(result) {
      //   var card = result.card_type == null ? '' : result.card_type.name;
      //   $('#card').html(card.toUpperCase());

      //   if (card == 'visa') {
      //     $('#card_img').attr('src', '/images/visa.png');
      //   } else if (card == 'mastercard') {
      //     $('#card_img').attr('src', '/images/mastercard.png');
      //   } else if (card == 'discover') {
      //     $('#card_img').attr('src', '/images/discover.png');
      //   } else {
      //     $('#card_img').attr('src', '/images/default_card.png');
      //   }
        
      // });

      // var card = $('#card-number-hidden').val();

      // var cardNumber = card.substring(13);

      // $('#card-number').html('*************'+cardNumber);

     $("#continue").on('click', function (e) {
        e.preventDefault();
        $('#submit').click();
     });
   })
</script>
@endsection