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
    aws_link="{{ config('filesystems.s3url') }}"
  ></bag>
  <hr>
  <div class="uk-grid-small uk-margin-small-bottom uk-margin-top">
    <div class="uk-panel">
      <span class="uk-text-lead">RELATED PRODUCTS</span>
    </div>
  </div>
  <related 
    api="{{ route('related', ['categoryId' => $categoryId]) }}"
    product_api="{{ route('product.api') }}"
    bag_api="{{ route('persist.bag') }}"
    wishlist_api="{{ route('persist.wishlist') }}"
    auth="{{ Auth::check() ? 1 : 0 }}"
    aws_link="{{ config('filesystems.s3url') }}"
  ></related>
  <div class="uk-grid-small uk-margin-small-bottom uk-margin-medium-top uk-margin-xlarge-bottom">
    <div class="uk-panel uk-text-center">
      <button class="uk-button uk-button-secondary">SHOW ALL PRODUCT</button>
    </div>
  </div>
</div>
@endsection
