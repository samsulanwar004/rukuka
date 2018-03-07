@extends('app')
@section('title', trans('app.title_lookbook') )
@section('content')
    <div class="uk-container uk-container-small">
        <div uk-slideshow="animation: push; autoplay:true">
            <div class="uk-position-relative uk-visible-toggle uk-light">
                <ul class="uk-slideshow-items">
                    <li>
                        <div class="uk-position-cover" uk-slideshow-parallax="scale: 1.2,1.2,1">
                            <img src="{{ uploadCDN($lookbook->banner) }}" alt="rukuka lookbook" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'" uk-cover>
                        </div>
                        <div class="uk-position-cover" uk-slideshow-parallax="opacity: 0,0,0.2; background-color: #000,#000"></div>
                        <div class="uk-position-center uk-position-medium uk-text-center">
                            <div uk-slideshow-parallax="scale: 1,1,0.8">
                                <h1 class="uk-heading-primary uk-visible@m" uk-slideshow-parallax="x: 200,0,0">{{ $lookbook->name }}</h1>
                                <h5 class="uk-hidden@m">{{ $lookbook->name }}</h5>
                                <p class="uk-text-lead uk-visible@m" uk-slideshow-parallax="x: 400,0,0;">{{ $lookbook->subtitle }}</p>
                                <h6 class="uk-hidden@m uk-margin-remove uk-text-meta">{{ $lookbook->subtitle }}</h6>
                            </div>
                        </div>
                    </li>
                </ul>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

            </div>

            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>

        </div>
        <div class="uk-card uk-card-secondary uk-card-small">
          <div class="uk-card-body">
            <h4 class="uk-text-center"><b> {{ $lookbook->title }}</b></h4>
          </div>
        </div>

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
    </div>
@endsection
