@extends('app')

@section('content')

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
@if($categories == 'designers')
  <div class="uk-grid-small uk-section-muted" uk-grid>
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

<div class="uk-grid-small uk-margin-top uk-margin-large-bottom" uk-grid>
<div class="uk-width-1-4@m">
  <div class="uk-card-border uk-card-small uk-panel uk-sticky uk-sticky-fixed uk-active" uk-sticky="offset: 115; bottom:#viewport">
    <div class="uk-card-header uk-card-secondary">


      @if($categories == 'designers')
        {{ ucfirst($category) }}
      @else
        @if($category == 'all')
          All
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
    <div class="uk-grid-small uk-child-width-1-2@m uk-flex-center" uk-grid>
      <div class="uk-text-left">
        Sort by price: <a href="?price=desc" class="uk-text-muted">high</a> | <a href="?price=asc" class="uk-text-muted">low</a>
        </div>
        <div class="uk-text-right">
          @include('pagination.default', ['paginator' => $products])
        </div>
      </div>
      <div class="uk-grid-small uk-child-width-1-3@m uk-flex-center" uk-grid>
      @forelse($products as $product)
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
       @empty
          Product not available
       @endforelse
      </div>
      <hr>
      <div class="uk-grid-small uk-child-width-1-2@m uk-flex-center" uk-grid>
        <div class="uk-text-left">
          Sort by price: <a href="?price=desc" class="uk-text-muted">high</a> | <a href="?price=asc" class="uk-text-muted">low</a>
          </div>
            <div class="uk-text-right">
              @include('pagination.default', ['paginator' => $products])
            </div>
        </div>

  </div>
</div>

</div>
@endsection
