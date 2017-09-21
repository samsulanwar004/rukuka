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


