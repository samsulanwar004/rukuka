@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        @if($categories == 'designers' && $category != 'all')
            <div class="uk-grid-small uk-margin-top" uk-grid>
                <div class="uk-panel uk-width-1-4 uk-flex uk-flex-middle uk-flex-center">
                    <img src="/{{ $designer->photo }}" width="60" alt="" class="uk-box-shadow-medium">
                </div>
                <div class="uk-panel uk-width-3-4">
                    <span class="uk-text-lead">{{ $designer->name }}</span><br>
                    {{ $designer->content }}
                </div>
            </div>
            <hr class="uk-margin-small">
        @else

        @endif
        <div class="uk-grid-small uk-margin-top" uk-grid>
            <div class="uk-width-1-4@m uk-visible@m">
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
            <div class="uk-width-3-4@m">
                <div class="uk-grid-small uk-child-width-1-2 uk-flex-center" uk-grid>
                    <div class="uk-text-left">
                        <span class="uk-text-meta">Sort by price : <a href="?price=desc">high</a> | <a href="?price=asc">low</a></span>
                    </div>
                    <div class="uk-visible@m">
                      <div class="uk-text-right">
                        <span class="uk-text-meta">
                        @include('pagination.default', ['paginator' => $products])
                        </span>
                      </div>
                    </div>
                    <div class="uk-hidden@m uk-text-right">
                      <a href="#modal" class="uk-button uk-button-default uk-button-small" uk-toggle>Filter</a>
                      <div id="modal" uk-modal>
                        <div class="uk-modal-dialog uk-modal-body">
                          <button class="uk-modal-close-default" type="button" uk-close></button>
                          <h3>Filter what you want</h3>
                          <div class="uk-panel">
                            Keyword
                            <input type="text" name="key" value="" class="uk-form uk-input" placeholder="Type your keyword">
                          </div>
                          <div class="uk-panel uk-margin-bottom">
                            Categories
                            <select class="uk-select uk-form" name="categories">
                              <option value="all">A L L</option>
                              <option value="">Clothing</option>
                              <option value="">Bag</option>
                            </select>
                          </div>
                          <div class="uk-panel">
                            <select class="uk-select uk-form" name="categories2">
                              <option value="all">A L L</option>
                              <option value="">Shoes</option>
                              <option value="">Bag</option>
                            </select>
                          </div>
                          <p class="uk-text-right">
                            <button class="uk-button uk-button-default uk-button-small uk-modal-close" type="button">Cancel</button>
                            <button class="uk-button uk-button-secondary uk-button-small" type="button">FILTER</button>
                          </p>
                        </div>
                      </div>
                    </div>

                </div>
            </div>

        </div>


        <div class="uk-grid-small uk-margin-top uk-margin-large-bottom" uk-grid>
            <div class="uk-width-1-4@m uk-visible@m">
                <div class="uk-card uk-card-default uk-card-border uk-card-small uk-panel">
                    <div class="uk-card-header">
                        @if($categories == 'designers' && $category != 'all')
                            {{ $designer->name }}
                        @else
                            @if($category == 'all')
                                <b>ALL</b>
                            @else
                                {{ isset($products->first()->category->name) ? $products->first()->category->name : 'Product not available' }}
                            @endif
                        @endif
                    </div>
                    <div class="uk-card-body">
                        <categories api="{{ route('menu', ['parent' => $categories]) }}" parent="{{ $categories }}" slug="{{ $slug == null ? $category:$slug }}" category_slug="{{ $category }}">
                        </categories>
                    </div>
                </div>
            </div>
            <div class="uk-width-expand@m">
                <shop
                        shops ="{{ $shops }}"
                        product_api="{{ route('product.api') }}"
                        bag_api="{{ route('persist.bag') }}"
                        wishlist_api="{{ route('persist.wishlist') }}"
                        auth="{{ Auth::check() ? 1 : 0 }}"
                ></shop>
                <hr>
                <div class="uk-panel">
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
