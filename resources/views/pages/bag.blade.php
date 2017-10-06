@extends('app')

@section('content')

<div class="uk-grid-small uk-margin-top">
  <h2 class="uk-text-center">SHOPPING BAG</h2>
  <p class="uk-text-center">NEED HELP?  CALL US: +44 (0)20 3471 4090 |  <a href="#" class="uk-text-muted">EMAIL CUSTOMER CARE</a> |
    <a href="#" class="uk-text-muted">SHIPPING INFORMATION</a>  |  <a href="#" class="uk-text-muted">RETURNS & EXCHANGES</a></p>
  <hr>
  <p class="uk-text-right"><button class="uk-button uk-button-secondary uk-text-bold uk-padding-small-right">PROCEED TO PURCHASE</button></p>
</div>
<div class="uk-grid-small uk-margin-top" uk-grid>
  <table class="uk-table uk-table-divider" width="1000">
      <thead>
          <tr>
              <th class="uk-table-shrink">ITEM</th>
              <th class="uk-table-expand">DESCRIPTION</th>
              <th class="uk-table-shrink">COLOR</th>
              <th class="uk-table-shrink">SIZE</th>
              <th class="uk-width-medium">QTY</th>
              <th class="uk-table-shrink uk-text-nowrap">UNIT PRICE</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td rowspan="2"><img class="uk-preserve-width" src="images/2_2.jpg" width="130" alt=""></td>
              <td class="uk-table-link">
                  <a class="uk-link-reset" href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
              </td>
              <td>WHITE</td>
              <td class="uk-text-truncate">L</td>
              <td class="uk-text-nowrap">
                <ul class="uk-grid-small uk-flex-middle" uk-grid>
                  <li><a class="uk-icon-button" uk-icon="icon: minus"></a></li>
                  <li><input type="text" class="uk-input uk-form-width-xsmall uk-form-small" value="1"></li>
                  <li><a class="uk-icon-button" uk-icon="icon: plus"></a></li>
                </ul>
              </td>
              <td class="uk-text-nowrap">$340.00</td>
          </tr>
          <tr class="uk-background-muted">
            <td colspan="3"></td>
            <td colspan="2" class="uk-text-right">
              <button class="uk-button uk-button-small uk-button-default uk-padding-small-right uk-margin-remove">MOVE TO WISHLIST</button>
              <button class="uk-button uk-button-small uk-button-default uk-padding-small-right uk-text-right">REMOVE FROM BAG</button>
            </td>
          </tr>          
      </tbody>
  </table>
</div>
<hr>
<div class="uk-flex uk-flex-right uk-child-width-1-6">
  <div class="">
    ITEM TOTAL
    <br>
    SHIPPING
    <p>
    <b>TOTAL</b>
    </p>
  </div>
  <div class="uk-text-right">
    $1204.00
    <br>
    free
    <p>
    $1204.00
  </p>
  </div>

</div>
<p class="uk-text-right"><button class="uk-button uk-button-secondary uk-text-bold uk-padding-small-right">PROCEED TO PURCHASE</button></p>
  <hr>
  <div class="uk-grid-small uk-margin-small-bottom uk-margin-top">
    <div class="uk-panel uk-text-center">
      <h3>RELATED PRODUCTS</h3>
    </div>
  </div>
<related api="{{ route('related', ['categoryId' => '2']) }}"></related>
<div class="uk-grid-small uk-margin-small-bottom uk-margin-medium-top uk-margin-xlarge-bottom">
  <div class="uk-panel uk-text-center">
    <button class="uk-button uk-button-secondary">SHOW ALL PRODUCT</button>
  </div>
</div>
@endsection