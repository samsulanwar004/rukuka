@extends('app')

{{--Title--}}
@if($designer)
    @if($category == 'all')
        @section('title',  $designer->name.' '.trans('app.title_designers_list') )
    @else
        @section('title',  $designer->name.' '.trans('app.title_designers') )
    @endif
@else
    @if($categories == 'womens' && $category == 'all' || $categories == 'womens' && $slug == 'all')
        @section('title', trans('app.title_shop_womens') )
    @elseif($categories == 'mens' && $category == 'all' || $categories == 'mens' && $slug =='all')
        @section('title', trans('app.title_shop_mens') )
    @elseif($products->first()->category_name)
        @section('title',$products->first()->category_name.' '.trans('app.title_shop_category') )
    @else
        @section('title',trans('app.product_not_available').' '.trans('app.title_shop_category') )
    @endif
@endif
{{--End Title--}}

@section('content')
    <div class="uk-container">

        {{-- Start Designer Header  --}}
        @if($designer)
            <div class="uk-grid-small uk-margin-top" uk-grid>
                <div class="uk-panel uk-width-1-4 uk-text-center">
                    <img src="{{uploadCDN($designer->photo)}}" width="150" height="150" alt="rukuka designer" class="uk-box-shadow-medium" onerror="this.src = '{{imageCDN(config('common.default.image_6'))}}'">
                </div>
                <div class="uk-panel uk-width-3-4">
                    <span class="uk-text-lead">{{ $designer->name }}</span><br>
                    <span class="uk-text-small">{!! $designer->content !!}</span>
                </div>
            </div>
            <hr style="border-color: #333; border-width: 3px">
        @else

        @endif
        {{--End Designer Header--}}

        <div class="uk-background-muted uk-visible@m fixed" uk-grid>
            <div class="uk-width-1-5@m">
              <ul class="uk-grid uk-grid-small">
                <li><a href="#" uk-toggle="target: #nav1"><i class="material-icons" style="font-size: 18px">menu</i></a></li>
                <li>
                  @if($designer)
                       {{ $designer->name }}
                  @else
                      @if($category == 'all' || $slug == 'all')
                          {{ trans('app.all_you_need') }}
                      @else
                          {{ isset($products->first()->category_name) ? $products->first()->category_name : trans('app.product_not_available') }}
                      @endif
                  @endif
              </li>
              </ul>

            </div>
            <div class="uk-width-4-5@m">
                <div class="uk-grid-small" uk-grid >
                      <div class="uk-text-left uk-grid-small uk-width-expand" uk-grid>
                        <div class="uk-width-auto">
                          <a href="#">{{ trans('app.sort_by') }}<i class="material-icons"  style="font-size: 18px; vertical-align:middle">expand_more</i></a>
                          <div uk-drop="mode: hover; delay-hide: 0" style="width: 200px">
                              <div class="uk-card uk-background-default uk-box-shadow-small uk-card-small">
                                <div class="uk-card-body">
                                  <ul class="uk-list">
                                    <li>
                                        <a href="{{ actionLink(['sort' => 'desc'],['price','popular','discount']) }}">
                                          <span class="{{ $sortByNew == 'desc' ? 'uk-text-bold':'' }}">
                                              {{ trans('app.new_in') }}
                                          </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ actionLink(['popular' => 'desc'],['price','sort','discount']) }}">
                                          <span class="{{ $sortByPopular == 'desc' ? 'uk-text-bold':'' }}">
                                              {{ trans('app.popular_sort') }}
                                          </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ actionLink(['price' => 'desc'],['sort','popular','discount']) }}">
                                          <span class="{{ $sortByPrice == 'desc' ? 'uk-text-bold':'' }}">
                                              {{ trans('app.high') }}
                                          </span>
                                      </a>
                                    </li>
                                    <li>
                                      <a href="{{ actionLink(['price' => 'asc'],['sort','popular','discount']) }}">
                                          <span class="{{ $sortByPrice == 'asc' ? 'uk-text-bold':'' }}">
                                              {{ trans('app.low') }}
                                          </span>
                                      </a>
                                    </li>
                                    <li>
                                      <a href="{{ actionLink(['discount' => 'desc'],['sort','popular','price']) }}">
                                          <span class="{{ $sortByDiscount == 'desc' ? 'uk-text-bold':'' }}">
                                              {{ trans('app.discount') }}
                                          </span>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                          </div>
                          </div>

                          {{--Start Filter Web--}}
                          @foreach (Config::get('languages') as $lang => $language)
                              @if ($lang == App::getLocale())
                                  @php
                                      $currency_code = $language;
                                  @endphp
                              @endif
                          @endforeach
                          <div class="uk-width-expand">

                          @if($sortByNew || $sortByPopular || $colorId || $onSize || $range || $sortByPrice || $sortByDiscount)
                              {{ trans('app.filter') }} :
                          @endif

                          @if($sortByNew)
                              <a href="{{ actionLink(['sort' => null],['sort']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.new_in') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                          @endif
                          @if($sortByPopular)
                              <a href="{{ actionLink(['popular' => null],['popular']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.popular_sort') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                          @endif
                          @if($colorId)
                              <a href="{{ actionLink(['color_id' => null],['color_id']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ ucwords($colorId) }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                          @endif
                          @if($onSize)
                              <a href="{{ actionLink(['size' => null],['size']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.size') }} {{ strtoupper($onSize) }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                          @endif
                          @if($range)
                              <a href="{{ actionLink(['range' => null],['range']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ $currency_code }} {{ number_format($range['price_min']) }} - {{ number_format($range['price_max']) }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                          @endif
                          @if($sortByPrice)
                              @if($sortByPrice == 'asc')
                                <a href="{{ actionLink(['price' => null],['price']) }}"><span class="uk-label uk-label-success uk-text-capitalize">  {{ trans('app.low') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                              @else()
                                <a href="{{ actionLink(['price' => null],['price']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.high') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                              @endif
                          @endif
                          @if($sortByDiscount)
                              <a href="{{ actionLink(['discount' => null],['discount']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.discount') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                          @endif
                          </div>

                          {{--End Filter Web --}}

                      </div>
                      <div class="uk-width-auto uk-flex uk-flex-right">
                        <div class="uk-text-right">
                          <div class="uk-grid uk-grid-small">
                            <div>
                              @include('pagination.default', ['paginator' => $products])
                            </div>
                            <div>
                              <a href="{{ actionLink(['view' => 36]) }}" class="{{ $view == 36 ? 'uk-button-secondary' : 'uk-button-default'}} uk-button-small button-small-page" style="text-decoration:none">36</a>
                              <a href="{{ actionLink(['view' => 48]) }}" class="{{ $view == 48 ? 'uk-button-secondary' : 'uk-button-default'}} uk-button-small button-small-page" style="text-decoration:none">48</a>
                              <a href="{{ actionLink(['view' => 72]) }}" class="{{ $view == 72 ? 'uk-button-secondary' : 'uk-button-default'}} uk-button-small button-small-page" style="text-decoration:none">72</a>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>

            </div>
        </div>
        <div class="uk-hidden@m uk-child-width-1-2" uk-grid>
          <div>
            <a href="#">{{ trans('app.sort_by') }}
              <i class="material-icons"  style="font-size: 18px; vertical-align:middle">expand_more</i></a>
                <div uk-drop="mode: hover; delay-hide: 0" style="width: 200px">
                <div class="uk-card uk-background-default uk-box-shadow-small uk-card-small">
                  <div class="uk-card-body">
                    <ul class="uk-list">
                        <li>
                            <a href="{{ actionLink(['sort' => 'desc'],['price','popular','discount']) }}">
                                <span class="{{ $sortByNew == 'desc' ? 'uk-text-bold':'' }}">
                                    {{ trans('app.new_in') }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ actionLink(['popular' => 'desc'],['price','sort','discount']) }}">
                                <span class="{{ $sortByPopular == 'desc' ? 'uk-text-bold':'' }}">
                                    {{ trans('app.popular_sort') }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ actionLink(['price' => 'desc'],['sort','popular','discount']) }}">
                                <span class="{{ $sortByPrice == 'desc' ? 'uk-text-bold':'' }}">
                                    {{ trans('app.high') }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ actionLink(['price' => 'asc'],['sort','popular','discount']) }}">
                                <span class="{{ $sortByPrice == 'asc' ? 'uk-text-bold':'' }}">
                                    {{ trans('app.low') }}
                                </span>
                            </a>
                        </li>
                        <li>
                          <a href="{{ actionLink(['discount' => 'desc'],['sort','popular','price']) }}">
                              <span class="{{ $sortByDiscount == 'desc' ? 'uk-text-bold':'' }}">
                                  {{ trans('app.discount') }}
                              </span>
                          </a>
                        </li>
                    </ul>
                  </div>
                </div>
            </div>

          </div>

          <div class="uk-text-right">
            <a href="#modal" class="uk-button uk-button-default-warm uk-button-small" uk-toggle>{{ trans('app.filter') }}</a>
            <div id="modal" uk-modal>
              <div class="uk-modal-dialog uk-margin-auto-vertical">
                <div class="uk-modal-body" uk-overflow-auto>
                  <categories-mobile
                    parent="{{ $categories }}"
                    slug="{{ $slug == null ? $category:$slug }}"
                    category_slug="{{ $category }}"
                    sale="{{ $sale == null ? $category:$sale }}"
                    locale="{{ json_encode(trans('app')) }}"
                    designer_slug="{{ $designer ? $designer->slug : ''}}"
                    category_array="{{json_encode($categoryArray)}}"
                    category_count="{{json_encode($categoryCount)}}"
                  ></categories-mobile>

                  <color-palette-mobile
                    default_image="{{ json_encode(config('common.default')) }}"
                    aws_link="{{ config('filesystems.s3url') }}"
                    color_id="{{ $colorId }}"
                    locale="{{ json_encode(trans('app')) }}"
                    action_link="{{ actionLink() }}"
                    color_array="{{json_encode($colorArray)}}"
                  ></color-palette-mobile>

                    <div>
                        <ul class="uk-accordion" uk-accordion>
                            <li class="{{ $onSize ? 'uk-open' : ''}}"><span href="#" class="uk-accordion-title">{{ trans('app.size') }}</span>
                                <div class="uk-accordion-content">
                                    <ul class="uk-grid uk-grid-collapse">
                                        @foreach($sizeArray as $size)
                                            <li>
                                                <a href="{{ actionLink(['size' => strtolower($size)]) }}" class="{{ $onSize == strtolower($size) ? 'uk-button-secondary' : 'uk-button-default'}} uk-button-small size-button" style="text-decoration:none">{{ strtoupper($size) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="uk-accordion" uk-accordion>
                            <li><span href="#" class="uk-accordion-title">{{ trans('app.price') }}</span>
                                <div class="uk-accordion-content">
                                    <div class="uk-grid uk-grid-small uk-child-width-1-2" uk-grid>
                                        <div>
                                            <label class="uk-text-meta">{{ trans('app.min_price') }}</label>
                                            <input type="text" name="price_min" id="price_min_mobile" min="0" class="uk-input uk-form-small" value="{{ $range['price_min'] }}" placeholder="">
                                        </div>
                                        <div>
                                            <label class="uk-text-meta">{{ trans('app.max_price') }}</label>
                                            <input type="text" name="price_max" id="price_max_mobile" class="uk-input uk-form-small" value="{{ $range['price_max'] }}" placeholder="">
                                        </div>
                                    </div>
                                    <button class="uk-button uk-button-default uk-button-small uk-width-1-1 uk-margin-small-top" onclick="rangeMobile()" >{{ trans('app.find') }}</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="uk-modal-footer">
                  <a href="#" class="uk-button uk-button-default uk-button-small uk-width-1-1 uk-modal-close">{{ trans('app.close') }}</a>
                </div>

              </div>
            </div>
          </div>
        </div>
        {{--Start Filter Mobile--}}
        @if($sortByNew || $sortByPopular || $colorId || $onSize || $range || $sortByPrice || $sortByDiscount)
            <div class="uk-card uk-card-small uk-background-muted uk-margin-small-top uk-hidden@m ">
                <div class="uk-card-body" style="padding:10px">
                    {{ trans('app.filter') }} :
                    @if($sortByNew)
                        <a href="{{ actionLink(['sort' => null],['sort']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.new_in') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                    @endif
                    @if($sortByPopular)
                        <a href="{{ actionLink(['popular' => null],['popular']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.popular_sort') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                    @endif
                    @if($colorId)
                        <a href="{{ actionLink(['color_id' => null],['color_id']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ ucwords($colorId) }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                    @endif
                    @if($onSize)
                        <a href="{{ actionLink(['size' => null],['size']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.size') }} {{ strtoupper($onSize) }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                    @endif
                    @if($range)
                        <a href="{{ actionLink(['range' => null],['range']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ $currency_code }} {{ number_format($range['price_min']) }} - {{ number_format($range['price_max']) }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                    @endif
                    @if($sortByPrice)
                        @if($sortByPrice == 'asc')
                          <a href="{{ actionLink(['price' => null],['price']) }}"><span class="uk-label uk-label-success uk-text-capitalize">  {{ trans('app.low') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                        @else()
                          <a href="{{ actionLink(['price' => null],['price']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.high') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                        @endif
                    @endif
                    @if($sortByDiscount)
                        <a href="{{ actionLink(['discount' => null],['discount']) }}"><span class="uk-label uk-label-success uk-text-capitalize"> {{ trans('app.discount') }} <i class="material-icons"  style="font-size: 14px; vertical-align:middle">close</i></span></a>
                    @endif
                </div>
            </div>
        @endif
        {{--End Filter Mobile --}}

        <div class="uk-grid uk-margin-small-top" uk-grid>
          <div id="nav1" class="uk-width-1-5@m uk-visible@m">

            <categories
              api="{{ route('categories') }}"
              parent="{{ $categories }}"
              slug="{{ $slug == null ? $category:$slug }}"
              category_slug="{{ $category }}"
              sale="{{ $sale == null ? $category:$sale }}"
              locale="{{ json_encode(trans('app')) }}"
              designer_slug="{{ $designer ? $designer->slug : ''}}"
              category_array="{{json_encode($categoryArray)}}"
              category_count="{{json_encode($categoryCount)}}"
            ></categories>
            <color-palette
              api="{{ route('color') }}"
              default_image="{{ json_encode(config('common.default')) }}"
              aws_link="{{ config('filesystems.s3url') }}"
              color_id="{{ $colorId }}"
              locale="{{ json_encode(trans('app')) }}"
              action_link="{{ actionLink() }}"
              color_array="{{json_encode($colorArray)}}"
            ></color-palette>
            <div>
              <ul class="uk-accordion" uk-accordion>
                <li class="{{ $onSize ? 'uk-open' : ''}}"><span href="#" class="uk-accordion-title">{{ trans('app.size') }}</span>
                  <div class="uk-accordion-content">
                    <ul class="uk-grid uk-grid-collapse">
                      @foreach($sizeArray as $size)
                        <li>
                          <a href="{{ actionLink(['size' => strtolower($size)]) }}" class="{{ $onSize == strtolower($size) ? 'uk-button-secondary' : 'uk-button-default'}} uk-button-small size-button" style="text-decoration:none">{{ strtoupper($size) }}</a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
            <div>
              <ul class="uk-accordion" uk-accordion>
                  <li><span href="#" class="uk-accordion-title">{{ trans('app.price') }}</span>
                  <div class="uk-accordion-content">
                    <div class="uk-grid uk-grid-small uk-child-width-1-2" uk-grid>
                      <div>
                        <label class="uk-text-meta">{{ trans('app.min_price') }}</label>
                        <input type="text" name="price_min" id="price_min" min="0" class="uk-input uk-form-small" value="{{ $range['price_min'] }}" placeholder="">
                      </div>
                      <div>
                        <label class="uk-text-meta">{{ trans('app.max_price') }}</label>
                        <input type="text" name="price_max" id="price_max" min="0" class="uk-input uk-form-small" value="{{ $range['price_max'] }}" placeholder="">
                      </div>
                    </div>
                      <button class="uk-button uk-button-default uk-button-small uk-width-1-1 uk-margin-small-top" onclick="range()" >{{ trans('app.find') }}</button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="uk-width-expand@m">
            <shop
              shops ="{{ $shops }}"
              menu ="{{ $categories }}"
              product_api="{{ route('product.api') }}"
              bag_api="{{ route('persist.bag') }}"
              wishlist_api="{{ route('persist.wishlist') }}"
              auth="{{ Auth::check() ? 1 : 0 }}"
              aws_link="{{ config('filesystems.s3url') }}"
              default_image="{{ json_encode(config('common.default')) }}"
              bag_link="{{ route('bag') }}"
              locale="{{ json_encode(trans('app')) }}"
            ></shop>
          </div>
        </div>

          <div class="uk-text-right uk-margin-bottom uk-margin-top">

            @include('pagination.default', ['paginator' => $products])

          </div>
        <hr>
        @if($recently)
        <div class="uk-grid-small uk-margin-small-bottom uk-margin-top">
            <div class="uk-panel">
                <h4 class="uk-margin-small uk-text-uppercase">{{ trans('app.recently_view') }}</h4>
            </div>
        </div>
        <related
                api="{{ route('recently') }}"
                menu ="{{ $categories }}"
                product_api="{{ route('product.api') }}"
                bag_api="{{ route('persist.bag') }}"
                wishlist_api="{{ route('persist.wishlist') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                token="{{ Auth::check() ? Auth::user()->api_token : '' }}"
                aws_link="{{ config('filesystems.s3url') }}"
                default_image="{{ json_encode(config('common.default')) }}"
                recently="{{ json_encode($recently) }}"
                bag_link="{{ route('bag') }}"
                locale="{{ json_encode(trans('app')) }}"
        ></related>

        <div class="uk-grid-small uk-margin-bottom uk-margin-small-top">
            <div class="uk-panel uk-text-center">
                <a  href="/shop?menu={{$categories}}&parent=all" class="uk-button uk-button-small uk-button-text uk-text-uppercase">{{ trans('app.show_all_product') }}</a>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('footer_scripts')
    <script type="text/javascript">
        function range() {
            var input_min = document.getElementById("price_min").value;
            var input_max = document.getElementById("price_max").value;
            var min = replaceNumberFormat(input_min);
            var max = replaceNumberFormat(input_max);

            if(min <= 0){
                var min = 0;
            }
            if(max <= 0){
                var max = 0;
            }
            var range_value = min+'-'+max;
            var href = window.location.href;

            var search = function searchStringInArray (str, strArray) {
                for (var j=0; j<strArray.length; j++) {
                    if (strArray[j].match(str)) return j;
                }
                return -1;
            }
            var myarr = href.split("&");
            var position = search('range',myarr);
            if(position == -1) {
                window.location.href = href+'&range='+range_value;
            } else {
                delete myarr[position];
                var link = myarr.join('&')+'&range='+range_value;
                window.location.href =  link.replace('&&','&');
            }
        }
        function rangeMobile() {
            var input_min = document.getElementById("price_min_mobile").value;
            var input_max = document.getElementById("price_max_mobile").value;
            var min = replaceNumberFormat(input_min);
            var max = replaceNumberFormat(input_max);

            if(min <= 0){
                var min = 0;
            }
            if(max <= 0){
                var max = 0;
            }
            var range_value = min+'-'+max;
            var href = window.location.href;

            var search = function searchStringInArray (str, strArray) {
                for (var j=0; j<strArray.length; j++) {
                    if (strArray[j].match(str)) return j;
                }
                return -1;
            }
            var myarr = href.split("&");
            var position = search('range',myarr);
            if(position == -1) {
                window.location.href = href+'&range='+range_value;
            } else {
                delete myarr[position];
                var link = myarr.join('&')+'&range='+range_value;
                window.location.href =  link.replace('&&','&');
            }
        }

        function replaceNumberFormat(input)
        {
            var temp = '';
            for (i = 0; i < input.length; i++) {
                if(input[i] != '.'){
                    temp = String(temp) + String(input[i]);
                }
            }
            return temp;
        }


        $(document).ready(function(){

        // Start Currency Format
        /* price_min */
        var price_min = document.getElementById('price_min');

        price_min.addEventListener('keyup', function(e)
        {
            price_min.value = formatCurrency(this.value);
        });
        price_min.value = formatCurrency( price_min.value);

        /* price_max */
        var price_max = document.getElementById('price_max');
        price_max.addEventListener('keyup', function(e)
        {
            price_max.value = formatCurrency(this.value);
        });
        price_max.value = formatCurrency( price_max.value);

        /* price_min_mobile */
        var price_min_mobile = document.getElementById('price_min_mobile');
        price_min_mobile.addEventListener('keyup', function(e)
        {
            price_min_mobile.value = formatCurrency(this.value);
        });
        price_min_mobile.value = formatCurrency( price_min_mobile.value);

        /* price_max_mobile */
        var price_max_mobile = document.getElementById('price_max_mobile');
        price_max_mobile.addEventListener('keyup', function(e)
        {
            price_max_mobile.value = formatCurrency(this.value);
        });
        price_max_mobile.value = formatCurrency( price_max_mobile.value);

        function formatCurrency(number, prefix)
        {
            var number_string = number.replace(/[^,\d]/g, '').toString(),
                split	= number_string.split(','),
                remain 	= split[0].length % 3,
                currency 	= split[0].substr(0, remain),
                ribuan 	= split[0].substr(remain).match(/\d{3}/gi);

            if (ribuan) {
                separator = remain ? '.' : '';
                currency += separator + ribuan.join('.');
            }

            currency = split[1] != undefined ? currency + ',' + split[1] : currency;
            return prefix == undefined ? currency : (currency ? '' + currency : '');
        }
        });
        // End Currency Format

    </script>
@endsection
