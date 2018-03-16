@extends('app')
@section('title', trans('app.title_lookbook') )
@section('content')
    <div class="uk-container uk-container-small">
        <lookbook
        collections="{{ json_encode($collections) }}"
        api="{{ route('lookbook.product') }}"
        product_api="{{ route('product.api') }}"
        bag_api="{{ route('persist.bag') }}"
        wishlist_api="{{ route('persist.wishlist') }}"
        auth="{{ Auth::check() ? 1 : 0 }}"
        aws_link="{{ config('filesystems.s3url') }}"
        default_image="{{ json_encode(config('common.default')) }}"
        bag_link="{{ route('bag') }}"
        locale="{{ json_encode(trans('app')) }}"
        ></lookbook>

        <div class="uk-grid-small uk-margin-small-bottom">
            <div class="uk-panel uk-text-center">
                <a href="{{ url('/lookbook/'.Request::segment(2)) }}"><button class="uk-button uk-button-default-warm uk-button-small"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</button></a>
            </div>
        </div>

    </div>
@endsection
