@extends('app')
@section('title', $keyword.' '.trans('app.title_search') )
@section('content')
    <div class="uk-container">
        <h3 class="uk-margin-small-top uk-margin-remove-bottom uk-visible@m">{{ trans('app.search_label') }}</h3>
        <div class="uk-panel uk-visible@m">
            <ul class="uk-breadcrumb">
                <li><a href="/">{{ trans('app.home') }}</a></li>
                <li><a>{{ trans('app.search_label') }}</a></li>
            </ul>
        </div>

        <h4 class="uk-margin-small-top uk-margin-remove-bottom uk-hidden@m">{{ trans('app.search_label') }} : "{{$keyword}}"</h4>
        <div class="uk-panel uk-hidden@m">
            <h5>{{ count($shops) }} {{  trans('app.result') }}</h5>
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
                        <h6 class="uk-text-uppercase">{{ trans('app.sort_by_price') }} :
                            <a href="{{ actionLink(['price' => 'desc']) }}" class="uk-link-reset">
                                  <span class="{{ $sortByPrice == 'desc' ? 'text-underline':'' }}">
                                      {{ trans('app.high') }}
                                  </span>
                            </a>|
                            <a href="{{ actionLink(['price' => 'asc']) }}" class="uk-link-reset">
                                  <span class="{{ $sortByPrice == 'asc' ? 'text-underline':'' }}">
                                      {{ trans('app.low') }}
                                  </span>
                            </a>
                        </h6>
                    </div>
                    <div class="uk-visible@m">
                        <div class="uk-text-right uk-margin-bottom uk-margin-top">
                            <h6 class="uk-text-uppercase uk-margin-remove-vertical">
                                @include('pagination.default', ['paginator' => $products])
                            </h6>
                        </div>
                    </div>
                    {{--<div class="uk-hidden@m uk-text-right">--}}
                        {{--<a href="#modal" class="uk-button uk-button-default-warm uk-button-small" uk-toggle>{{ trans('app.filter') }}</a>--}}
                        {{--<div id="modal" uk-modal>--}}
                            {{--<div class="uk-modal-dialog uk-modal-body">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>

        <div class="uk-grid-small uk-margin-small-top" uk-grid>
            <div id="nav1" class="uk-width-1-4@m uk-visible@m">
                <div class="uk-card uk-background-muted uk-card-small uk-box-shadow-small">
                    <div class="uk-card-body">
                      <h5>{{ trans('app.search_label') }} :  <b> "{{$keyword}}" </b> </h5>
                      <h5>{{ count($shops) }} {{  trans('app.result') }}</h5>
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
            <h6 class="uk-text-uppercase uk-margin-remove-vertical">
                @include('pagination.default', ['paginator' => $products])
            </h6>
        </div>
    </div>
@endsection
