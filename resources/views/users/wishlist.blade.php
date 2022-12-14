@extends('app')
@section('title', trans('app.title_wishlist') )
@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>

<div class="uk-grid uk-margin-top" uk-grid>

	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
			<h4 class="uk-text-uppercase">{{ trans('app.wishlist') }}</h4>
      <wishlist
        wishlist_api="{{ route('persist.wishlist') }}"
        product_api="{{ route('product.api') }}"
        bag_api="{{ route('persist.bag') }}"
		wishlist_delete="{{ route('user.wishlist.destroy') }}"
        product_link="{{ route('product') }}"
        aws_link="{{ config('filesystems.s3url') }}"
		default_image="{{ json_encode(config('common.default')) }}"
		locale="{{ json_encode(trans('app')) }}"
		bag_link="{{ route('bag') }}"
		menu ="{{ $gender }}"
	  ></wishlist>
  </div>
</div>
</div>
@endsection
