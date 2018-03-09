<!-- Header Image -->
<div class="uk-text-center">
    <div class="uk-inline">
        <a href="{{ $home['homepage_main_url'] }}" class="uk-link-reset">
            <div class="uk-inline-clip uk-transition-toggle uk-light">
                @if($status['code'] == '010')
                    <img src="{{ uploadCDN($posts['photo_2']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'">
                @else
                    {{-- <img src="{{ uploadCDN($header[0]['content']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'"> --}}
                @endif

                <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
            </div>
        </a>

    </div>
</div>
<!-- End Header Image-->
