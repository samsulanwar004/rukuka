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
      @if($product->price_before_discount > 0)
          <b>
              <span style="text-decoration: line-through;">{{ $product->currency }} {{ number_format($product->price_before_discount) }}</span>
              <span class="uk-text-danger">{{ $product->currency }} {{ number_format($product->sell_price) }}</span>
          </b>
          @else
          <b>{{ $product->currency }} {{ number_format($product->sell_price) }} </b>
      @endif

      <br>
    <span class="uk-text-meta uk-text-bold">
          <div class="stars-product uk-margin-remove-left">
              <input type="radio" name="star-m" class="star-1" value="1" {{$rating == 1? 'checked':'' }}/>
              <label for="star-1">1</label>
              <input type="radio" name="star-m" class="star-2" value="2" {{$rating == 2? 'checked':'' }}/>
              <label for="star-2">2</label>
              <input type="radio" name="star-m" class="star-3"  value="3" {{$rating == 3? 'checked':'' }}/>
              <label for="star-3">3</label>
              <input type="radio" name="star-m" class="star-4" value="4" {{$rating == 4? 'checked':'' }}/>
              <label for="star-4">4</label>
              <input type="radio" name="star-m" class="star-5"  value="5" {{$rating == 5? 'checked':'' }}/>
              <label for="star-5">5</label>
              <span></span>
          </div>
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
        <a href="{{ route('shop', ['categories' => 'designers', 'category' => $product->designer->slug ]) }}" class="uk-text-muted">{{ $product->designer->name }}</a>
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
  <div class="uk-width-1-4@m">
    <a href="/{{'review/'.$product->slug}}" class="uk-button uk-button-default">WRITE A REVIEW</a>
  </div>
    @if($rating)
        <div class="uk-width-1-4@m">
          <span class="uk-margin-remove-right">RATING FOR THIS PRODUCT :</span>
      </div>
        <div class="uk-width-1-4@m">
            <div class="stars-product uk-margin-remove">
                <input type="radio" name="star" class="star-1" value="1" {{$rating == 1? 'checked':'' }}/>
                <label for="star-1">1</label>
                <input type="radio" name="star" class="star-2" value="2" {{$rating == 2? 'checked':'' }}/>
                <label for="star-2">2</label>
                <input type="radio" name="star" class="star-3"  value="3" {{$rating == 3? 'checked':'' }}/>
                <label for="star-3">3</label>
                <input type="radio" name="star" class="star-4" value="4" {{$rating == 4? 'checked':'' }}/>
                <label for="star-4">4</label>
                <input type="radio" name="star" class="star-5"  value="5" {{$rating == 5? 'checked':'' }}/>
                <label for="star-5">5</label>
                <span></span>
            </div>
        </div>
    @else
        WHAT OTHER SHOPPERS THINK: <br>
        There are no reviews for this product. Be the first to comment.
    @endif
</div>
<div class="uk-grid uk-visible@m" uk-grid>
    @foreach($product->review as $review)
      <div class="uk-width-1-3@m">
        <div class="uk-card uk-card-border uk-card-small">
          <div class="uk-card-body">
                  <div class="stars-product uk-margin-remove">
                      <input type="radio" name="star-{{$review->id}}" class="star-1" value="1" {{$review->rating == 1? 'checked':'' }}/>
                      <label for="star-1">1</label>
                      <input type="radio" name="star-{{$review->id}}" class="star-2" value="2" {{$review->rating == 2? 'checked':'' }}/>
                      <label for="star-2">2</label>
                      <input type="radio" name="star-{{$review->id}}" class="star-3"  value="3" {{$review->rating == 3? 'checked':'' }}/>
                      <label for="star-3">3</label>
                      <input type="radio" name="star-{{$review->id}}" class="star-4" value="4" {{$review->rating == 4? 'checked':'' }}/>
                      <label for="star-4">4</label>
                      <input type="radio" name="star-{{$review->id}}" class="star-5"  value="5" {{$review->rating == 5? 'checked':'' }}/>
                      <label for="star-5">5</label>
                      <span></span>
                  </div>
              <div class="uk-text-bold uk-text-center uk-margin-top-small">
                  {{$review->title}}
              </div>
              <div class="uk-text-small uk-text-muted uk-text-center">
                  {{date_format($review->created_at,"F j, Y")}}
              </div>
              <div class="uk-text-left uk-margin-small-top">
                  "{{$review->review}}"
              </div>
              <div class="uk-text-small uk-text-left uk-margin-small-top">
                  {{ ucfirst($review->user->first_name).' '.ucfirst($review->user->last_name) }}
              </div>
              <div class="uk-text-small uk-text-muted uk-text-left">
                  {{$review->location}}
              </div>
          </div>
        </div>
      </div>
    @endforeach
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
    <a  href="{{route('search')}}" class="uk-button uk-button-secondary">SHOW ALL PRODUCT</a>
  </div>
</div>
</div>
@endsection
