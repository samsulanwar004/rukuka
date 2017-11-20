@extends('app')

@section('content')
<div class="uk-container uk-container-small">
  <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
  </div>
  <bag
    bag_link="{{ route('persist.bag') }}"
    wishlist_link="{{ route('persist.wishlist') }}"
    auth="{{ Auth::check() ? 1 : 0 }}"
    checkout_link="{{ route('checkout') }}"
  ></bag>

  
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
