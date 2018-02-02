@if ($paginator->lastPage() > 1)
    {{ trans('app.page') }} : {{ $paginator->currentPage() }} {{ trans('app.of') }}  {{ $paginator->lastPage() }}  &nbsp;
    <a href="{{ $paginator->url(1) }}" class="uk-icon-link {{ ($paginator->currentPage() <= 1) ? ' uk-disabled' : '' }}" 
    uk-icon="icon: chevron-left"></a>
    <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="uk-icon-link {{ ($paginator->currentPage() >= $paginator->lastPage()) ? ' uk-disabled' : '' }}" 
    uk-icon="icon: chevron-right" ></a>
@else
    {{ trans('app.page') }}  : 1 {{ trans('app.of') }}  1  &nbsp;
    <a href="#" class="uk-icon-link uk-disabled" 
    uk-icon="icon: chevron-left"></a>
    <a href="#" class="uk-icon-link uk-disabled" 
    uk-icon="icon: chevron-right" ></a>
@endif
