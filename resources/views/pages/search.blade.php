@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        <div class="uk-grid-small uk-margin-small-top" uk-grid>
            <div class="uk-width-1-4@m uk-visible@m">
                <div class="uk-panel">
                    <ul class="uk-breadcrumb">
                        <li><a href="/">{{ trans('app.home') }}</a></li>
                        <li><a>{{ trans('app.search_label') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="uk-width-3-4@m">
                <div class="uk-grid-small uk-child-width-1-2 uk-flex-center" uk-grid>
                    <div class="uk-text-left">
                        <span class="uk-text-meta">{{ trans('app.sort_by_price') }} : <a href="?price=desc&keyword={{$keyword}}">{{ trans('app.high') }}</a> | <a href="?price=asc&keyword={{$keyword}}">{{ trans('app.low') }}</a></span>
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
                                <search
                                        api="{{ route('search.api',['keyword' => $keyword])}}"
                                        keyword="{{$keyword}}"
                                        category="{{ $category }}"
                                        subcategory="{{ $subcategory }}"
                                        productcategory="{{ $productcategory }}"
                                        locale="{{ json_encode(trans('app')) }}"
                                ></search>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid-small uk-margin-small-top" uk-grid>
            <div class="uk-width-1-4@m uk-visible@m">
                <div class="uk-card uk-card-default uk-card-small uk-box-shadow-small uk-panel uk-background-muted">
                    <div class="uk-card-body">
                      <h5>{{ trans('app.search_label') }} :  <b> {{$keyword}} </b> </h5>
                        <search
                                api="{{ route('search.api',['keyword' => $keyword])}}"
                                keyword="{{$keyword}}"
                                category="{{ $category }}"
                                subcategory="{{ $subcategory }}"
                                productcategory="{{ $productcategory }}"
                                locale="{{ json_encode(trans('app')) }}"
                        ></search>
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
                        locale="{{ json_encode(trans('app')) }}"
                ></shop>
            </div>
        </div>
        <div class="uk-text-right uk-margin-bottom uk-margin-top">
          <span class="uk-text-meta">
          @include('pagination.default', ['paginator' => $products])
          </span>
        </div>
    </div>
@endsection
