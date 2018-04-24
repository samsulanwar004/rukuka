@php

  $women = Request::segment(1) == "women"
  || Request::input('gender') == "womens"
  || Request::input('menu') == "womens"
  || $categories == "womens"
  || $product->gender == "womens"
  || $product->gender == "unisex" ? "womens" : null;

  $men = Request::segment(1) == "men"
  || Request::input('gender') == "mens"
  || Request::input('menu') == "mens"
  || $categories == "mens"
  || $product->gender == "mens"
  || $product->gender == "unisex" ? "mens" : null;

  if($women) {
    $navigation = $women;
  } elseif ($men) {
    $navigation = $men;
  } else {
    $navigation = null;
  }

@endphp
    <div class="uk-box-shadow-medium uk-background-default"  uk-sticky="bottom: #hash; animation: uk-animation-slide-top;">
            <user-panel-mobile
              profile_link="{{ route('user') }}"
              bag_link="{{ route('bag') }}"
              login_link="{{ route('login') }}"
              auth="{{ Auth::check() ? 1 : 0 }}"
              aws_link="{{ config('filesystems.s3url') }}"
              default_image="{{ json_encode(config('common.default')) }}"
              logo="{{ json_encode(config('common.logo')) }}"
              locale="{{ json_encode(trans('app')) }}"
              navigation="{{ $navigation }}"
            ></user-panel-mobile>
            <div id="offcanvas-overlay-slide" uk-offcanvas="overlay: true">
              <navigation-mobile
                  men_link="{{ route('men') }}"
                  women_link="{{ route('women') }}"
                  designer_link="{{ route('designer') }}"
                  auth="{{ Auth::check() ? 1 : 0 }}"
                  login_link="{{ route('login') }}"
                  profile_link="{{ route('user') }}"
                  locale="{{ json_encode(trans('app')) }}"
                  navigation="{{ $navigation }}"
                  category="{{ isset($category) ? $category : null }}"
                  designer="{{ Request::segment(1) == "designer" ? true : false }}"
                  editorial="{{ Request::segment(1) == "editorial" ? true : false }}"
              ></navigation-mobile>
            </div>
            <div class="uk-navbar-left uk-padding-xsmall uk-background-muted test-overlay" hidden>
              <div class="uk-width-expand">

                {{ Form::open(array('url' => '/search', 'method' =>'get','files' => true,'class' => 'uk-search uk-search-navbar uk-width-1-1')) }}
                <input type="hidden" name="menu" value="{{ $navigation }}">
                <div>
                  <div class="typeahead__container">
                    <div class="typeahead__field">
                        <span class="typeahead__query">
                          <input class="uk-search-input js-typeahead-designers" name="keyword" type="search" required placeholder="{{ trans('app.search') }}" autofocus autocomplete="off">
                        </span>
                    </div>
                  </div>
                </div>
                {{ Form::close() }}
              </div>
              <a class="uk-navbar-toggle uk-padding-remove" uk-close uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>
            </div>
    </div>
  {{-- </div> --}}
  {{-- <div class="uk-alert-alert" uk-alert>
      <a href="#" class="uk-alert-close" uk-close></a>
      <p class="uk-text-center uk-text-small">
        {{ trans('app.header_note') }} <a href="https://rukuka.com/lookbook/amazon-fashion-week"> <b> <u>{{ trans('app.afw') }}</u> </b> </a></b>
      </p>
  </div> --}}
{{-- </div> --}}
