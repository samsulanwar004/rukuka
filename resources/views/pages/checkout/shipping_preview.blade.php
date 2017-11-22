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
                    <a href="{{ route('checkout') }}" class="uk-button uk-button-text">SHIPPING OPTION</a>
                </div>
                <div class="uk-text-center">
                    <a href="{{ route('checkout') }}" class="uk-button uk-button-text">BILLING</a>
                </div>
                <div class="uk-text-center">
                    <button class="uk-button uk-button-text" disabled><b>REVIEW</b></button>
                </div>
            </div>
            <hr class="uk-margin-small">
            <h4 class="uk-margin-remove">PLEASE CONFIRM YOUR ORDER</h4>

              <hr class="uk-margin-small">
              <b>BILLING OPTION</b>
              <hr class="uk-margin-small">
              <div class="uk-grid uk-grid-small" grid>
                <div class="uk-width-1-3@m">
                  <ul class="uk-list uk-text-meta">
                      <li>Joko Susilo</li>
                      <li>Ku Ka</li>
                      <li>Yogyakarta</li>
                      <li>Kota Gede</li>
                      <li>Yogyakarta, Indonesia 55872</li>
                      <li>Indonesia</li>
                      <li>6287839525707</li>
                  </ul>
                </div>
                <div class="uk-width-1-3@m">
                  <ul class="uk-list uk-text-meta">
                      <li>Master Card</li>
                      <li>*** *** *** *** 213</li>
                      <li>logo master card</li>
                      <li>kak emma</li>
                      <li>IDR 4939200.00</li>
                  </ul>
                </div>
              </div>
            <hr class="uk-margin-small">
            <b>SHIPPING DETAILS</b>
            <hr class="uk-margin-small">
            <div class="uk-grid uk-grid-small" grid>
              <div class="uk-width-1-3@m">
                <ul class="uk-list uk-text-meta">
                    <li>Joko Susilo</li>
                    <li>Ku Ka</li>
                    <li>Yogyakarta</li>
                    <li>Kota Gede</li>
                    <li>Yogyakarta, Indonesia 55872</li>
                    <li>Indonesia</li>
                    <li>6287839525707</li>
                </ul>
              </div>
              <div class="uk-width-2-3@m">
                TODAY: Monday, November 20th
                <table class="uk-table uk-table-divider uk-table-hover">
                    <tbody>
                        <tr class="uk-active">
                            <td>
                                <input type="radio" class="uk-radio" name="shipping" value="1" required="required" checked> </td>
                            <td> DHL Express (3 - 6 Ekonomi Days) </td>
                            <td> IDR 300000,00</td>
                        </tr>
                    </tbody>
                </table>
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
