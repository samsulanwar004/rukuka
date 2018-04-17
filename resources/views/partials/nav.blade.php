@php
  $women = Request::segment(1) == "women" || Request::segment(1) == "designer" || Request::segment(1) == "editorial" || Request::input('gender') == "womens" || $categories == "womens" || $product->gender == "womens" || $product->gender == "unisex" ? "womens" : null;
  $men = Request::segment(1) == "men" || Request::segment(1) == "designer" || Request::segment(1) == "editorial" ||  Request::input('gender') == "mens" || $categories == "mens" || $product->gender == "mens" || $product->gender == "unisex" ? "mens" : null;

  if($women) {
    $navigation = $women;
  } elseif ($men) {
    $navigation = $men;
  } else {
    $navigation = null;
  }

@endphp
<div class="uk-section-xsmall uk-background-default uk-margin-remove uk-padding-remove" style="border-color: #333; border-width: 5px">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-remove-vertical header-let">
        <div class="uk-container">
          <div class="uk-grid-small" uk-grid>
              <div class="uk-width-2-5@m uk-flex uk-flex-middle">
                <ul class="uk-navbar-nav">
                  <li class="uk-margin-medium-right {{ $navigation == 'mens' ? 'uk-active' : ''}}"><a href="{{ route('men') }}"> Men </a></li>
                  <li class="{{ $navigation == 'womens' ? 'uk-active' : ''}}"><a href="{{ route('women') }}"> Women </a></li>
                </ul>


              </div>
              <div class="uk-width-1-5@m">
                <div class="uk-panel uk-text-center">
                      <a href="/{{ str_replace('s', '', $navigation) }}" class="uk-link-reset">
                        <div class="uk-inline">
                          <img src="{{ imageCDN(config('common.logo')) }}" alt="rukuka" width="90">
                        </div>
                      </a>
                </div>
              </div>
              @foreach (Config::get('languages') as $lang => $language)
                  @if ($lang == App::getLocale())
                      @php
                        $currency_code = $language;
                      @endphp
                  @endif
              @endforeach
              <user-panel
                profile_link="{{ route('user') }}"
                history_link="{{ route('user.history') }}"
                wishlist_link="{{ route('user.wishlist') }}"
                bag_link="{{ route('bag') }}"
                login_link="{{ route('login') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                account="{{ Auth::user('web') }}"
                wishlist_api="{{ route('wishlist') }}"
                bag_api="{{ route('persist.bag') }}"
                product_link="{{ route('product') }}"
                checkout_link="{{ route('checkout') }}"
                api_token="{{ Auth::user('web')->api_token }}"
                logout_link="{{ route('logout') }}"
                aws_link="{{ config('filesystems.s3url') }}"
                default_image="{{ json_encode(config('common.default')) }}"
                locale="{{ json_encode(trans('app')) }}"
                exchange_api="{{ route('exchange') }}"
                currency_code="{{ $currency_code }}"
                language="{{ App::getLocale() }}"
              ></user-panel>
          </div>

        </div>
    </div>
      <div class="cbp-af-header {{ $navigation || $category == 'designers' ? '':'uk-hidden' }}">
        <navigation
          api="{{ route('menu')}}"
          men_link="{{ route('men') }}"
          women_link="{{ route('women') }}"
          designer_link="{{ route('designer') }}"
          aws_link="{{ config('filesystems.s3url') }}"
          default_image="{{ json_encode(config('common.default')) }}"
          locale="{{ json_encode(trans('app')) }}"
          profile_link="{{ route('user') }}"
          history_link="{{ route('user.history') }}"
          wishlist_link="{{ route('user.wishlist') }}"
          bag_link="{{ route('bag') }}"
          login_link="{{ route('login') }}"
          auth="{{ Auth::check() ? 1 : 0 }}"
          account="{{ Auth::user('web') }}"
          wishlist_api="{{ route('wishlist') }}"
          bag_api="{{ route('persist.bag') }}"
          product_link="{{ route('product') }}"
          checkout_link="{{ route('checkout') }}"
          api_token="{{ Auth::user('web')->api_token }}"
          logout_link="{{ route('logout') }}"
          default_image="{{ json_encode(config('common.default')) }}"
          locale="{{ json_encode(trans('app')) }}"
          exchange_api="{{ route('exchange') }}"
          currency_code="{{ $currency_code }}"
          language="{{ App::getLocale() }}"
          navigation="{{ $navigation }}"
          category="{{ isset($category) ? $category : null }}"
          designer="{{ Request::segment(1) == "designer" ? true : false }}"
          editorial="{{ Request::segment(1) == "editorial" ? true : false }}"
        ></navigation>
      </div>

  </div>
  @if ($navigation || $category == 'designers')
    <div class="uk-section uk-section-xsmall uk-padding-remove uk-margin-medium-top">
      <div class="uk-container">
        <div class="uk-alert-alert" uk-alert>
            <a href="#" class="uk-alert-close" uk-close></a>
            <p class="uk-text-center">
                {{ trans('app.header_note') }} <a href="https://rukuka.com/lookbook/amazon-fashion-week"> <b> <u>{{ trans('app.afw') }}</u> </b> </a></b>
            </p>
        </div>
      </div>
    </div>
  @else
    <div class="uk-section uk-section-xsmall uk-padding-remove">
      <div class="uk-container">
        <div class="uk-alert-alert" uk-alert>
            <a href="#" class="uk-alert-close" uk-close></a>
            <p class="uk-text-center">
                {{ trans('app.header_note') }} <a href="https://rukuka.com/lookbook/amazon-fashion-week"> <b> <u>{{ trans('app.afw') }}</u> </b> </a></b>
            </p>
        </div>
      </div>
    </div>
  @endif

@section('footer_scripts')
    <script>
        $.typeahead({
            input: '.js-typeahead-designers',
            order: "asc",
            minLength: 1,
            maxItemPerGroup: 5,
            source: {
                designer:
                    {
                        ajax: {
                            url: "{{ route('typeahead') }}", path: "data"
                        }
                    }
            },
            callback: {
                onClick: function (node, a, item, event) {
                  var navigation = "{{$navigation}}";
                    var designer_slug = slugify(item.display);
                    window.location.replace("/shop?menu="+navigation+"&designer="+ designer_slug);
                }
            }
        });

        function slugify(text)
        {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }

    </script>
@endsection
