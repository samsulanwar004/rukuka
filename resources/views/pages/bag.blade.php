@extends('app')
@section('title', trans('app.title_bag') )
@section('content')
<div class="uk-container">
  <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
  </div>
  <bag
    bag_link="{{ route('persist.bag') }}"
    wishlist_link="{{ route('persist.wishlist') }}"
    auth="{{ Auth::check() ? 1 : 0 }}"
    checkout_link="{{ route('checkout') }}"
    aws_link="{{ config('filesystems.s3url') }}"
    default_image="{{ json_encode(config('common.default')) }}"
    locale="{{ json_encode(trans('app')) }}"
    bag_count="{{ count($bags) }}"
    discount="{{ $discount }}"
  ></bag>
  <hr class="uk-margin-large uk-padding-large" style="border-color: #333; border-width: 3px">
  @if($recently)
  <div class="uk-grid-small uk-margin-small-bottom uk-margin-large-top">
      <div class="uk-panel">
          <h4 class="uk-margin-small uk-text-uppercase">{{ trans(('app.recently')) }}</h4>
      </div>
  </div>
  <related
    api="{{ route('recently') }}"
    menu ="{{ $menu }}"
    product_api="{{ route('product.api') }}"
    bag_api="{{ route('persist.bag') }}"
    wishlist_api="{{ route('persist.wishlist') }}"
    auth="{{ Auth::check() ? 1 : 0 }}"
    aws_link="{{ config('filesystems.s3url') }}"
    default_image="{{ json_encode(config('common.default')) }}"
    recently="{{ json_encode($recently) }}"
    bag_link="{{ route('bag') }}"
    locale="{{ json_encode(trans('app')) }}"
  ></related>
  @endif
</div>
@endsection
