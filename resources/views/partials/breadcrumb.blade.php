<div class="uk-panel">
  <ul class="uk-breadcrumb">
    <li><span class="uk-margin-small-right" uk-icon="icon: triangle-left"></span><a href="/">Home</a></li>
    @foreach($breadcrumbs as $key => $b)
        @if(! $b)
            <li class="uk-disabled"><a href="#">{{ ucfirst($key) }}</a></li>
        @else
            @if($b == 'categories')
            	<li><span>{{ ucfirst($key) }}</span></li>
            @else 
            	<li><a href="{{ $b }}">{{ ucfirst($key) }}</a></li>
            @endif
        @endif
    @endforeach    
  </ul>
</div>