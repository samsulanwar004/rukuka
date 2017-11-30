@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
	  <h3>Order History</h3>
	  <ul class="uk-child-width-1-5 uk-margin" uk-tab="animation: uk-animation-slide-bottom">
	    <li><a href="#"><b>NOT YET PAID</b> </a> </li>
      <li><a href="#"><b>NOT YET SENT</b> </a> </li>
      <li><a href="#"><b>NOT YET RECEIVED</b> </a> </li>
      <li><a href="#"><b>DONE</b> </a> </li>
      <li><a href="#"><b>CENCELED</b> </a> </li>
	  </ul>
    <ul class="uk-switcher">
      <li> hallo </li>
      <li> kedua </li>
      <li> ketiga </li>
      <li> keempat </li>
      <li> kelima </li>
    </ul>
	</div>
</div>
</div>
@endsection
