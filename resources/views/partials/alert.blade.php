@if ($errors->any())
    @if ($errors->has('success'))
	    @foreach ($errors->get('success') as $success)
	    	<div class="uk-alert-success" uk-alert>
			    <a class="uk-alert-close" uk-close></a>
			    <p>{{ $success }}</p>
			</div>
	    @endforeach
    @else
	    @foreach ($errors->all() as $error)
	    	<div class="uk-alert-danger" uk-alert>
			    <a class="uk-alert-close" uk-close></a>
			    <p>{{ $error }}</p>
			</div>
	    @endforeach
	@endif
@endif

@if ($success = session('success'))

	<div class="uk-alert-success" uk-alert>
	    <a class="uk-alert-close" uk-close></a>
	    <p>{{ $success }}</p>
	</div>
@endif

@if (session('payment_message') != NULL)

	@if (session('payment_status') == "CAPTURED" || session('payment_status') == "AUTHORIZED")
	    <div class="uk-alert-success" uk-alert>
		    <a class="uk-alert-close" uk-close></a>
		    <p>{{session('payment_message')}}</p>
		</div>
	@else
		<div class="uk-alert-danger" uk-alert>
			    <a class="uk-alert-close" uk-close></a>
			    <p>{{session('payment_message')}}</p>
		</div>
    @endif
@endif
<?php session(['payment_status' => NULL]); session(['payment_message' => NULL]); ?>

