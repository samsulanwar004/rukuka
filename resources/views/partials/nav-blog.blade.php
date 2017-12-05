<!-- Header Image -->
    <div>
        @if($status['code'] == '010')
            <div class="uk-background-cover uk-position-relative" style="background-image: url({{ '/'.$posts[0]['photo_2']}}); height: 350px;">
                <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                </div>
                <div class="uk-position-medium uk-position-top-right uk-margin-large-right">
                    <a href="{{ URL::to('blog/')}}">
                        {{ Html::image("images/logo-kukaindonesia-white.png", "alt", array( "width" => 125, "height" => 125 )) }}
                    </a>
                </div>
            </div>
        @else
            <div class="uk-background-cover uk-position-relative" style="background-image: url({{ '/'.$header[0]['content']}}); height: 350px;">
                <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                </div>
                <div class="uk-position-medium uk-position-top-right uk-margin-large-right">
                    <a href="{{ URL::to('blog/')}}">
                        {{ Html::image("images/logo-kukaindonesia-white.png", "alt", array( "width" => 125, "height" => 125 )) }}
                    </a>
                </div>
            </div>
        @endif
    </div>
<!-- End Header Image-->
