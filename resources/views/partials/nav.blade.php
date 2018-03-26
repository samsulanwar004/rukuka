<div class="uk-section-xsmall uk-background-default uk-margin-remove uk-padding-remove" style="border-color: #333; border-width: 5px" uk-sticky="bottom: #hash; animation: uk-animation-slide-top;">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-remove-vertical">
        <div class="uk-container">
          <div class="uk-grid-small" uk-grid>
              <div class="uk-width-1-3@m uk-flex uk-flex-middle">
                <div class="uk-panel">
                    {{ Form::open(array('url' => '/search', 'method' =>'get','files' => true,'class' => 'uk-search uk-form-width-medium uk-first-column')) }}
                    <button type="submit" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon></button>
                    <div>
                        <div class="typeahead__container">
                            <div class="typeahead__field">
                                <span class="typeahead__query">
                                    <input class="js-typeahead-designers" type="search" class=" uk-search-input" name="keyword" autocomplete="off" required placeholder="{{ trans('app.search') }}">
                                    <button type="submit" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
              </div>
              <div class="uk-width-1-3@m">
                <div class="uk-panel uk-text-center">
                      <a href="/" class="uk-link-reset">
                        <div class="uk-inline">
                          <img src="{{ imageCDN(config('common.logo')) }}" alt="rukuka" width="90">
                          <div class="uk-overlay uk-position-top">
                            <p style="margin-top: -20px;margin-left: 45px;font-size: 12px;">BETA</p>
                          </div>
                        </div>
                      </a>
                </div>
              </div>
              @foreach (Config::get('languages') as $lang => $language)
                  @if ($lang == App::getLocale())
                      @php
                        $currency_code = $language
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
    <navigation
      api="{{ route('menu')}}"
      men_link="{{ route('men') }}"
      women_link="{{ route('women') }}"
      designer_link="{{ route('designer') }}"
      aws_link="{{ config('filesystems.s3url') }}"
      default_image="{{ json_encode(config('common.default')) }}"
      locale="{{ json_encode(trans('app')) }}"
      segment_page="{{ Request::segment(1) }}"
      segment_shop="{{ $categories }}"
    ></navigation>
  </div>
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
                    var designer_slug = slugify(item.display);
                    window.location.replace("/shop?menu=designers&category="+ designer_slug);
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
