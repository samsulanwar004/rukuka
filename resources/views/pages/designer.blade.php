@extends('app')
@section('title', trans('app.title_designers_list') )
@section('content')
<div class="uk-container uk-container-small">
   <div class="uk-grid-small uk-margin-top uk-margin-bottom">
      {{--MAIN BANNER--}}
      <div class="uk-text-center">
         <h3 class="uk-heading-line uk-text-uppercase"><span>{{ trans('app.designers_nav') }}</span></h3>
      </div>
      {{--END MAIN BANNER--}}
        @foreach($alpabeths as $abjad)
            <h3 class="uk-heading-line">
                <span>
                    {{strtoupper($abjad)}}
                </span> 
            </h3>
            <div class="uk-column-1-3@m uk-column-1-2@s">
                @foreach($designers as $value)
                @php 
                    $firstLetter = strtolower(substr($value['slug'], 0, 1)); 
                @endphp
                @if($firstLetter == $abjad)
                <div>
                    <a href="/shop?menu={{$menu}}&designer={{ $value['slug'] }}">
                    {{ ucfirst(ucwords($value['name'])) }}
                    </a>
                    <div uk-drop="pos: right-center">
                        <div class="uk-card uk-card-default uk-card-small">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <div class="uk-width-auto">
                                       <img class="uk-border-circle" width="80" height="80" src="{{uploadCDN($value['photo'])}}" onerror="this.src = '{{imageCDN(config('common.default.image_6'))}}'">
                                    </div>
                                    <div class="uk-width-expand">
                                       <h3 class="uk-card-title uk-margin-remove-bottom">
                                          {{ $value['name'] }}
                                       </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-card-body uk-text-justify">
                                {!! str_limit(strip_tags($value['content']),100, '... <b><a href="/shop?menu='.$menu.'&designer='.$value['slug'].'">more</a></b>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        @endforeach
   </div>
</div>
@endsection