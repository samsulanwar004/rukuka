@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top">
        @include('partials.alert')
    </div>
    <div class="uk-grid-small uk-margin-top" uk-grid>
        <div class="uk-width-3-4@m">
            <h4>CHECKOUT</h4>
            <div class="uk-grid uk-grid-small uk-grid-divider uk-child-width-1-3@m uk-margin-small" uk-grid>
                <div class="uk-text-center">
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
            <h4>PLEASE CONFIRM YOUR ORDER</h4>
            SHIPPING DETAILS
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
              <div class="uk-margin-small-top uk-width-2-3@m">
                TODAY: {{ \Carbon\Carbon::now()->toDayDateTimeString() }}
                <table class="uk-table uk-table-divider uk-table-hover">
                    <tbody>
                        <tr class="uk-active">
                            <td>
                                <input type="radio" class="uk-radio" name="shipping" value="1" required="required" checked> </td>
                            <td> {{ $shippingCost['data']->origin->serviceName }} </td>
                            <td> $ {{ $shippingCost['data']->total_fee_usd }}</td>
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
                 aws_link="{{ config('filesystems.s3url') }}"
                 default_image="{{ json_encode(config('common.default')) }}"
              ></item-checkout>
            <hr class="uk-margin-small">
        </div>
        <summary-checkout
          shipping_cost="{{ $shippingCost['data']->total_fee_usd }}"
        ></summary-checkout>
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
