@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top">
        @include('partials.alert')
    </div>

    <div class="uk-grid-small uk-margin-top" uk-grid>
        <div class="uk-width-3-4@m">
            <h4>CHECKOUT</h4>
            <div class="uk-grid uk-grid-divider uk-child-width-1-3@m uk-margin-small" uk-grid>
                <div>
                    <a href="{{ route('checkout') }}" class="uk-button uk-button-text">SHIPPING ADDRESS</a>
                </div>
                <div class="uk-text-center">
                    <button class="uk-button uk-button-text" disabled><b>SHIPPING OPTION</b></button>
                </div>
{{--                 <div class="uk-text-center">
                    <button class="uk-button uk-button-text" disabled>BILLING</button>
                </div> --}}
                <div class="uk-text-center">
                    <button class="uk-button uk-button-text" disabled>REVIEW</button>
                </div>
            </div>
            <hr class="uk-margin-small">
            <span class="uk-text-meta">CHOOSE A SHIPPING METHOD</span>
            <hr class="uk-margin-small">
            <span class="uk-text-meta"><b>TODAY : </b>{{ \Carbon\Carbon::now()->toDayDateTimeString() }}</span>

            <form action="{{ route('checkout.shipping') }}" method="POST">
              {{ csrf_field() }}
            <table class="uk-table uk-table-divider uk-table-hover">
                <tbody>
                    <!-- <tr class="uk-active">
                        <td>
                            <input type="radio" class="uk-radio" name="shipping" value="1" required="required"> </td>
                        <td> DHL Express (3 - 6 Ekonomi Days) </td>
                        <td> IDR 300000,00</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" class="uk-radio" name="shipping" value="2" required=""> </td>
                        <td> DHL Express (3 - 6 Business Days) </td>
                        <td> IDR 500000,00</td>
                    </tr> -->

                    @foreach ($availableCouriersService['available_couriers'] as $availableCouriersService_key => $availableCouriersService_val)

                        @if($availableCouriersService_val['error'] == '000')

                          @if(count($availableCouriersService_val['data']) > 1 )

                            @foreach($availableCouriersService_val['data'] as $dataServices_key => $dataServices_val)

                              <tr>
                                  <td>
                                      <input type="radio" class="uk-radio radio-shipping-cost" name="shipping" value="{{ $availableCouriersService_key }}{{$availableCouriersService_val['separator']}}{{ $dataServices_val->serviceCode }}" required="" onclick="getTotal({{ $dataServices_val->totalFeeDollar }})"> </td>
                                  <td> {{ $dataServices_val->serviceName }} </td>
                                  <td> $ {{ $dataServices_val->totalFeeDollar }}</td>
                              </tr>

                            @endforeach

                          @else

                            <tr>
                                <td>
                                    <input type="radio" class="uk-radio radio-shipping-cost" name="shipping" value="{{ $availableCouriersService_key }}{{ $availableCouriersService_val['separator'] }}{{ $availableCouriersService_val['data']->serviceCode }}" required="" onclick="getTotal({{ $availableCouriersService_val['data']->totalFeeDollar }})"> </td>
                                <td> {{ $availableCouriersService_val['data']->serviceName }} </td>
                                <td> $ {{ $availableCouriersService_val['data']->totalFeeDollar }} </td>
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
            <form>
            <hr class="uk-margin-small">
            <span class="uk-text-meta"><b>SHIPPING DETAILS</b></span>
            <hr class="uk-margin-small">
            <div>
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
            <hr class="uk-margin-small">
              <item-checkout
                 bag_api="{{ route('persist.bag') }}"
                 aws_link="{{ config('filesystems.s3url') }}"
                 default_image="{{ json_encode(config('common.default')) }}"
              ></item-checkout>
            <hr class="uk-margin-small">
        </div>
        <summary-checkout
          shipping_cost="0"
        ></summary-checkout>
    </div>
</div>
@endsection

@section('footer_scripts')
<script type="text/javascript">


   function getTotal(shipingCost){
    var subTotal = $('#sub_total').html();
    var total = parseFloat(subTotal) + parseFloat(shipingCost);

    $('#shiping_fee').html(shipingCost);
    $('#total_fee').html(round(total));
   }

   function round(value) {
      return Number(Math.round(value+'e'+2)+'e-'+2);
   }

   $(function () {

     $("#continue").on('click', function (e) {
       e.preventDefault();
       $('#submit').click();
     });
   })


</script>
@endsection
