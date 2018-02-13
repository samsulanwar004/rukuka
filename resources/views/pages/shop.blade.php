@extends('app')

@section('content')

    <div class="uk-container">
      @if($categories == 'designers' && $category != 'all')
          <h3 class="uk-margin-small-top uk-margin-remove-bottom ">{{ $designer->name }}</h3>
      @else
          @if($category == 'all')
              <h3 class="uk-margin-small-top uk-margin-remove-bottom ">{{ trans('app.all_you_need') }}</h3>
          @else
              <h3 class="uk-margin-small-top uk-margin-remove-bottom ">{{ isset($products->first()->category->name) ? $products->first()->category->name : 'Product not available' }}</h3>
          @endif
      @endif
      <div class="uk-visible@m">


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

        <div class="uk-grid-small uk-margin-small-top"uk-grid>
            <div class="uk-width-1-4@m uk-visible@m sidebar">

                <a href="#" uk-toggle="target: #nav1; animation: uk-animation-fade" class="uk-button uk-button-small uk-button-secondary uk-width-1-1">
                  <span class="uk-icon uk-margin-small-right" uk-icon="icon: menu"></span>
                    <label>{{ trans('app.filter_nav') }}</label>
                </a>

            </div>
            <div class="uk-width-3-4@m">

                <div class="uk-grid-small uk-child-width-1-2 uk-flex-center" uk-grid >
                      <div class="uk-text-left uk-flex uk-flex-middle">
                          <h6 class="uk-text-uppercase">{{ trans('app.sort_by_price') }} : <a href="{{ actionLink(['price' => 'desc']) }}">{{ trans('app.high') }}</a>
                            | <a href="{{ actionLink(['price' => 'asc']) }}">{{ trans('app.low') }}</a></h6>
                      </div>
                      <div class="uk-visible@m">
                        <div class="uk-text-right">
                          <h6 class="uk-text-uppercase uk-margin-remove-vertical">
                          @include('pagination.default', ['paginator' => $products])
                        </h6>
                        </div>
                      </div>
                    <div class="uk-hidden@m uk-text-right">
                      <a href="#modal" class="uk-button uk-button-default-warm uk-button-small" uk-toggle>{{ trans('app.filter') }}</a>
                      <div id="modal" uk-modal>
                        <div class="uk-modal-dialog uk-modal-body">
                            <categories
                                    api="{{ route('menu', ['parent' => $categories]) }}"
                                    parent="{{ $categories }}"
                                    slug="{{ $slug == null ? $category:$slug }}"
                                    category_slug="{{ $category }}"
                                    sale="{{ $sale == null ? $category:$sale }}"
                                    locale="{{ json_encode(trans('app')) }}"
                            ></categories>
                        </div>
                      </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="uk-grid-small uk-margin-small-top" uk-grid>
            <div id="nav1" class="uk-width-1-4@m uk-visible@m">
                <div class="uk-card uk-background-muted uk-card-small uk-box-shadow-small">
                    <div class="uk-card-body">
                        <categories
                                api="{{ route('menu', ['parent' => $categories]) }}"
                                parent="{{ $categories }}"
                                slug="{{ $slug == null ? $category:$slug }}"
                                category_slug="{{ $category }}"
                                sale="{{ $sale == null ? $category:$sale }}"
                                locale="{{ json_encode(trans('app')) }}"
                        ></categories>
                    </div>
                </div>

                <color-palette
                  api="{{ route('color') }}"
                  default_image="{{ json_encode(config('common.default')) }}"
                  aws_link="{{ config('filesystems.s3url') }}"
                  color_id="{{ $colorId }}"
                ></color-palette>

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
                  locale="{{ json_encode(trans('app')) }}"
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
                locale="{{ json_encode(trans('app')) }}"
        ></related>

        <div class="uk-grid-small uk-margin-bottom uk-margin-small-top">
            <div class="uk-panel uk-text-center">
                <a  href="{{route('shop',['categories' => 'designers', 'category' => 'all' ])}}" class="uk-button uk-button-small uk-button-text">{{ trans('app.show_all_product') }}</a>
            </div>
        </div>
        @endif
    </div>
@endsection
