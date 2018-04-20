@extends('app')
@section('title', $keyword.' '.trans('app.title_search') )
@section('content')
    <div class="uk-container">

        <div class="uk-background-muted uk-visible@m fixed" style="top: 0px;" uk-grid>
            <div class="uk-width-1-5@m">
                <ul class="uk-grid uk-grid-small">
                    <li>
                        <div class="typeahead__field">
                            <a href="#" uk-toggle="target: #nav1"><i class="material-icons" style="font-size: 22px">menu</i></a>
                            {{ trans('app.search_label')  }}
                        </div>
                    </li>
                </ul>

            </div>
            <div class="uk-width-4-5@m">
                <div class="uk-grid-small uk-child-width-1-2" uk-grid >
                    <div class="uk-text-left">
                        <a href="#">{{ trans('app.sort_by') }}<i class="material-icons"  style="font-size: 18px; vertical-align:middle">expand_more</i></a>
                        <div uk-drop="mode: hover; delay-hide: 0" style="width: 200px">
                            <div class="uk-card uk-background-default uk-box-shadow-small uk-card-small">
                                <div class="uk-card-body">
                                    <ul class="uk-list">
                                        <li>
                                            <a href="{{ actionLink(['sort' => 'desc'],'price','popular') }}">
                                        <span class="{{ $sortByNew == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.new_in') }}
                                        </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ actionLink(['popular' => 'desc'],'price','sort') }}">
                                        <span class="{{ $sortByPopular == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.popular_sort') }}
                                        </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ actionLink(['price' => 'desc'],'sort','popular') }}">
                                        <span class="{{ $sortByPrice == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.high') }}
                                        </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ actionLink(['price' => 'asc'],'sort','popular') }}">
                                        <span class="{{ $sortByPrice == 'asc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.low') }}
                                        </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-text-right">

                            @include('pagination.default', ['paginator' => $products])

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="uk-hidden@m uk-child-width-1-2" uk-grid>
            <div>
                <a href="#">{{ trans('app.sort_by') }}
                    <i class="material-icons"  style="font-size: 18px; vertical-align:middle">expand_more</i></a>
                <div uk-drop="mode: hover; delay-hide: 0" style="width: 200px">
                    <div class="uk-card uk-background-default uk-box-shadow-small uk-card-small">
                        <div class="uk-card-body">
                            <ul class="uk-list">
                                <li>
                                    <a href="{{ actionLink(['sort' => 'desc'],'price','popular') }}">
                                        <span class="{{ $sortByNew == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.new_in') }}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ actionLink(['popular' => 'desc'],'price','sort') }}">
                                        <span class="{{ $sortByPopular == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.popular_sort') }}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ actionLink(['price' => 'desc'],'sort','popular') }}">
                                        <span class="{{ $sortByPrice == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.high') }}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ actionLink(['price' => 'asc'],'sort','popular') }}">
                                        <span class="{{ $sortByPrice == 'asc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.low') }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-text-right">
                <label>{{ count($shops) }} {{  trans('app.result') }}</label>
                <label>{{ trans('app.search_result') }} : </label><br>
                <label> "{{$keyword}}" </label>
            </div>

        </div>

        <div class="uk-grid uk-margin-small-top" uk-grid>
            <div id="nav1" class="uk-width-1-5@m uk-visible@m">
                <label>{{ count($shops) }} {{  trans('app.result') }}</label>
                <label>{{ trans('app.search_result') }} : </label><br>
                <label> "{{$keyword}}" </label>
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

            @include('pagination.default', ['paginator' => $products])

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
                    <a  href="/shop?menu={{$categories}}&parent=all" class="uk-button uk-button-small uk-button-text uk-text-uppercase">{{ trans('app.show_all_product') }}</a>
                </div>
            </div>
        @endif
    </div>
@endsection
