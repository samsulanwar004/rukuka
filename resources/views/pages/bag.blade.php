@extends('app')

@section('content')
<div class="uk-container uk-container-small">
  <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
  </div>
  <div class="uk-grid-small uk-margin-top">
    <h2 class="uk-text-center">SHOPPING BAG</h2>
    <p class="uk-text-center">NEED HELP?  CALL US: +44 (0)20 3471 4090 |  <a href="#" class="uk-text-muted">EMAIL CUSTOMER CARE</a> |
      <a href="#" class="uk-text-muted">SHIPPING INFORMATION</a>  |  <a href="#" class="uk-text-muted">RETURNS & EXCHANGES</a></p>
    <hr>
    <p class="uk-text-right"><button class="uk-button uk-button-secondary uk-text-bold uk-padding-small-right">PROCEED TO PURCHASE</button></p>
  </div>
  <bag
    bag_link="{{ route('persist.bag') }}"
  ></bag>

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
</div>
@endsection
