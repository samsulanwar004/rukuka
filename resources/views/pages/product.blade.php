@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
    @include('partials.alert')
</div>
<div class="uk-grid-small uk-margin-top" uk-grid>
  <div class="uk-width-3-5@m">
    <div uk-grid>
        <div class="uk-width-auto@m uk-visible@m">
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
        <div class="uk-width-auto@m uk-hidden@m uk-margin-small">
            <ul class="uk-margin-remove uk-padding-remove" uk-tab="connect: #component-tab-left; animation: uk-animation-fade">
                @foreach($product->images as $image)
                  <li><a href="#"><img src="/{{ $image->photo }}" alt="" width="50"></a></li>
                @endforeach
            </ul>

        </div>
    </div>
  </div>
  <div class="uk-width-2-5@m">
    <a href="{{ route('shop', ['categories' => 'designers', 'category' => $product->designer->slug ]) }}">{{ $product->designer->name }}</a><br>
    <span class="uk-text-lead">{{ $product->name }}</span><br>
    <b>{{ $product->currency }} {{ number_format($product->sell_price) }} </b><br>
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
            <div class="uk-accordion-content">
              {{ $product->content }}
            </div>

        </li>
        <li>

            <h5 class="uk-accordion-title">SIZE & FIT</h5>
            <div class="uk-accordion-content">
              {{ $product->size_and_fit }}
            </div>

        </li>
        <li>

            <h5 class="uk-accordion-title">DETAILS & CARE</h5>
            <div class="uk-accordion-content">
              {{ $product->detail_and_care }}
            </div>

        </li>
        <li>

            <h5 class="uk-accordion-title">DELIVERY & FREE RETURNS</h5>
            <div class="uk-accordion-content">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>

        </li>
    </ul>
    <button-buy
      api_bag="{{ route('persist.bag') }}"
      api_wishlist="{{ route('persist.wishlist') }}"
      color="{{ $product->color }}"
      sizes="{{ $product->stocks }}"
      auth="{{ Auth::check() ? 1 : 0 }}"
      method="{{ $method }}"
      sku="{{ $sku }}"
      id="{{ $id }}"
      bag_link="{{ route('bag') }}"
      wishlist_link="{{ route('user.wishlist') }}"
    ></button-buy>
    <hr>
    <p class="uk-margin-remove uk-text-meta">
      <ul class="uk-grid-small uk-flex-middle uk-flex-center" uk-grid>
        <li><a class="uk-icon-link" uk-icon="icon: twitter" target="_blank" href="{{ $share['twitter']}}"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: pinterest" target="_blank" href="{{ $share['pinterest']}}"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: facebook" target="_blank" href="{{ $share['facebook']}}"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: google-plus" target="_blank" href="{{ $share['gplus']}}"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: instagram"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: tumblr" target="_blank" href="{{ $share['tumblr']}}"></a></li>
        <li><a class="uk-icon-link" uk-icon="icon: mail" target="_blank" href="{{ $share['gmail']}}"></a></li>
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
        <a href="{{ route('shop', ['categories' => strtolower($product->category->parent->parent->name) ,'category' => strtolower($product->category->parent->name), 'slug' => $product->category->slug]) }}">{{ $product->category->name }}</a>
        <a href="#" class="uk-text-muted">{{ $product->designer->name }}</a>
      </div>
      <div class="uk-text-center">
        <a href="#" class="uk-text-muted"> Contact Us </a>
        <a href="#" class="uk-text-muted">Give Feedback </a>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="uk-panel uk-grid" uk-grid>
  <div class="uk-width-1-3@m">
    <a href="#" class="uk-button uk-button-default">WRITE A REVIEW</a>
  </div>
  <div class="uk-width-2-3@m">
    RATING FOR THIS PRODUCT : 3.5
  </div>
</div>
<div class="uk-grid uk-visible@m" uk-grid>
  <div class="uk-width-1-3@m">
    <div class="uk-card uk-card-border uk-card-small">
      <div class="uk-card-body">
        <div class="uk-text-center">
          This Absolutely Gorgeous!
        </div>
      </div>
    </div>
  </div>
  <div class="uk-width-1-3@m">
    <div class="uk-card uk-card-border uk-card-small">
      <div class="uk-card-body">
        <div class="uk-text-center">
          This Absolutely Gorgeous!
        </div>
      </div>
    </div>
  </div>
  <div class="uk-width-1-3@m">
    <div class="uk-card uk-card-border uk-card-small">
      <div class="uk-card-body">
        <div class="uk-text-center">
          This Absolutely Gorgeous! <br>

        </div>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="uk-grid-small uk-margin-small-bottom uk-margin-top">
  <div class="uk-panel">
    <span class="uk-text-lead">RELATED PRODUCT</span>
  </div>
</div>
<related 
  api="{{ route('related', ['categoryId' => $product->product_categories_id]) }}"
  product_api="{{ route('product.api') }}"
  bag_api="{{ route('persist.bag') }}"
  wishlist_api="{{ route('persist.wishlist') }}"
  auth="{{ Auth::check() ? 1 : 0 }}"
></related>
<div class="uk-grid-small uk-margin-small-bottom uk-margin-medium-top uk-margin-xlarge-bottom">
  <div class="uk-panel uk-text-center">
    <button class="uk-button uk-button-secondary">SHOW ALL PRODUCT</button>
  </div>
</div>
</div>
@endsection
