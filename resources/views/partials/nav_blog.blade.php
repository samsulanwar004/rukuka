<!-- Header Image -->
<div class="uk-container uk-container-small">
  <div class="uk-text-center">
      <div class="uk-inline">
          <a href="{{ $home['homepage_main_url'] }}" class="uk-link-reset">
              <div class="uk-inline-clip uk-transition-toggle uk-light">
                  @if($status['code'] == '010')
                      <img src="{{ uploadCDN($posts['photo_2']) }}" alt="rukuka homepage" onerror="this.src = '{{imageCDN(config('common.default.image_1'))}}'">
                  @else
                  @endif
              </div>
          </a>
      </div>
  </div>
</div>
<!-- End Header Image-->
