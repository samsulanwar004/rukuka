@if ($paginator->lastPage() > 1)
    {{ trans('app.page') }} : {{ $paginator->currentPage() }} {{ trans('app.of') }}  {{ $paginator->lastPage() }}  &nbsp;
    <a href="{{ $paginator->url(1) }}" class="uk-icon-link {{ ($paginator->currentPage() <= 1) ? ' uk-disabled' : '' }}"
    ><i class="material-icons" style="font-size: 18px; vertical-align:middle">chevron_left</i></a>
    <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="uk-icon-link {{ ($paginator->currentPage() >= $paginator->lastPage()) ? ' uk-disabled' : '' }}"
    ><i class="material-icons" style="font-size: 18px; vertical-align:middle">chevron_right</i></a>
@else
    {{ trans('app.page') }}  : 1 {{ trans('app.of') }}  1  &nbsp;
    <a href="#" class="uk-icon-link uk-disabled"
    ><i class="material-icons" style="font-size: 18px; vertical-align:middle">chevron_left</i></a>
    <a href="#" class="uk-icon-link uk-disabled"
    ><i class="material-icons" style="font-size: 18px; vertical-align:middle">chevron_right</i></a>
@endif
