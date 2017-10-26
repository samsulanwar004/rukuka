<div class="uk-panel uk-grid" uk-grid>
  <div class="uk-width-1-4@m">
    <ul class="uk-breadcrumb">
      <li><a href="/">Home</a></li>
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
  <div class="uk-width-3-4@m">
    <div class="uk-grid-small uk-child-width-1-2@m uk-flex-center" uk-grid>
      <div class="uk-text-left">
        <span class="uk-text-meta">Sort by price : <a href="?price=desc">high</a> | <a href="?price=asc">low</a></span>
        </div>
        <div class="uk-text-right">
          <span class="uk-text-meta">
          @include('pagination.default', ['paginator' => $products])
          </span>
        </div>
      </div>
  </div>
</div>
