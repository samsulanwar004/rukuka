@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        <div class="uk-grid-small uk-margin-top">
            {{--MAIN BANNER--}}
            <div class="uk-text-center">
                <h3 class="uk-heading-line"><span>DESIGNERS</span></h3>
            </div>
            {{--END MAIN BANNER--}}

            <?php $previous = null; ?>
            <?php $isPrinted = false; ?>
            <?php $listAlphabeth = null; ?>

            @foreach($designers as $value)
                <?php
                $listAlphabeth[] = strtolower(substr($value['slug'], 0, 1));
                $listAlphabeth = array_unique($listAlphabeth)
                ?>
            @endforeach

            @foreach($listAlphabeth as $listAlphabethValue)
                @foreach($designers as $value)
                    <?php $firstLetter = strtolower(substr($value['slug'], 0, 1)); ?>
                    @if($firstLetter == $listAlphabethValue)
                        <?php $isPrinted = true; break; ?>
                    @endif
                @endforeach

                @if($isPrinted)
                    <h3 class="uk-heading-line"><span>{{strtoupper($listAlphabethValue)}}</span> </h3>
                    <div class="uk-column-1-3 uk-margin-large-bottom">
                    @foreach($designers as $value)
                        <?php $firstLetter = strtolower(substr($value['slug'], 0, 1)); ?>
                        @if($firstLetter == $listAlphabethValue)
                            <div>
                                <a href="/shop/designers/{{$value['slug']}}">{{ucfirst(strtolower($value['name']))}}</a>
                            </div>
                        @endif
                    @endforeach
                    </div>
                @endif

                <?php $isPrinted = false; ?>
            @endforeach

        </div>
    </div>
@endsection
