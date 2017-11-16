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
      <span class="uk-text-meta"><b>TODAY :</b> THURSDAY, NOVEMBER 15th</span>
      <hr class="uk-margin-small">
      <table class="uk-table uk-table-divider uk-table-hover">
        <tbody>
          <tr class="uk-active">
            <td> <input type="radio" name="shipoption" value="1"> </td>
            <td> DHL Express (3 - 6 Business Days) </td>
            <td> IDR 540000,00</td>
          </tr>
          <tr>
            <td> <input type="radio" name="shipoption" value="1"> </td>
            <td> DHL Express (3 - 6 Business Days) </td>
            <td> IDR 540000,00</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="uk-width-1-4@m">
      <div class="uk-card uk-card-border uk-card-default uk-card-small">
        <div class="uk-card-header">
          <b>SUMMARY</b>
        </div>
        <div class="uk-card-body">
          <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
            <div class="uk-text-small"><b>SUBTOTAL</b></div>
            <div class="uk-text-right">{{ subtotal }}</div>
          </div>
          <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
            <div class="uk-text-small">Shipping Cost</div>
            <div class="uk-text-right">FREE</div>
          </div>
          <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
            <div class="uk-text-small">Tax</div>
            <div class="uk-text-right">FREE</div>
          </div>
        </div>
        <div class="uk-card-footer">
          <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
            <div><b>TOTAL</b></div>
            <div class="uk-text-right">{{ subtotal }}</div>
          </div>
        </div>

        </div>
        <div class="uk-panel uk-margin-small-top">
          <a href="{{ route('checkout.shipping') }}" class="uk-button uk-button-small uk-button-danger uk-width-1-1">C O N T I N U E</a>
        </div>
        <hr>
        <div class="uk-card uk-card-default uk-card-border uk-card-small">
          <div class="uk-card-header">
            PROMO CODE
          </div>
          <div class="uk-card-body">

          </div>
        </div>
      </div>
    </div>
</div>
@endsection
