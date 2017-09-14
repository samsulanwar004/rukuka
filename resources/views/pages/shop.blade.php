@extends('app')

@section('content')

<div class="uk-grid-small uk-margin-top">
@if($slug == 'all')
  @include('partials.breadcrumb', [
      'breadcrumbs' => [$category => '/shop/'.$category.'/all', 'All' => 'categories']
  ])
@else
  @if($category == 'designers')
    @include('partials.breadcrumb', [
        'breadcrumbs' => [$category => '/shop/'.$category.'/all']
    ])
  @else
    @include('partials.breadcrumb', [
        'breadcrumbs' => [$category => '/shop/'.$category.'/all', 'Clothing' => false, $products->first()->category->name => 'categories']
    ])
  @endif
  
@endif
</div>
<div class="uk-grid-small uk-margin-top uk-grid-divider uk-margin-large-bottom" uk-grid>
<div class="uk-width-1-5@m">
  <div class="uk-panel">
    <h3 class="uk-heading-divider">
    @if($slug == 'all') 
      All 
    @else 
      @if($category == 'designers')
        {{ ucfirst($category) }}
      @else
        {{ $products->first()->category->name }} 
      @endif
    @endif</h3>
    <categories api="{{ route('menu', ['parent' => $category]) }}" parent="{{ $category }}">
      
    </categories>
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