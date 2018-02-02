@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        @if($categories == 'designers' && $category != 'all')
            <div class="uk-grid-small uk-margin-top" uk-grid>
                <div class="uk-panel uk-width-1-4 uk-text-center">
                    <img src="{{uploadCDN($designer->photo)}}" width="170" height="170" alt="rukuka designer" class="uk-box-shadow-medium" onerror="this.src = '{{imageCDN(config('common.default.image_6'))}}'">
                </div>
                <div class="uk-panel uk-width-3-4">
                    <span class="uk-text-lead">{{ $designer->name }}</span><br>
                    {!! $designer->content !!}
                </div>
            </div>
            <hr class="uk-margin-small">
        @else

        @endif

        <div class="uk-grid-small uk-margin-small-top" uk-grid>
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

                <div class="uk-grid-small uk-child-width-1-2 uk-flex-center" uk-grid >


                      <div class="uk-text-left">
                          <span class="uk-text-meta">{{ trans('app.sort_by_price') }} : <a href="?price=desc">{{ trans('app.high') }}</a> | <a href="?price=asc">{{ trans('app.low') }}</a></span>
                      </div>
                      <div class="uk-visible@m">
                        <div class="uk-text-right">
                          <span class="uk-text-meta">
                          @include('pagination.default', ['paginator' => $products])
                          </span>
                        </div>
                      </div>
                    <div class="uk-hidden@m uk-text-right">
                      <a href="#modal" class="uk-button uk-button-default-warm uk-button-small" uk-toggle>Filter</a>
                      <div id="modal" uk-modal>
                        <div class="uk-modal-dialog uk-modal-body">
                            <categories
                                    api="{{ route('menu', ['parent' => $categories]) }}"
                                    parent="{{ $categories }}"
                                    slug="{{ $slug == null ? $category:$slug }}"
                                    category_slug="{{ $category }}"
                                    sale="{{ $sale == null ? $category:$sale }}"
                            ></categories>
                        </div>
                      </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="uk-grid-small uk-margin-small-top" uk-grid>
            <div class="uk-width-1-4@m uk-visible@m">
                <div class="uk-card uk-card-border uk-card-small uk-panel">
                    <div class="uk-card-body">
                      @if($categories == 'designers' && $category != 'all')
                          <h4>{{ $designer->name }}</h4>
                      @else
                          @if($category == 'all')
                              <h4>Browse Here</h4>
                          @else
                              <h5>{{ isset($products->first()->category->name) ? $products->first()->category->name : 'Product not available' }}</h5>
                          @endif
                      @endif
                        <categories
                                api="{{ route('menu', ['parent' => $categories]) }}"
                                parent="{{ $categories }}"
                                slug="{{ $slug == null ? $category:$slug }}"
                                category_slug="{{ $category }}"
                                sale="{{ $sale == null ? $category:$sale }}"
                        ></categories>
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
                  aws_link="{{ config('filesystems.s3url') }}"
                  default_image="{{ json_encode(config('common.default')) }}"
                  bag_link="{{ route('bag') }}"
                ></shop>
            </div>
        </div>
          <div class="uk-text-right uk-margin-bottom uk-margin-top">
            <span class="uk-text-meta">
            @include('pagination.default', ['paginator' => $products])
            </span>
          </div>
        <hr>
        @if($recently)
        <div class="uk-grid-small uk-margin-small-bottom uk-margin-top">
            <div class="uk-panel">
                <h4 class="uk-margin-small uk-text-uppercase">{{ trans('app.recently_view') }}</h4>
            </div>
        </div>
        <related
                api="{{ route('recently') }}"
                product_api="{{ route('product.api') }}"
                bag_api="{{ route('persist.bag') }}"
                wishlist_api="{{ route('persist.wishlist') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                aws_link="{{ config('filesystems.s3url') }}"
                default_image="{{ json_encode(config('common.default')) }}"
                recently="{{ json_encode($recently) }}"
                bag_link="{{ route('bag') }}"
        ></related>

        <div class="uk-grid-small uk-margin-bottom uk-margin-small-top">
            <div class="uk-panel uk-text-center">
                <a  href="{{route('shop',['categories' => 'designers', 'category' => 'all' ])}}" class="uk-button uk-button-small uk-button-text">{{ trans('app.show_all_product') }}</a>
            </div>
        </div>
        @endif
    </div>
@endsection
