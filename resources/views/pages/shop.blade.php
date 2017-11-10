@extends('app')

@section('content')
<div class="uk-container uk-container-small">
@if($categories == 'designers')
  <div class="uk-grid-small uk-margin-top uk-section-muted" uk-grid>
    <div class="uk-panel uk-width-1-5@m uk-flex uk-flex-middle uk-flex-center">

        <img src="/{{ $designer->photo }}" width="120" alt="" class="uk-box-shadow-medium">



    </div>
    <div class="uk-panel uk-width-2-5@m">
      <h2 class="uk-margin-small">{{ $designer->name }}</h2>
      <h3 class="uk-margin-small">{{ $designer->content }}</h3>
    </div>
    <div class="uk-panel uk-width-2-5@m">
      <img src="/{{ $designer->banner }}" width="200" alt="">
    </div>
  </div>

@else

@endif
<div class="uk-grid-small uk-margin-top">
@if($categories == 'designers')
  @include('partials.breadcrumb', [
      'breadcrumbs' => [$categories => '/shop/'.$categories.'/all', $category => 'categories']
  ])
@else
  @if($category == 'all')
    @include('partials.breadcrumb', [
      'breadcrumbs' => [$categories => '/shop/'.$categories.'/all', $category => 'categories']
    ])
  @else
    @include('partials.breadcrumb', [
        'breadcrumbs' => [$categories => '/shop/'.$categories.'/all', $category => false, isset($products->first()->category->name) ? $products->first()->category->name : 'Product not available' => 'categories']
    ])
  @endif
@endif
</div>


<div class="uk-grid-small uk-margin-top uk-margin-large-bottom" uk-grid>
<div class="uk-width-1-4@m">
  <div class="uk-card uk-card-default uk-card-border uk-card-small uk-panel">
    <div class="uk-card-header">


      @if($categories == 'designers')
        {{ ucfirst($category) }}
      @else
        @if($category == 'all')
          <b>ALL</b>
        @else
          {{ isset($products->first()->category->name) ? $products->first()->category->name : 'Product not available' }}
        @endif
      @endif
      </div>
      <div class="uk-card-body">
      <categories api="{{ route('menu', ['parent' => $categories]) }}" parent="{{ $categories }}">
      </categories>
    </div>
  </div>
</div>
<div class="uk-width-expand@m">
  <div class="uk-panel">

      <div class="uk-grid-small uk-child-width-1-3@m uk-flex-center" uk-grid>
      @forelse($products as $product)
        <div class="uk-panel uk-visible-toggle">


        <!-- start product -->
        <div class="uk-panel uk-text-left">
          <div class="uk-card uk-card-small uk-card-default">
              <div class="uk-card-media-top">
                  <img src="/{{ $product->images->first()->photo }}" alt="">

              </div>
              <div class="uk-card-body">
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
        <!-- start product -->
        <div class="uk-panel uk-position-cover-card uk-invisible-hover">
          <div class="uk-panel uk-text-left">
            <div class="uk-card uk-card-small uk-card-default">
                <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
                    <img src="/{{ $product->images->first()->photo }}" alt="">
                    <div class="uk-position-bottom-center uk-position-medium">
                      <a href="#" class="uk-button uk-button-small uk-button-secondary">QUICK SHOP</a>
                    </div>
                </div>
                <div class="uk-card-body">
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
        </div>
        <!-- end product single -->
        </div>

       @empty
          Product not available
       @endforelse
      </div>
      <hr>
      <div class="uk-grid-small uk-child-width-1-2@m uk-flex-center" uk-grid>
        <div class="uk-text-left">
          <span class="uk-text-meta">Sort by price : <a href="?price=desc">high</a> | <a href="?price=asc">low</a></span>
          </div>
          <div class="uk-text-right">
            <span class="uk-text-meta">
            @include('pagination.default', ['paginator' => $products])
            </span>
          </div>
        </div>

  </div>
</div>

</div>
</div>
@endsection
