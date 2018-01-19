@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        <div class="uk-grid-small uk-margin-top uk-margin-bottom">
            {{--MAIN BANNER--}}
            <div class="uk-text-center">
                <h3 class="uk-heading-line"><span>DESIGNERS</span></h3>
            </div>
            {{--END MAIN BANNER--}}

{{--             @php $previous = null; @endphp
            @php $isPrinted = false; @endphp
            @php $listAlphabeth = null; @endphp

            @foreach($designers as $value)
                @php
                $listAlphabeth[] = strtolower(substr($value['slug'], 0, 1));
                $listAlphabeth = array_unique($listAlphabeth)
                @endphp
            @endforeach

            @foreach($listAlphabeth as $listAlphabethValue)
                @foreach($designers as $value)
                    @php $firstLetter = strtolower(substr($value['slug'], 0, 1)); @endphp
                    @if($firstLetter == $listAlphabethValue)
                        @php $isPrinted = true; break; @endphp
                    @endif
                @endforeach

                @if($isPrinted)
                    <h3 class="uk-heading-line"><span>{{strtoupper($listAlphabethValue)}}</span> </h3>
                    <div class="uk-column-1-3@m uk-column-1-2@s">
                    @foreach($designers as $value)
                        @php $firstLetter = strtolower(substr($value['slug'], 0, 1)); @endphp
                        @if($firstLetter == $listAlphabethValue)
                        <div>
                            <a href="/shop/designers/{{$value['slug']}}">{{ucfirst(strtolower($value['name']))}}</a>
                            <div uk-drop="pos: right-center">
                                <div class="uk-card uk-card-default uk-card-small">
                                    <div class="uk-card-header">
                                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                                            <div class="uk-width-auto">
                                                    <img class="uk-border-circle" width="80" height="80" src="{{uploadCDN($value['photo'])}}" onerror="this.src = '{{imageCDN(config('common.default.image_6'))}}'">
                                            </div>
                                            <div class="uk-width-expand">
                                                <h3 class="uk-card-title uk-margin-remove-bottom">{{$value['name']}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-card-body uk-text-justify ">
                                        <p>{!! str_limit($value['content'],500) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>
                @endif

                @php $isPrinted = false; @endphp
            @endforeach --}}

        </div>
    </div>
@endsection
