@extends('app')

@section('content')

<div class="uk-grid-small uk-margin-top" uk-grid>
  <div class="uk-width-3-5@m">
    <div uk-grid>
        <div class="uk-width-auto@m">
            <ul class="uk-tab-left" uk-tab="connect: #component-tab-left; animation: uk-animation-fade">
                @foreach($product->images as $image)
                  <li><a href="#"><img src="/{{ $image->photo }}" alt="" width="80"></a></li>
                @endforeach
            </ul>

        </div>
        <div class="uk-width-expand@m">
            <ul id="component-tab-left" class="uk-switcher">
                @foreach($product->images as $image)
                  <li><a href="#"><img src="/{{ $image->photo }}" alt="" width="450"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
  </div>
  <div class="uk-width-2-5@m">
    <h4 class="uk-margin-remove"><a href="#" class="uk-text-muted">{{ $product->designer->name }}</a></h4>
    <h3 class="uk-margin-remove">{{ $product->name }}</h3>
    <h3 class="uk-margin-remove">{{ $product->currency }} {{ number_format($product->sell_price) }}</h3>
    <span class="uk-text-meta uk-text-bold">
      <span uk-icon="icon: star"></span>
      <span uk-icon="icon: star"></span>
      <span uk-icon="icon: star"></span>
      <span uk-icon="icon: star"></span>
      <span uk-icon="icon: star"></span>

    </span>
    <ul uk-accordion="animation: true; multiple: false">
        <li class="uk-open">

            <h5 class="uk-accordion-title">EDITORS NOTES</h5>
            <div class="uk-accordion-content uk-text-small">
              {{ $product->content }}
            </div>

        </li>
        <li>

            <h5 class="uk-accordion-title">SIZE & FIT</h5>
            <div class="uk-accordion-content uk-text-small">
              {{ $product->size_and_fit }}
            </div>

        </li>
        <li>

            <h5 class="uk-accordion-title">DETAILS & CARE</h5>
            <div class="uk-accordion-content uk-text-small">
              {{ $product->detail_and_care }}
            </div>

        </li>
        <li>

            <h5 class="uk-accordion-title">DELIVERY & FREE RETURNS</h5>
            <div class="uk-accordion-content uk-text-small">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>

        </li>
    </ul>
    <div class="uk-child-width-1-2" uk-grid>
      <div class="">
        Color : {{ $product->color }}
      </div>
      <div class="">
        <select class="uk-select">
          <option>Select Size</option>
          @foreach($product->stocks as $stock)
            <option value="{{ $stock->id }}">{{ $stock->size }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="uk-child-width-1-2 uk-margin-small-top" uk-grid>
      <div class="">
        <button class="uk-button uk-button-secondary uk-text-bold uk-padding-small-right"><span class="uk-margin-small-right uk-icon" uk-icon="icon: cart; ratio:0.8"></span> ADD TO BAG </button>
      </div>
      <div class="">
        <button class="uk-button uk-button-default uk-text-bold uk-padding-small-right">ADD TO WHISHLIST</button>
      </div>
    </div>
    <hr>
    <p class="uk-margin-remove uk-text-meta">
      <ul class="uk-grid-small uk-flex-middle uk-flex-center" uk-grid>
        <li><a class="uk-icon-link" uk-icon="icon: twitter"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: pinterest"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: facebook"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: google-plus"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: instagram"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: tumblr"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: mail"></a></li>
      </ul>
    </p>
    <hr class="uk-margin-small">
    <div class="uk-child-width-1-3 uk-margin-top uk-grid-divider uk-flex-middle uk-flex-center" uk-grid>
      <div class="uk-text-center">
        Product Code: <br>
          <b>{{ $product->product_code }}</b>
      </div>
      <div class="uk-text-center">
        View More
        Pyjamas
        <a href="#" class="uk-text-muted">{{ $product->designer->name }}</a>
      </div>
      <div class="uk-text-center">
        <a href="#" class="uk-text-muted">  Contact Us </a>
        <a href="#" class="uk-text-muted">Give Feedback </a>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="uk-grid-small uk-margin-small-bottom uk-margin-top">
  <div class="uk-panel uk-text-center">
    <h3>RELATED PRODUCTS</h3>
  </div>
</div>
<div class="uk-grid-small uk-child-width-1-4@m uk-margin-large-bottom" uk-grid>
  <!-- start product -->
  <div class="uk-panel uk-text-left">
    <div class="uk-card uk-card-small uk-padding-remove">
        <div class="uk-card-media-top">
            <img src="images/2_2.jpg" alt="">

        </div>
        <div class="uk-card-body uk-padding-remove uk-margin-small-top">
            <a href="#" class="uk-text-muted">Slim-Fit Stretch-Cotton Twill Bermuda</a>
            <br>
            <span class="uk-text-bold">$333</span>
        </div>
        <!-- <div class="uk-card-footer">
          <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
        </div> -->
    </div>
  </div>
  <!-- end product single -->
  <!-- start product -->
  <div class="uk-panel uk-text-left">
    <div class="uk-card uk-card-small uk-padding-remove">
        <div class="uk-card-media-top">
            <img src="images/6_2.jpg" alt="">
        </div>
        <div class="uk-card-body uk-padding-remove uk-margin-small-top">
            <a href="#" class="uk-text-muted">Slim-Fit Stretch-Cotton Twill Bermuda</a>
            <br>
            <span class="uk-text-bold">$333</span>
        </div>
        <!-- <div class="uk-card-footer">
          <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
        </div> -->
    </div>
  </div>
  <!-- end product single -->
  <!-- start product -->
  <div class="uk-panel uk-text-left">
    <div class="uk-card uk-card-small uk-padding-remove">
        <div class="uk-card-media-top">
            <img src="images/10_1.jpg" alt="">
        </div>
        <div class="uk-card-body uk-padding-remove uk-margin-small-top">
            <a href="#" class="uk-text-muted">Slim-Fit Stretch-Cotton Twill Bermuda</a>
            <br>
            <span class="uk-text-bold">$333</span>
        </div>
        <!-- <div class="uk-card-footer">
          <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
        </div> -->
    </div>
  </div>
  <!-- end product single -->
  <!-- start product -->
  <div class="uk-panel uk-text-left">
    <div class="uk-card uk-card-small uk-padding-remove">
        <div class="uk-card-media-top">
            <img src="images/2_2.jpg" alt="">
        </div>
        <div class="uk-card-body uk-padding-remove uk-margin-small-top">
            <a href="#" class="uk-text-muted">Slim-Fit Stretch-Cotton Twill Bermuda</a>
            <br>
            <span class="uk-text-bold">$333</span>
        </div>
        <!-- <div class="uk-card-footer">
          <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
        </div> -->
    </div>
  </div>
  <!-- end product single -->

</div>
<div class="uk-grid-small uk-margin-small-bottom uk-margin-medium-top uk-margin-xlarge-bottom">
  <div class="uk-panel uk-text-center">
    <button class="uk-button uk-button-secondary">SHOW ALL PRODUCT</button>
  </div>
</div>
@endsection