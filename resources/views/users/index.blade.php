@extends('app')

@section('content')
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	<div class="uk-width-1-4@m">
	  <div class="uk-card uk-card-default uk-card-small uk-box-shadow-small">
	      <div class="uk-card-media-top uk-inline">
	          <div class="uk-position-top-right">
	            <a class="uk-icon-button uk-icon" href="#" uk-icon="icon: pencil"></a>
	          </div>
	          <img src="{{ $user->avatar }}" alt="">
	      </div>
	      <div class="uk-card-body">
	          <h3 class="uk-card-title uk-margin-small">{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</h3>
	          <hr>
	          <p class="uk-margin-small"><strong>My Account</strong></p>
	          <ul class="uk-list">
	            <li><a href="{{ route('user') }}" class="uk-text-small">Home</a></li>
	            <li><a href="#" class="uk-text-small">My Details</a></li>
	            <li><a href="#" class="uk-text-small">Payment Methods</a></li>
	            <li><a href="#" class="uk-text-small">Order History</a></li>
	            <li><a href="#" class="uk-text-small">My Wishlist</a></li>
	            <li><a href="#" class="uk-text-small">Reset Password</a></li>
	            <li><a href="{{ route('logout') }}" class="uk-text-small">Sign Out</a></li>

	          </ul>

	      </div>
	  </div>
	</div>
	<div class="uk-width-3-4@m">
	  <h3 class="uk-margin-remove uk-padding-remove">PERSONAL INFORMATION</h3>
	  <p>Welcome <b>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</b></p>
	</div>

</div>
@endsection