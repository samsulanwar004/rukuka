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
                <div class="uk-grid-small uk-child-width-1-2" uk-grid >
                      <div class="uk-text-left">
                          <a href="#">{{ trans('app.sort_by') }}<i class="material-icons"  style="font-size: 18px; vertical-align:middle">expand_more</i></a>
                          <div uk-drop="mode: hover; delay-hide: 0" style="width: 200px">
                              <div class="uk-card uk-background-default uk-box-shadow-small uk-card-small">
                                <div class="uk-card-body">
                                  <ul class="uk-list">
                                  <li>
                                      <a href="{{ actionLink(['sort' => 'desc'],['price','popular']) }}">
                                        <span class="{{ $sortByNew == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.new_in') }}
                                        </span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="{{ actionLink(['popular' => 'desc'],['price','sort']) }}">
                                        <span class="{{ $sortByPopular == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.popular_sort') }}
                                        </span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="{{ actionLink(['price' => 'desc'],['sort','popular']) }}">
                                        <span class="{{ $sortByPrice == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.high') }}
                                        </span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ actionLink(['price' => 'asc'],['sort','popular']) }}">
                                        <span class="{{ $sortByPrice == 'asc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.low') }}
                                        </span>
                                    </a>
                                  </li>
                                  </ul>
                                </div>

                              </div>
                          </div>
                      </div>
                      <div>
                        <div class="uk-text-right">
                          <div class="uk-grid uk-flex uk-flex-right">
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
                            <a href="{{ actionLink(['sort' => 'desc'],['price','popular']) }}">
                                        <span class="{{ $sortByNew == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.new_in') }}
                                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ actionLink(['popular' => 'desc'],['price','sort']) }}">
                                        <span class="{{ $sortByPopular == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.popular_sort') }}
                                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ actionLink(['price' => 'desc'],['sort','popular']) }}">
                                        <span class="{{ $sortByPrice == 'desc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.high') }}
                                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ actionLink(['price' => 'asc'],['sort','popular']) }}">
                                        <span class="{{ $sortByPrice == 'asc' ? 'uk-text-bold':'' }}">
                                            {{ trans('app.low') }}
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
                  ></categories-mobile>

                  <color-palette-mobile
                    default_image="{{ json_encode(config('common.default')) }}"
                    aws_link="{{ config('filesystems.s3url') }}"
                    color_id="{{ $colorId }}"
                    locale="{{ json_encode(trans('app')) }}"
                    action_link="{{ actionLink() }}"
                    color_array="{{json_encode($colorArray)}}"
                  ></color-palette-mobile>
                </div>
                <div class="uk-modal-footer">
                  <a href="#" class="uk-button uk-button-default uk-button-small uk-width-1-1 uk-modal-close">{{ trans('app.close') }}</a>
                </div>

              </div>
            </div>
          </div>
        </div>

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
                <li class="{{ $onSize ? 'uk-open' : ''}}"><span href="#" class="uk-accordion-title">Size</span>
                  <div class="uk-accordion-content">
                    <ul class="uk-grid uk-grid-collapse">
                      @foreach($sizeArray as $size)
                        <li>
                          <a href="{{ actionLink(['size' => $size]) }}" class="{{ $onSize == $size ? 'uk-button-secondary' : 'uk-button-default'}} uk-button-small size-button" style="text-decoration:none">{{ strtoupper($size) }}</a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
            <div>
              <ul class="uk-accordion" uk-accordion>
                <li><span href="#" class="uk-accordion-title">Price</span>
                  <div class="uk-accordion-content">
                    <div class="uk-grid uk-grid-small uk-child-width-1-2" uk-grid>
                      <div>
                        <label class="uk-text-meta">Min Price</label>
                        <input type="text" name="start" class="uk-input uk-form-small" value="" placeholder="Rp.">
                      </div>
                      <div>
                        <label class="uk-text-meta">Max Price</label>
                        <input type="text" name="start" class="uk-input uk-form-small" value="" placeholder="Rp.">
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>

          </div>
          <div class="uk-width-expand@m">
            <shop
              shops ="{{ $shops }}"
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
                product_api="{{ route('product.api') }}"
                bag_api="{{ route('persist.bag') }}"
                wishlist_api="{{ route('persist.wishlist') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
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
