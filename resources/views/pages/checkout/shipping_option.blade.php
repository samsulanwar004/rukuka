@extends('app_checkout')
@section('title', trans('app.title_shipping_option') )
@section('content')
<div class="uk-section uk-section-muted uk-section-xsmall">
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top">
        @include('partials.alert')
    </div>

    <div class="uk-margin-top" uk-grid>
        <div class="uk-width-2-3@m">
          <div class="uk-card uk-card-default uk-card-small uk-box-shadow-small">
            <div class="uk-card-body">
             <div class="uk-grid uk-grid-divider uk-child-width-1-3 uk-margin-small" uk-grid>
               <div class="uk-text-center">
                   <a href="{{ route('checkout') }}" class="uk-button uk-button-text">{{ trans('app.shipping_address') }}</a>
               </div>
               <div class="uk-text-center">
                   <button class="uk-button uk-button-text" disabled><b>{{ trans('app.shipping_option') }}</b></button>
               </div>
               <div class="uk-text-center">
                   <button class="uk-button uk-button-text" disabled>{{ trans('app.review') }}</button>
               </div>
             </div>
           </div>
           </div>
           <div class="uk-card uk-card-small uk-card-default uk-margin-top">
             <div class="uk-card-header">
               <h4>{{ trans('app.checkout') }}</h4>
             </div>
             <div class="uk-card-body">

            <h6 class="uk-margin-small uk-text-uppercase">{{ trans('app.shipping_method') }}</h6>
            <h6 class="uk-margin-small uk-text-uppercase"> <b>{{ trans('app.today') }} : </b>{{ \Carbon\Carbon::now()->toDayDateTimeString() }}</h6>

            <form action="{{ route('checkout.shipping') }}" method="POST">
              {{ csrf_field() }}
            <table class="uk-table uk-table-striped uk-table-hover">
                <tbody>

                    @foreach ($availableCouriersService['available_couriers'] as $availableCouriersService_key => $availableCouriersService_val)

                        @if($availableCouriersService_val['error'] == '000')

                          @if(count($availableCouriersService_val['data']) > 0 )

                            @foreach($availableCouriersService_val['data'] as $dataServices_key => $dataServices_val)

                              <tr>
                                  <td>
                                      <input type="radio" class="uk-radio radio-shipping-cost" name="shipping" value="{{$dataServices_val->optionValue}}" required="" onclick="getTotal({{ $dataServices_val->totalFeeIdr }})"> </td>
                                  <td> {{ $dataServices_val->serviceName }} </td>
                                  <td> {{ $dataServices_val->optionCurrencyLabel }}</td>
                              </tr>

                            @endforeach

                          @else

                            <tr>
                                <td>
                                    <input type="radio" class="uk-radio radio-shipping-cost" name="shipping" value="{{$dataServices_val->optionValue}}" required="" onclick="getTotal({{ $availableCouriersService_val['data']->totalFeeIdr }})"> </td>
                                <td> {{ $availableCouriersService_val['data']->serviceName }} </td>
                                <td> {{ $availableCouriersService_val['data']->optionCurrencyLabel }} </td>
                            </tr>

                          @endif

                        @else

                          <tr>
                              <td> {{ $availableCouriersService_val['message'] }} </td>
                          </tr>

                        @endif

                    @endforeach

                </tbody>
            </table>
            <div style="display: none;">
              <input type="submit" name="submit" id="submit">
            </div>
          </div>
        </div>
        <div class="uk-card uk-card-small uk-card-default uk-margin-top">
          <div class="uk-card-header">
            <h4>{{ trans('app.shipping_detail') }}</h4>
          </div>
          <div class="uk-card-body">
            <form>

              <table class="uk-table uk-table-divider uk-table-small uk-background-muted uk-text-meta uk-table-hover">
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
      </div>
      <div class="uk-card uk-card-small uk-card-default uk-margin-top uk-margin-bottom">
        <div class="uk-card-header">
          <h4>Your Shopping Bag</h4>
        </div>
        <div class="uk-card-body">
              <item-checkout
                 bag_api="{{ route('persist.bag') }}"
                 aws_link="{{ config('filesystems.s3url') }}"
                 default_image="{{ json_encode(config('common.default')) }}"
                 locale="{{ json_encode(trans('app')) }}"
                 exchange_api="{{ route('exchange') }}"
              ></item-checkout>
            </div>
          </div>
        </div>
        <summary-checkout
          shipping_cost="0"
          locale="{{ json_encode(trans('app')) }}"
        ></summary-checkout>
    </div>
</div>
</div>
@endsection

@section('footer_scripts')
<script type="text/javascript">


   function getTotal(shipingCost){
    var subTotal = $('#sub_total').val();
    var currency = $('#currency').val();
    var rate = $('#rate').val();

    var total = parseFloat(subTotal) + parseFloat(shipingCost);

    $('#shiping_fee').html(round(shipingCost, currency, rate));
    $('#total_fee').html(round(total, currency, rate));
   }

   function round(value, currency, rate) {
    var value = value / rate;
    var money = function(n, currency) {
      return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    };

    return money(Number(Math.round(value+'e'+2)+'e-'+2), currency);
   }

   $(function () {

     $("#continue").on('click', function (e) {
       e.preventDefault();
       $('#submit').click();
     });
   })


</script>
@endsection
