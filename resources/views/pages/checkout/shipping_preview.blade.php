@extends('app_checkout')
@section('title', trans('app.title_shipping_preview') )
@section('content')
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top">
        @include('partials.alert')
    </div>
    <div class="uk-grid uk-margin-top" uk-grid>
        <div class="uk-width-2-3@m">
            <div class="uk-card uk-card-default uk-card-small uk-background-muted uk-box-shadow-small">
              <div class="uk-card-body">
               <div class="uk-grid uk-grid-divider uk-child-width-1-3 uk-margin-small" uk-grid>
                 <div class="uk-text-center">
                     <a href="{{ route('checkout') }}" class="uk-button uk-button-text">{{ trans('app.shipping_address') }}</a>
                 </div>
                 <div class="uk-text-center">
                     <a href="{{ route('checkout.shipping') }}" class="uk-button uk-button-text">{{ trans('app.shipping_option') }}</a>
                 </div>
                 <div class="uk-text-center">
                     <button class="uk-button uk-button-text" disabled><b>{{ trans('app.review') }}</b></button>
                 </div>
               </div>
             </div>
             </div>
            <h4 class="uk-text-uppercase">{{ trans('app.confirm_order') }}</h4>
            <h6 class="uk-margin-small uk-text-uppercase">{{ trans('app.shipping_detail') }}</h6>
            <div>
              <table class="uk-table uk-table-divider uk-table-small uk-text-meta uk-table-hover uk-background-muted">
                  <tbody>
                    <tr>
                      <td class="uk-width-small">{{ trans('app.full_name') }}</td>
                      <td>{{ $defaultAddress->first_name }} {{ $defaultAddress->last_name}}</td>
                    </tr>
                    <tr>
                      <td>{{ trans('app.company') }}  </td>
                      <td>{{ $defaultAddress->company }}</td>
                    </tr>
                    <tr>
                      <td>{{ trans('app.address_line') }}  </td>
                      <td>{{ $defaultAddress->address_line }}</td>
                    </tr>
                    <tr>
                      <td>{{ trans('app.city') }}     </td>
                      <td>{{ $defaultAddress->city }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('app.country') }} </td>
                        <td>{{ $defaultAddress->country }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('app.postal') }}</td>
                        <td>{{ $defaultAddress->postal }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('app.phone') }}</td>
                        <td>{{ $defaultAddress->phone_number }}</td>
                    </tr>
                  </tbody>
                </table>
            </div>
              <div class="uk-margin-small-top">
                <h6>{{ trans('app.today') }}: {{ \Carbon\Carbon::now()->toDayDateTimeString() }}</h6>
                <table class="uk-table uk-table-divider uk-table-hover">
                    <tbody>
                        <tr class="uk-active">
                            <td>
                                <input type="radio" class="uk-radio" name="shipping" value="1" required="required" checked> </td>
                            <td> {{ $shippingCost['data']->origin->serviceName }} </td>
                            <td> {{ $shippingCost['data']->total_fee_label }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr class="uk-margin" style="border-color: #333; border-width: 3px">
                <h4 class="uk-margin-small uk-text-uppercase">{{ trans('app.payment_method') }}</h4>
                <form action="{{ route('order') }}" method="POST">
                  {{ csrf_field() }}
                  <table class="uk-table uk-table-divider uk-table-hover">
                    <tbody>
                        @if($currency == 'idr')
                        <tr>
                            <td>
                                <input type="radio" class="uk-radio" name="payment_method" value="bank_transfer" required="required">
                            </td>
                            <td>
                              <span></span>Bank Transfer
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td>
                                <input type="radio" class="uk-radio" name="payment_method" value="creditcard" required="required">
                            </td>
                            <td>
                              Credit Card
                            </td>
                        </tr>
                    </tbody>
                  </table>
                  <input type="hidden" name="order" value="ok">
                  <input type="submit" name="submit" id="submit" style="display: none;">
                </form>
              </div>
              <hr class="uk-margin" style="border-color: #333; border-width: 3px">
              <item-checkout
                 bag_api="{{ route('persist.bag') }}"
                 aws_link="{{ config('filesystems.s3url') }}"
                 default_image="{{ json_encode(config('common.default')) }}"
                 locale="{{ json_encode(trans('app')) }}"
                 exchange_api="{{ route('exchange') }}"
              ></item-checkout>

        </div>
        <summary-checkout
          shipping_cost="{{ $shippingCost['data']->total_fee_idr }}"
          locale="{{ json_encode(trans('app')) }}"
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
