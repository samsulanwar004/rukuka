@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        @if($search == 'designers' && $category != 'all')
            <div class="uk-grid-small uk-margin-top" uk-grid>
                <div class="uk-panel uk-width-1-4 uk-flex uk-flex-middle uk-flex-center">
                    <img src="{{ uploadCDN($designer->photo) }}" width="60" alt="" class="uk-box-shadow-medium">
                </div>
                <div class="uk-panel uk-width-3-4">
                    <span class="uk-text-lead">{{ $designer->name }}</span><br>
                    {{ $designer->content }}
                </div>
            </div>
            <hr class="uk-margin-small">
        @else

        @endif
        <div class="uk-section uk-section-xsmall uk-section-default uk-padding-small">
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-4@m uk-visible@m">
                <div class="uk-panel">
                    <ul class="uk-breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a>Search</a></li>
                    </ul>
                </div>
            </div>
            <div class="uk-width-3-4@m">
                <div class="uk-grid-small uk-child-width-1-2 uk-flex-center" uk-grid>
                    <div class="uk-text-left">
                        <span class="uk-text-meta">Sort by price : <a href="?price=desc&keyword={{$keyword}}">high</a> | <a href="?price=asc&keyword={{$keyword}}">low</a></span>
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
                                <search
                                        api="{{ route('search.api',['keyword' => $keyword])}}"
                                        keyword="{{$keyword}}"
                                        category="{{ $category }}"
                                        subcategory="{{ $subcategory }}"
                                        productcategory="{{ $productcategory }}"
                                ></search>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
        <div class="uk-grid-small uk-margin-small-top uk-margin-large-bottom" uk-grid>
            <div class="uk-width-1-4@m uk-visible@m">
                <div class="uk-card uk-card-border uk-card-small uk-panel">
                    <div class="uk-card-body">
                      <h4>Search :  <b> {{$keyword}} </b> </h4>
                        <search
                                api="{{ route('search.api',['keyword' => $keyword])}}"
                                keyword="{{$keyword}}"
                                category="{{ $category }}"
                                subcategory="{{ $subcategory }}"
                                productcategory="{{ $productcategory }}"
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
                ></shop>
            </div>
        </div>
    </div>
@endsection
