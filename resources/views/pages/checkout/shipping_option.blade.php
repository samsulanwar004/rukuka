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
            <div class="uk-grid uk-grid-divider uk-child-width-1-4@m uk-margin-small" uk-grid>
                <div>
                    <a href="{{ route('checkout') }}" class="uk-button uk-button-text">SHIPPING ADDRESS</a>
                </div>
                <div class="uk-text-center">
                    <button class="uk-button uk-button-text" disabled><b>SHIPPING OPTION</b></button>
                </div>
                <div class="uk-text-center">
                    <button class="uk-button uk-button-text" disabled>BILLING</button>
                </div>
                <div class="uk-text-center">
                    <button class="uk-button uk-button-text" disabled>REVIEW</button>
                </div>
            </div>
            <hr class="uk-margin-small">
            <span class="uk-text-meta">CHOOSE A SHIPPING METHOD</span>
            <hr class="uk-margin-small">
            <span class="uk-text-meta"><b>TODAY : </b>{{ \Carbon\Carbon::now()->toDayDateTimeString() }}</span>
            <hr class="uk-margin-small">
            <form action="{{ route('checkout.shipping') }}" method="POST">
              {{ csrf_field() }}
            <table class="uk-table uk-table-divider uk-table-hover">
                <tbody>
                    <tr class="uk-active">
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
                    </tr>
                </tbody>
            </table>
            <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
              <input type="submit" name="submit" id="submit" value="C O N T I N U E" class="uk-button-danger uk-button uk-button-small uk-width-1-1">
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
              ></item-checkout>
            <hr class="uk-margin-small">
        </div>
        <summary-checkout></summary-checkout>
    </div>
</div>
@endsection

@section('footer_scripts')
<script type="text/javascript">
   $(function () {

     $("#continue").on('click', function (e) {
       e.preventDefault();
       var submit = $('#submit').val();
       var url = '{{ route('checkout.billing') }}';
       if (submit == 'C O N T I N U E') {
         $('#submit').click();
       } else {
         window.location.href = url;
       }

     });
   })
</script>
@endsection
