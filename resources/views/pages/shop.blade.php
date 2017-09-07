@extends('app')

@section('content')
<div class="uk-grid-small uk-margin-top" uk-grid>
<div class="uk-text-center">
  <div class="uk-inline-clip uk-transition-toggle uk-dark">
      <img src="/images/baner-home.png" alt="">
      <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
      <!-- <div class="uk-overlay uk-overlay-default uk-padding-small uk-position-medium uk-position-bottom-right">HOT DEALS THIS WEEKEND, WITH 50% DISCOUNT, <br>
        SIGN UP NOW, ON KUKAINDONESIA.COM
      </div> -->
  </div>
</div>
</div>

<div class="uk-grid-small uk-margin-top">
@include('partials.breadcrumb')
</div>
<div class="uk-grid-small uk-margin-top uk-grid-divider uk-margin-large-bottom" uk-grid>
<div class="uk-width-1-5@m">
  <div class="uk-panel">
    <h3 class="uk-heading-divider">Casual Shirts</h3>
    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
        <li class="uk-active"><a href="#">All</a></li>
        <li class="uk-parent">
            <a href="#">ACCESSORIES</a>
            <ul class="uk-nav-sub">
                <li><a href="#">Sub item</a></li>
                <li><a href="#">Sub item</a></li>
            </ul>
        </li>
        <li class="uk-parent">
            <a href="#">CLOTHING</a>
            <ul class="uk-nav-sub">
                <li><a href="#">Sub item</a></li>
                <li><a href="#">Sub item</a></li>
            </ul>
        </li>
        <li class="uk-parent">
            <a href="#">SHOES</a>
            <ul class="uk-nav-sub">
                <li><a href="#">Sub item</a></li>
                <li><a href="#">Sub item</a></li>
            </ul>
        </li>
    </ul>
  </div>
</div>
<div class="uk-width-expand@m">
  <div class="uk-panel">
    <div class="uk-grid-small uk-child-width-1-2@m uk-flex-center" uk-grid>
      <div class="uk-text-left">
        Sort by price: <a href="#" class="uk-text-muted">high</a> | <a href="#" class="uk-text-muted">low</a>
        </div>
        <div class="uk-text-right">
          Page : 1 of 2  &nbsp;

              <a class="uk-icon-link" uk-icon="icon: chevron-left"></a>
              <a class="uk-icon-link" uk-icon="icon: chevron-right"></a>

          </div>
      </div>
      <div class="uk-grid-small uk-child-width-1-3@m uk-flex-center" uk-grid>
      @foreach($products as $product)
        <!-- start product -->
        <div class="uk-panel uk-text-left">
          <div class="uk-card uk-card-small uk-padding-remove">
              <div class="uk-card-media-top">
                  <img src="/{{ $product->images->first()->photo }}" alt="">

              </div>
              <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="/product/{{ $product->slug }}" class="uk-text-muted">
                  	{{ $product->name }}
                  </a>
                  <br>
                  <span>{{ $product->currency }} {{ number_format($product->sell_price) }}</span>
              </div>
{{--               <div class="uk-card-footer">
                <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
              </div> --}}
          </div>
        </div>
        <!-- end product single -->
       @endforeach
      </div>
      <hr>
      <div class="uk-grid-small uk-child-width-1-2@m uk-flex-center" uk-grid>
        <div class="uk-text-left">
          Sort by price: <a href="#" class="uk-text-muted">high</a> | <a href="#" class="uk-text-muted">low</a>
          </div>
          <div class="uk-text-right">
            Page : 1 of 2  &nbsp;

                <a class="uk-icon-link" uk-icon="icon: chevron-left"></a>
                <a class="uk-icon-link" uk-icon="icon: chevron-right"></a>

            </div>
        </div>
  </div>
</div>

</div>
@endsection