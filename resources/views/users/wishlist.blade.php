@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>

<div class="uk-grid uk-margin-top" uk-grid>

	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
			<b>WISHLIST</b>
			<hr class="uk-margin-small">
      <wishlist
        wishlist_api="{{ route('persist.wishlist') }}"
        bag_api="{{ route('persist.bag') }}"
     	  wishlist_delete="{{ route('user.wishlist.destroy') }}"
        product_link="{{ route('product') }}"
      ></wishlist>
  </div>
</div>
</div>
@endsection
