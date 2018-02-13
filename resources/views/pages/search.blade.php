@extends('app')

@section('content')
    <div class="uk-container">
        <h3 class="uk-margin-small-top uk-margin-remove-bottom ">{{ trans('app.all_you_need') }}</h3>
        <div class="uk-panel">
            <ul class="uk-breadcrumb">
                <li><a href="/">{{ trans('app.home') }}</a></li>
                <li><a>{{ trans('app.search_label') }}</a></li>
            </ul>
        </div>

        <div class="uk-grid-small uk-margin-small-top" uk-grid>
            <div class="uk-width-1-4@m uk-visible@m">
                <a href="#" uk-toggle="target: #nav1; animation: uk-animation-fade" class="uk-button uk-button-small uk-button-secondary uk-width-1-1">
                    <span class="uk-icon uk-margin-small-right" uk-icon="icon: menu"></span>
                    <label>{{ trans('app.filter_nav') }}</label>
                </a>
            </div>
            <div class="uk-width-3-4@m">
                <div class="uk-grid-small uk-child-width-1-2 uk-flex-center" uk-grid>
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
            <div id="nav1" class="uk-width-1-4@m uk-visible@m">
                <div class="uk-card uk-background-muted uk-card-small uk-box-shadow-small">
                    <div class="uk-card-body">
                      <h5 class="uk-text-uppercase">{{ trans('app.search_label') }} :  <b> {{$keyword}} </b> </h5>
                        <hr class="uk-margin-small-bottom">
                        <search
                                api="{{ route('search.api',['keyword' => $keyword])}}"
                                keyword="{{$keyword}}"
                                category="{{ $category }}"
                                subcategory="{{ $subcategory }}"
                                productcategory="{{ $productcategory }}"
                                locale="{{ json_encode(trans('app')) }}"
                        ></search>

                        <color-palette
                                api="{{ route('color') }}"
                                default_image="{{ json_encode(config('common.default')) }}"
                                aws_link="{{ config('filesystems.s3url') }}"
                                color_id="{{ $colorId }}"
                                filter="{{ http_build_query($filter) }}"
                                locale="{{ json_encode(trans('app')) }}"
                        ></color-palette>
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
