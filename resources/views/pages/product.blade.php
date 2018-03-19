@extends('app')
@section('title', $product->name.' '.trans('app.title_product'))
@section('content')
    <div class="uk-container">
        <div class="uk-grid-small uk-margin-top">
            @include('partials.alert')
        </div>
        <div class="uk-margin-top" uk-grid>
            <div class="uk-width-2-3@m">
                <div uk-grid>
                    <div class="uk-width-1-3@m uk-visible@m">
                        <div class="uk-thumbnav" uk-grid uk-tab="connect: #component-tab-left; animation: uk-animation-fade">
                            @if($product->images[0])
                                @foreach($product->images as $image)
                                    <div style="margin-bottom: 10px" class="uk-width-1-2"><a href="#"><img src="{{ uploadCDN(str_replace('original', 'small', $image->photo)) }}" alt="{{ $image->name }}" width="100" onerror="this.src = '{{imageCDN(config('common.default.image_2'))}}'"></a></div>
                                @endforeach
                            @else
                                <div style="margin-bottom: 10px" class="uk-width-1-2"><a href="#"><img src="{{ imageCDN(config('common.default.image_2')) }}" alt="{{ $image->name }}" width="100" ></a></div>
                            @endif
                        </div>
                    </div>
                    <div class="uk-width-2-3@m uk-visible@m">
                        <ul id="component-tab-left" class="uk-switcher">
                            @if($product->images[0])
                                @foreach($product->images as $image)
                                    <li>
                                      <div class="uk-inline uk-dark">
                                        <img src="{{ uploadCDN(str_replace('original', 'medium', $image->photo)) }}" alt="{{ $image->name }}" width="510" onerror="this.src = '{{imageCDN(config('common.default.image_2'))}}'">
                                        <a class="uk-position-absolute uk-transform-center" style="left: 90%; top: 90%" href="#modal-full-split-{{ $image->id }}" uk-toggle uk-marker uk-tooltip="title: full view; pos: left"></a>
                                      </div>
                                        <div id="modal-full-split-{{ $image->id }}" class="uk-modal-full" uk-modal>
                                            <div class="uk-modal-dialog">
                                                <button class="uk-modal-close-full" type="button" uk-close></button>
                                                <div class="uk-flex-middle uk-hidden@m">
                                                    <div class="uk-margin js-slideshow-animation" uk-slideshow="ratio: false">
                                                        <div class="uk-position-relative uk-visible-toggle uk-dark">
                                                            <ul class="uk-slideshow-items" uk-height-viewport="min-height: 300">
                                                                @if($product->images[0])
                                                                    <li>
                                                                        <img src="{{ uploadCDN($image->photo) }}" alt="" uk-cover>
                                                                    </li>
                                                                    @foreach($product->images as $imageMobile)
                                                                        @if($image->id != $imageMobile->id)
                                                                            <li>
                                                                                <img src="{{ uploadCDN($imageMobile->photo) }}" alt="" uk-cover>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                            <a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                                                            <a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                                                            <div class="uk-position-bottom-center uk-position-medium">
                                                                <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-flex-middle uk-visible@m">
                                                    <div class="uk-background-cover">
                                                      <div class="uk-margin js-slideshow-animation" uk-slideshow="ratio: 4:5">

                                                          <div class="uk-position-relative uk-visible-toggle uk-dark">

                                                              <ul class="uk-slideshow-items">
                                                                @if($product->images[0])
                                                                    <li>
                                                                      <img src="{{ uploadCDN($image->photo) }}" alt="" width="100%">
                                                                    </li>
                                                                    @foreach($product->images as $imageBrowser)
                                                                        @if($image->id != $imageBrowser->id)
                                                                            <li>
                                                                              <img src="{{ uploadCDN($imageBrowser->photo) }}" alt="" width="100%">
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                              </ul>

                                                              <a class="uk-slidenav-large uk-position-center-left uk-hidden-hover uk-height-viewport" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                                                              <a class="uk-slidenav-large uk-position-center-right uk-hidden-hover uk-height-viewport" href="#" uk-slidenav-next uk-slideshow-item="next"></a>



                                                          </div>

                                                      </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li style="margin-bottom: 10px"><a href="#"><img src="{{ imageCDN(config('common.default.image_2')) }}" alt="{{ $image->name }}" width="530" ></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="js-slideshow-animation uk-hidden@m" uk-slideshow="animation: pull; ratio: 4:5">
                  <div class="uk-position-relative uk-visible-toggle uk-dark">
                    <ul class="uk-slideshow-items">
                      @if($product->images[0])
                          @foreach($product->images as $image)
                          <li>
                            <img src="{{ uploadCDN(str_replace('original', 'small', $image->photo)) }}">
                            <a class="uk-position-absolute uk-transform-center" style="left: 90%; top: 90%" href="#modal-full-split-{{ $image->id }}" uk-toggle uk-marker uk-tooltip="title: full view; pos: left"></a>
                          </li>
                        @endforeach
                      @endif
                    </ul>
                    <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-small uk-dark"></ul>
                  </div>

                  </div>
            </div>
            <div class="uk-width-1-3@m">
                <a href="/shop?menu=designers&category={{$product->designer->slug}}">{{ $product->designer->name }}</a><br>
                <h3 class="uk-margin-remove">{{ $product->name }}</h3>
                @if($product->price_before_discount > 0)
                    <b>
                        <h4 class="uk-margin-remove"><del>{{ $product->currency }} {{ number_format($product->price_before_discount, 2) }}</del>
                            <span class="uk-text-danger">{{ $product->currency }} {{ number_format($product->sell_price, 2) }}</span>
                        </h4>
                    </b>
                @else
                    <h4 class="uk-margin-remove">{{ $product->currency }} {{ number_format($product->sell_price, 2) }} </h4>
                @endif

                <br>
                @if($rating)
                  <div class="stars-product uk-margin-remove-left">
                      <input disabled type="radio" name="star-m" class="star-1" value="1" {{$rating == 1? 'checked':'' }}/>
                      <input disabled type="radio" name="star-m" class="star-2" value="2" {{$rating == 2? 'checked':'' }}/>
                      <input disabled type="radio" name="star-m" class="star-3"  value="3" {{$rating == 3? 'checked':'' }}/>
                      <input disabled type="radio" name="star-m" class="star-4" value="4" {{$rating == 4? 'checked':'' }}/>
                      <input disabled type="radio" name="star-m" class="star-5"  value="5" {{$rating == 5? 'checked':'' }}/>
                      <span></span>
                  </div>
                @endif

                <button-buy
                        api_bag="{{ route('persist.bag') }}"
                        api_wishlist="{{ route('persist.wishlist') }}"
                        product="{{ json_encode($buttonBuy) }}"
                        sizes="{{ $product->stocks }}"
                        auth="{{ Auth::check() ? 1 : 0 }}"
                        method="{{ $method }}"
                        sku="{{ $sku }}"
                        id="{{ $id }}"
                        bag_link="{{ route('bag') }}"
                        wishlist_link="{{ route('user.wishlist') }}"
                        locale="{{ json_encode(trans('app')) }}"
                        aws_link="{{ config('filesystems.s3url') }}"
                ></button-buy>
                <hr>
                <p class="uk-margin-remove uk-text-meta">
                <ul class="uk-grid-small uk-flex-middle uk-flex-center" uk-grid>
                    <li><a class="uk-icon-link" uk-icon="icon: twitter" target="_blank" href="{{ $share['twitter']}}"></a></li>
                    <li><a class="uk-icon-link" uk-icon="icon: facebook" target="_blank" href="{{ $share['facebook']}}"></a></li>
                    <li><a class="uk-icon-link" uk-icon="icon: google-plus" target="_blank" href="{{ $share['gplus']}}"></a></li>
                    <li><a class="uk-icon-link" uk-icon="icon: whatsapp" target="_blank" href="{{ $share['whatsapp']}}"></a></li>
                </ul>
                </p>
                <hr class="uk-margin-small">
                <div class="uk-child-width-1-2 uk-margin-top uk-grid-divider uk-flex-middle uk-flex-center" uk-grid>
                    <div class="uk-text-center">
                        {{ trans('app.product_code') }} <br>
                        <h5 class="uk-margin-remove">{{ $product->product_code }}</h5>
                    </div>
                    <div class="uk-text-center">
                        <a href="/shop?menu={{strtolower($product->gender)}}&parent={{strtolower($product->category->parent->name)}}&category={{$product->category->slug}}">{{ $product->category->name }}</a>
                        <br>
                        <h5 class="uk-margin-remove"><a href="/shop?menu=designers&category={{$product->designer->slug}}">{{ $product->designer->name }}</a></h5>
                    </div>
                </div>
                <hr class="uk-margin-small">
          </div>
        </div>
        <hr>
        <div class="uk-panel uk-grid" uk-grid>
            <div class="uk-width-1-4@m">
                <a href="/{{'review/'.$product->slug}}" class="uk-button uk-button-default uk-text-uppercase">{{ trans ('app.write_review') }}</a>
            </div>
            @if($rating)
                <div class="uk-width-3-4@m">
                    <span class="uk-margin-remove-right uk-text-uppercase">{{ trans('app.rating_text') }}</span>
                    <div class="stars-product stars-position">
                        <input disabled type="radio" name="star" class="star-1" value="1" {{$rating == 1? 'checked':'' }}/>
                        <input disabled type="radio" name="star" class="star-2" value="2" {{$rating == 2? 'checked':'' }}/>
                        <input disabled type="radio" name="star" class="star-3"  value="3" {{$rating == 3? 'checked':'' }}/>
                        <input disabled type="radio" name="star" class="star-4" value="4" {{$rating == 4? 'checked':'' }}/>
                        <input disabled type="radio" name="star" class="star-5"  value="5" {{$rating == 5? 'checked':'' }}/>
                        <span></span>
                    </div>
                    <div class="stars-count-position">
                        {{$rating}}/5
                    </div>
                    <span><i>{{ trans('app.based_on') }} {{count($product->review)}} {{ trans('app.reviews') }}</i></span>
                </div>
            @else
              <div class="uk-panel">
                  <label class="uk-text-uppercase">{{ trans('app.shopper_text') }}</label> <br>
                {{ trans('app.comment_text') }}
              </div>
            @endif
        </div>
        <div id="review-ajax" class="uk-grid uk-visible@m" uk-grid>
            @foreach($reviews as $review)
                <div class="uk-width-1-3@m">
                    <div class="uk-card uk-card-border uk-card-small">
                        <div class="uk-card-body" style="min-height: 250px">
                            <div class="uk-flex uk-flex-center">
                                <div class="stars-product uk-margin-remove uk-text-center">
                                    <input disabled type="radio" name="star-{{$review->id}}" class="star-1" value="1" {{$review->rating == 1? 'checked':'' }}/>
                                    <input disabled type="radio" name="star-{{$review->id}}" class="star-2" value="2" {{$review->rating == 2? 'checked':'' }}/>
                                    <input disabled type="radio" name="star-{{$review->id}}" class="star-3"  value="3" {{$review->rating == 3? 'checked':'' }}/>
                                    <input disabled type="radio" name="star-{{$review->id}}" class="star-4" value="4" {{$review->rating == 4? 'checked':'' }}/>
                                    <input disabled type="radio" name="star-{{$review->id}}" class="star-5"  value="5" {{$review->rating == 5? 'checked':'' }}/>
                                    <span></span>
                                </div>
                            </div>
                            <div class="uk-text-bold uk-text-center uk-margin-top-small">
                                {{$review->title}}
                            </div>
                            <div class="uk-text-small uk-text-muted uk-text-center">
                                {{date_format($review->created_at,"F j, Y")}}
                            </div>
                            <div class="uk-text-left uk-margin-small-top">
                                <p class="uk-hidden" id="more-{{$review->id}}">{{ $review->review}}
                                    <a onclick="more({{$review->id}})" class="uk-text-bold uk-text-small"> {{ trans('app.show_less') }}</a>
                                </p>
                                <p id="less-{{$review->id}}">{!! str_limit($review->review,120) !!}
                                    @if(strlen($review->review) > 120)
                                        <a onclick="less({{$review->id}})" class="uk-text-bold uk-text-small"> {{ trans('app.show_more') }}</a>
                                    @endif
                                </p>
                            </div>
                            <div class="uk-text-small uk-text-left uk-margin-small-top">
                                {{ ucfirst($review->user->first_name).' '.ucfirst($review->user->last_name) }}
                            </div>
                            <div class="uk-text-small uk-text-muted uk-text-left">
                                {{$review->location}}
                            </div>
                            @if($review->comment)
                                <div class="uk-card uk-card-body uk-margin-small-top uk-text-small" style="background: #EEEEEE">
                                    <div class="uk-text-bold uk-text-center">
                                        {{ trans('app.rukuka_response') }}
                                    </div>
                                    <div class="uk-text-left uk-text-small uk-margin-small-top">
                                        {{$review->comment}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($rating)
        <div class="uk-grid uk-visible@m" uk-grid>
            <div id="loader" class="uk-grid-small uk-align-center">
                <div id="remove-row">
                    <h2>
                        @if(count($reviews) == 3)
                            <a onclick="myFunction({{ $reviews[2]->id .','. $product->id}})" id="btn-more" class="uk-button uk-button-default uk-text-uppercase" > {{ trans('app.more_review') }} </a>
                        @endif
                    </h2>
                </div>
            </div>
        </div>
        @endif

        <hr>
        <div class="uk-grid-small uk-margin-small-bottom uk-margin-top">
            <div class="uk-panel">
                <h4 class="uk-margin-small uk-text-uppercase">{{ trans('app.related') }}</h4>
            </div>
        </div>
        <related
                api="{{ route('related', ['categoryId' => $product->product_categories_id]) }}"
                product_api="{{ route('product.api') }}"
                bag_api="{{ route('persist.bag') }}"
                wishlist_api="{{ route('persist.wishlist') }}"
                auth="{{ Auth::check() ? 1 : 0 }}"
                aws_link="{{ config('filesystems.s3url') }}"
                default_image="{{ json_encode(config('common.default')) }}"
                bag_link="{{ route('bag') }}"
                locale="{{ json_encode(trans('app')) }}"
        ></related>
        <div class="uk-grid-small uk-margin-bottom uk-margin-small-top">
            <div class="uk-panel uk-text-center">
                <a  href="/shop?menu=designers&category=all" class="uk-button uk-button-small uk-button-text uk-text-uppercase">{{ trans('app.show_all_product') }}</a>
            </div>
        </div>
    </div>

@endsection

<script>
    function less(id) {
        $("#more-"+id).attr("class","");
        $("#less-"+id).attr("class","uk-hidden");
    }
    function more(id) {
        $("#more-"+id).attr("class","uk-hidden");
        $("#less-"+id).attr("class","");
    }

    function myFunction(id_review,id_product) {
        $("#btn-more").html("{{trans('app.loading')}}");

        $.ajax({
            url : '{{ url("review-ajax") }}',
            method : "POST",
            data : {id_review:id_review,id_product:id_product,_token:"{{csrf_token()}}"},
            dataType : "text",
            success : function (data)
            {
                if(data != '')
                {
                    var result = JSON.parse(data);
                    if(result.count < 3)
                    {
                        $('#remove-row').remove();
                        $('#review-ajax').append(result.review);
                        $('#loader').append(result.loader);
                        $('#remove-row').remove();
                    }
                    else{
                        $('#remove-row').remove();
                        $('#review-ajax').append(result.review);
                        $('#loader').append(result.loader);
                    }

                }
                else
                {
                    $('#remove-row').remove();
                }
            }
        });
    }
</script>
