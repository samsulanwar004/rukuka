{{--Nav Category--}}
    <div id="offcanvas-flip-reveal" uk-offcanvas="mode: push; flip: false">
        <div class="uk-offcanvas-bar uk-text-center blog-nav-background">
            <div class="uk-margin-large-top">
                <button class="uk-offcanvas-close uk-close-large uk-close uk-icon" type="button" uk-close="" style="color: #505050;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" ratio="1"></svg>
                </button>
                <ul class="uk-offcanvas-content uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                    {{--{{ Form::open(array('url' => '/blog/search','files' => true,'class' => 'uk-search uk-search-large')) }}--}}
                    {{--<span style="color: #B4B4B4;" uk-search-icon></span>--}}
                    {{--<input style="font-size: xx-large;color: #B4B4B4;" class="uk-search-input" name="search" type="text" placeholder="Search...">--}}
                    {{--{{ Form::close() }}--}}
                    {{--<li><a href="{{URL::to('/blog')}}"><span style="color: #505050;">Home</span></a></li>--}}
                    @foreach($category as $value)
                        <li><a style="color: #505050;" href="{{ URL::to('blog/category/'.$value->slug)}}">{{$value->name}}</a></li>
                    @endforeach
                    <li><a href="{{URL::to('/')}}"><span style="color: #505050;" >Ku Ka Indonesia</span></a></li>
                </ul>
            </div>
        </div>
    </div >
{{--End Nav Category--}}

<!-- Header Image -->
    <div>
        @if($status['code'] == '010')
            <div class="uk-background-cover uk-height-medium uk-panel" style="background-image: url(/{{ $posts[0]['photo_2']}}); height: 350px;">
                <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                </div>
                <div class="uk-overlay uk-position-center">
                    <div class="blog-white-text blog-title"> {{$posts[0]['title']}}</div>
                </div>
                <div class="uk-position-medium uk-position-top-left uk-margin-large-left">
                    <a href="#offcanvas-flip-reveal" uk-toggle >
                        <span class="blog-white-text" uk-icon="icon: menu; ratio: 2"></span>
                    </a>
                </div>
                <div class="uk-position-medium uk-position-top-right uk-margin-large-right">
                    <a href="{{ URL::to('blog/')}}">
                        {{ Html::image("images/logo-kukaindonesia-white.png", "alt", array( "width" => 125, "height" => 125 )) }}
                    </a>
                </div>
            </div>
        @else
            <div class="uk-background-cover uk-height-medium uk-panel" style="background-image: url(/{{ $header[0]['content']}}); height: 350px;">
                <div style="background: rgba(0,0,0,.2);" class="uk-position-cover">
                </div>
                <div class="uk-position-medium uk-position-top-left uk-margin-large-left">
                    <a href="#offcanvas-flip-reveal" uk-toggle >
                        <span class="blog-white-text" uk-icon="icon: menu; ratio: 2"></span>
                    </a>
                </div>
                <div class="uk-position-medium uk-position-top-right uk-margin-large-right">
                    <a href="{{ URL::to('blog/')}}">
                        {{ Html::image("images/logo-kukaindonesia-white.png", "alt", array( "width" => 125, "height" => 125 )) }}
                    </a>
                </div>
            </div>
        @endif

            {{--Sticky--}}
            <div id="sticky" class="uk-card uk-card-secondary uk-card-body uk-card-small uk-hidden blog-sticky-background" style="z-index: 980;);" uk-sticky="animation: uk-animation-slide-top">
                <div class="uk-position-top-left uk-margin-large-left">
                    <a href="#offcanvas-flip-reveal" uk-toggle >
                        <span class="blog-black-text" uk-icon="icon: menu; ratio: 2"></span>
                    </a>
                </div>
                @if($status['code'] == '010' && !$title)
                    <div class="uk-position-top-center">
                        <span id="scrollPercentLabel" class="uk-text-large blog-black-text" style="font-size: x-large"><span>0</span> % READ</span>
                    </div>
                @endif
            </div>
            {{--End Sticky--}}
    </div>
<!-- End Header Image-->
@section('footer_scripts')
    <script style="text/javascript">
        $(window).scroll(function(){
            if ($(this).scrollTop() > 355) {
                $('#sticky').removeClass('uk-hidden');
            } else {
                $('#sticky').addClass('uk-hidden');
            }
        });

        $(document).ready(function() {

            $(window).scroll(function(e){
                var scrollTop = $(window).scrollTop()-400;
                var docHeight = $(document).height();
                var winHeight = $(window).height()+400;
                var scrollPercent = (scrollTop) / (docHeight - winHeight);
                var scrollPercentRounded = Math.round(scrollPercent*101);
                $('#scrollPercentLabel>span').html(scrollPercentRounded);

                if (scrollPercentRounded > 100 || scrollPercentRounded < 0) {
                    $('#scrollPercentLabel').hide();
                } else {
                    $('#scrollPercentLabel').show();
                }
            });


        });

    </script>
@endsection