@extends('app_checkout')
@section('title', trans('app.title_shipping_preview') )
@section('content')
<div class="uk-section uk-section-muted uk-section-xsmall">
<div class="uk-container uk-container-small">
    <div class="uk-grid-small uk-margin-top">
        @include('partials.alert')
    </div>
    <div class="uk-grid uk-margin-top" uk-grid>
        <div class="uk-width-2-3@m">
            <div class="uk-card uk-card-default uk-card-small uk-box-shadow-small">
              <div class="uk-card-body">
               <div class="uk-grid uk-grid-divider uk-child-width-1-3 uk-margin-small" uk-grid>
                 <div class="uk-text-center">
                     <a href="{{ route('checkout') }}" class="uk-button uk-button-text">{{ trans('app.shipping_address') }}</a>
                 </div>
                 <div class="uk-text-center">
                     <a href="{{ route('checkout.shipping') }}" class="uk-button uk-button-text">{{ trans('app.shipping_option') }}</a>
                 </div>
                 <div class="uk-text-center">
                     <button class="uk-button uk-button-text" disabled><b>{{ trans('app.review') }}</b></button>
                 </div>
               </div>
             </div>
             </div>
            <h6>{{ trans('app.confirm_order') }}</h6>
            <div class="uk-card uk-card-small uk-card-default uk-margin-top">
              <div class="uk-card-header">
                <h4>{{ trans('app.payment_method') }}</h4>
              </div>
              <div class="uk-card-badge">
                <a href="#flag-modal" uk-toggle><img src="{{ imageCDN('flag1x1/'.$language.'.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt="">
                    <span class="uk-text-uppercase">{{ $currency }}</span>
                  </a>
                  <div id="flag-modal" class="uk-modal-full" uk-modal>
                      <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
                          <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                          <div class="uk-width-xxlarge uk-padding-large uk-text-center">
                              <h3 class="uk-text-uppercase">{{ trans('app.currency_title') }}</h3>
                              <button class="uk-button uk-button-small uk-button-default uk-text-uppercase" disabled>{{ trans('app.currency_set') }} <img src="{{ imageCDN('flag1x1/'.$language.'.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt="">
                                {{ $currency }}
                              </button>
                              <h5 class="uk-text-uppercase">{{ trans('app.usca') }}</h5>
                              <div class="uk-grid uk-child-width-1-2@m uk-gird-small" uk-grid>
                                <div>
                                  <a href="/lang/ca"><h6>{{ trans('app.cad') }} <img src="{{ imageCDN('flag1x1/ca.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.ca') }}</h6></a>
                                </div>
                                <div>
                                  <a href="/lang/en"><h6>{{ trans('app.usd') }} <img src="{{ imageCDN('flag1x1/en.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.us') }}</h6></a>
                                </div>
                              </div>
                              <h5 class="uk-text-uppercase">{{ trans('app.asea') }}</h5>
                              <div class="uk-grid uk-child-width-1-3@m uk-grid-small" uk-grid>
                                <div>
                                  <a href="/lang/id"><h6>{{ trans('app.idr') }} <img src="{{ imageCDN('flag1x1/id.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.id') }}</h6></a>
                                </div>
                                <div>
                                  <a href="/lang/sg"><h6>{{ trans('app.sgd') }} <img src="{{ imageCDN('flag1x1/sg.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.sg') }}</h6></a>
                                </div>
                                <div>
                                  <a href="/lang/my"><h6>{{ trans('app.myr') }} <img src="{{ imageCDN('flag1x1/my.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.my') }}</h6></a>
                                </div>
                                <div>
                                  <a href="/lang/bn"><h6>{{ trans('app.bnd') }} <img src="{{ imageCDN('flag1x1/bn.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.bn') }}</h6></a>
                                </div>
                                <div>
                                  <a href="/lang/jp"><h6>{{ trans('app.jpy') }} <img src="{{ imageCDN('flag1x1/jp.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.jp') }}</h6></a>
                                </div>
                                <div>
                                  <a href="/lang/kr"><h6>{{ trans('app.krw') }} <img src="{{ imageCDN('flag1x1/kr.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.kr') }}</h6></a>
                                </div>
                                <div>
                                  <a href="/lang/cn"><h6>{{ trans('app.cny') }} <img src="{{ imageCDN('flag1x1/cn.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.cn') }}</h6></a>
                                </div>
                                <div>
                                  <a href="/lang/hk"><h6>{{ trans('app.hkd') }} <img src="{{ imageCDN('flag1x1/hk.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.hk') }}</h6></a>
                                </div>
                              </div>
                              <h5 class="uk-text-uppercase">{{ trans('app.euro') }}</h5>
                                <a href="/lang/eu"><h6>{{ trans('app.eur') }} <img src="{{ imageCDN('flag1x1/eu.svg') }}" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans('app.eu') }}</h6></a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="uk-card-body">

                <form action="{{ route('order') }}" method="POST">
                  {{ csrf_field() }}
                      <div class="uk-grid-small uk-child-width-1-2" uk-grid>
                        <div>
                          <div class="uk-card uk-card-default uk-background-muted uk-card-small uk-card-hover">
                            <div class="uk-card-header">
                              <h4><input type="radio" class="uk-radio" name="payment_method" value="bank_transfer" required="required" style="margin-top:0" {{ $currency != 'idr' ? 'disabled' : '' }}> Bank Transfer</h4>
                            </div>
                            <div class="uk-card-body">
                              <h6>Bank Transfer Supported (IDR): </h6>
                              <ul class="uk-grid uk-child-width-1-3">
                                <li><img src="{{ imageCDN('bca.png') }}" alt="bca" height="50"></li>
                                <li><img src="{{ imageCDN('bni.png') }}" alt="bni" height="50"></li>
                                <li><img src="{{ imageCDN('mandiri.png') }}" alt="mandiri" height="50"></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="uk-card uk-card-default uk-background-muted uk-card-small uk-card-hover">
                            <div class="uk-card-header">
                              <h4><input type="radio" class="uk-radio" name="payment_method" value="creditcard" required="required" style="margin-top:0" {{ $currency != 'idr' ? 'checked' : '' }}> Credit Card</h4>
                            </div>
                            <div class="uk-card-body">
                              <h6>Credit Card Supported: </h6>
                              <ul class="uk-grid uk-child-width-1-2">
                                <li><img src="{{ imageCDN('visa.png') }}" alt="Visa" width="65"></li>
                                <li><img src="{{ imageCDN('mastercard.png') }}" alt="Master Card" width="65"></li>

                              </ul>

                            </div>
                          </div>
                        </div>
                      </div>
                  <input type="hidden" name="order" value="ok">
                  <input type="submit" name="submit" id="submit" style="display: none;">
                </form>
              </div>
            </div>
            <div class="uk-card uk-card-small uk-card-default uk-margin-top">
              <div class="uk-card-header">
                <h4>{{ trans('app.shipping_detail') }}</h4>
              </div>
              <div class="uk-card-body">
                <table class="uk-table uk-table-divider uk-table-small uk-text-meta uk-table-hover uk-background-muted">
                    <tbody>
                      <tr>
                        <td class="uk-width-small">{{ trans('app.full_name') }}</td>
                        <td>{{ $defaultAddress->first_name }} {{ $defaultAddress->last_name}}</td>
                      </tr>
                      <tr>
                        <td>{{ trans('app.company') }}  </td>
                        <td>{{ $defaultAddress->company }}</td>
                      </tr>
                      <tr>
                        <td>{{ trans('app.address_line') }}  </td>
                        <td>{{ $defaultAddress->address_line }}</td>
                      </tr>
                      <tr>
                        <td>{{ trans('app.city') }}     </td>
                        <td>{{ $defaultAddress->city }}</td>
                      </tr>
                      <tr>
                          <td>{{ trans('app.country') }} </td>
                          <td>{{ $defaultAddress->country }}</td>
                      </tr>
                      <tr>
                          <td>{{ trans('app.postal') }}</td>
                          <td>{{ $defaultAddress->postal }}</td>
                      </tr>
                      <tr>
                          <td>{{ trans('app.phone') }}</td>
                          <td>{{ $defaultAddress->phone_number }}</td>
                      </tr>
                    </tbody>
                  </table>
                  <h6>{{ trans('app.today') }}: {{ \Carbon\Carbon::now()->toDayDateTimeString() }}</h6>
                  <table class="uk-table uk-table-divider uk-table-hover">
                      <tbody>
                          <tr class="uk-active">
                              <td>
                                  <input type="radio" class="uk-radio" name="shipping" value="1" required="required" checked> </td>
                              <td> {{ $shippingCost['data']->origin->serviceName }} </td>
                              <td> {{ $shippingCost['data']->total_fee_label }}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </div>

              <div class="uk-card uk-card-small uk-card-default uk-margin-top uk-margin-bottom">
                <div class="uk-card-header">
                  <h4>Your Shopping Bag</h4>
                </div>
                <div class="uk-card-body">
              <item-checkout
                 bag_api="{{ route('persist.bag') }}"
                 aws_link="{{ config('filesystems.s3url') }}"
                 default_image="{{ json_encode(config('common.default')) }}"
                 locale="{{ json_encode(trans('app')) }}"
                 exchange_api="{{ route('exchange') }}"
              ></item-checkout>
            </div>
          </div>

        </div>
        <summary-checkout
          shipping_cost="{{ $shippingCost['data']->total_fee_idr }}"
          locale="{{ json_encode(trans('app')) }}"
        ></summary-checkout>
    </div>
</div>
</div>
@endsection

@section('footer_scripts')
{{-- <script src="{{ elixir('js/creditcard.js') }}"></script> --}}
<script type="text/javascript">
   $(function () {

      // $('#card-number-hidden').validateCreditCard(function(result) {
      //   var card = result.card_type == null ? '' : result.card_type.name;
      //   $('#card').html(card.toUpperCase());

      //   if (card == 'visa') {
      //     $('#card_img').attr('src', '/images/visa.png');
      //   } else if (card == 'mastercard') {
      //     $('#card_img').attr('src', '/images/mastercard.png');
      //   } else if (card == 'discover') {
      //     $('#card_img').attr('src', '/images/discover.png');
      //   } else {
      //     $('#card_img').attr('src', '/images/default_card.png');
      //   }

      // });

      // var card = $('#card-number-hidden').val();

      // var cardNumber = card.substring(13);

      // $('#card-number').html('*************'+cardNumber);

     $("#continue").on('click', function (e) {
        e.preventDefault();
        $('#submit').click();
     });
   })
</script>
@endsection
