<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <title>{{ trans('app.unpaid_subject',[], $locale) }} , {{$order->order_code}}</title>
  <!--[if !mso]><!-- -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
<style type="text/css">

    @import url(https://fonts.googleapis.com/css?family=Lato);

  #outlook a { padding: 0; }
  .ReadMsgBody { width: 100%; }
  .ExternalClass { width: 100%; }
  .ExternalClass * { line-height:100%; }
  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: 'Lato', sans-serif;}
  table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
  p { display: block; margin: 13px 0; }
</style>
<!--[if !mso]><!-->
<style type="text/css">
  @media only screen and (max-width:480px) {
    @-ms-viewport { width:320px; }
    @viewport { width:320px; }
  }
</style>

  <!--<![endif]--><style type="text/css">
  @media only screen and (min-width:480px) {
    .mj-column-per-100 { width:100%!important; }
.mj-column-per-50 { width:50%!important; }
  }
</style>
</head>
<body style="background: #E1E8ED;">

  <div class="mj-container" style="background-color:#E1E8ED;">
    <div style="margin:0px auto;max-width:600px;background:#f8f8f8;">
      <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;background:#f8f8f8;" align="center" border="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;padding:20px 0px;padding-bottom:0px;">
              <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                        <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;" align="center" border="0">
                          <tbody>
                            <tr>
                              <td style="width:80px;">
                                <img alt="" height="auto" src="https://s3-ap-southeast-1.amazonaws.com/rukuka-assets/images/rukuka-logo.png" style="border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;" width="80">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;padding:10px 25px;">
                        <p style="font-size:1px;margin:0px auto;border-top:1px dashed lightgrey;width:100%;"></p><
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="margin:0px auto;max-width:600px;background:#f8f8f8;">
      <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;background:#f8f8f8;" align="center" border="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;padding:20px 0px;padding-bottom:0px;">
              <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                        <div style="cursor:auto;color:#333;font-size:22px;line-height:22px;text-align:center;font-weight:800">
                          {{ trans('app.unpaid_title',[], $locale) }}
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                        <div style="cursor:auto;color:#333;font-size:20px;line-height:22px;text-align:center;">
                          {{ trans('app.unpaid_subtitle_1',[], $locale) }} {{ trans('app.unpaid_subtitle_2',[], $locale) }}
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="margin:0px auto;max-width:600px;background:#f8f8f8;">
      <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;background:#f8f8f8;" align="center" border="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;padding:20px 0px;padding-bottom:0px;">

                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;padding:10px 25px;" align="left">
                        <div style="cursor:auto;color:#333;font-size:13px;line-height:22px;text-align:left;">
                          {{$order->address->first_name}} {{$order->address->last_name}} <br>
                          {{$order->address->address_line}} <br>
                          {{$order->address->city}},{{$order->address->province}} <br>
                          {{$order->address->country}} {{$order->address->postal}} <br>
                          {{$order->address->phone_number}} <br>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;padding:10px 25px;" align="left">
                        <div style="cursor:auto;color:#333;font-size:14px;line-height:22px;text-align:left;">
                            {{ trans('app.invoice',[], $locale) }} :  <br> {{$order->order_code}}
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="margin:0px auto;max-width:600px;background:#f8f8f8;">
      <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;background:#f8f8f8;" align="center" border="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;padding:20px 0px;padding-bottom:0px;">
              <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;padding:10px 25px;" align="left">
                        <table cellpadding="0" cellspacing="0" style="cellspacing:0px;color:#333;font-size:13px;line-height:30px;table-layout:auto;" width="100%" border="0">
                          <tr style="border-bottom:2px solid lightgrey;text-align:left;padding:15px 0;">
                            <th style="padding: 0 15px 0 0;">{{ trans('app.item',[], $locale) }} ({{ trans('app.size',[], $locale) }})</th>
                            <th>{{ trans('app.qty',[], $locale) }}</th>
                            <th style="padding: 0 0 0 15px;">{{ trans('app.unit_price',[], $locale) }}</th>
                            <th style="padding: 0 0 0 15px;">{{ trans('app.subtotal',[], $locale) }}</th>
                          </tr>
                          @foreach($order->details as $item)
                          <tr style="border-bottom:1px dashed lightgrey;text-align:left;padding:15px 0;">
                            <td style="padding: 0 15px 0 0;">{{$item['product_name']}} <b>({{$item['size']}})</b></td>
                            <td>{{$item['qty']}}</td>
                            <td style="padding: 0 0 0 15px;"> {{$order->symbol}} {{number_format($item['price'],2)}} </td>
                            <td style="padding: 0 0 0 15px;"> {{$order->symbol}} {{number_format($item['price']*$item['qty'],2)}} </td>
                          </tr>
                        @endforeach
                          <tr>
                            <td style="padding: 0 0 0 15px;" colspan="3" align="right"><b>{{ trans('app.subtotal',[], $locale) }}</b></td>
                            <td style="padding: 0 0 0 15px;"> {{ $order->symbol }} {{number_format($order->order_subtotal,2)}} </td>
                          </tr>
                          <tr style="border-bottom:2px solid lightgrey;text-align:left;padding:15px 0;">
                            <td style="padding: 0 0 0 15px;" colspan="3" align="right"><b>{{ trans('app.shipping_label',[], $locale) }}</b></td>
                            <td style="padding: 0 0 0 15px;"> {{ $order->symbol }} {{number_format($order->shipping_cost,2)}} </td>
                          </tr>
                          <tr style="border-bottom:2px solid lightgrey;text-align:left;padding:15px 0;">
                            <td style="padding: 0 0 0 15px;" font-size="20" colspan="3" align="center"><b>{{ trans('app.total',[], $locale) }}</b></td>
                            <td style="padding: 0 0 0 15px;"> <b>{{ $order->symbol }} {{number_format($order->order_subtotal + $order->shipping_cost,2) }} </b></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;padding:10px 25px;" align="left">
                        <div style="cursor:auto;color:#666;font-size:12px;line-height:22px;text-align:left;">
                          <p style="margin:0px">
                          {{trans('app.note',[], $locale)}} :
                          <br>{{ trans('app.note_currency',[], $locale) }} {{ number_format($order->order_total_idr) }}
                        </P>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;padding-bottom:0px;padding-right:0px;padding-left:0px;">
                        <p style="font-size:1px;margin:0px auto;border-top:1px solid #f8f8f8;width:100%;"></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div style="margin:0px auto;max-width:600px;background:#f8f8f8;">
                <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;background:#f8f8f8;" align="center" border="0">
                  <tbody>
                    <tr>
                      <td style="text-align:center;vertical-align:top;direction:ltr;padding:20px 0px;padding-bottom:0px;">
                        <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                          <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                            <tbody>
                              <tr>
                                <td style="word-wrap:break-word;padding:10px 25px;">
                                  <p style="font-size:1px;margin:0px auto;border-top:1px dashed lightgrey;width:100%;"></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="word-wrap:break-word;padding:10px 25px;" align="left">
                                  <div style="cursor:auto;color:#666;font-size:12px;line-height:22px;text-align:left;">
                                    <p>
                                      {{ trans('app.unpaid_text_1',[], $locale) }}
                                      <br>{{ trans('app.unpaid_text_2',[], $locale) }}
                                  </p>
                                    <p>
                                    {{ trans('app.please',[], $locale) }} <a href="{{URL::to('/help/contact-us')}}">{{ trans('app.contact_label',[], $locale) }}</a> {{ trans('app.contact_text',[], $locale) }}
                                  </p>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div style="margin:0px auto;max-width:600px;background:#f8f8f8;">
                <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;background:#f8f8f8;" align="center" border="0">
                  <tbody>
                    <tr>
                      <td style="text-align:center;vertical-align:top;direction:ltr;padding:20px 0px;">
                        <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                          <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                            <tbody>
                              <tr>
                                <td style="word-wrap:break-word;padding:10px 25px;">
                                  <p style="font-size:1px;margin:0px auto;border-top:1px dashed lightgrey;width:100%;"></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                                  <div style="cursor:auto;color:#999;font-size:11px;line-height:22px;text-align:center;">
                                     {{ trans('app.footmail_question',[], $locale) }} {{ config('mail.replyto.address') }} <br>
                                 {{-- Don't want to receive email from us? <a href="http://rukuka.com/" name="unsubscribe" style="color:#999; text-decoration:underline;">unsubscribe</a> <br> --}}
                                  {{ trans('app.footmail_city',[], $locale) }} <br>
                                 {{ trans('app.footmail_copyright',[], $locale) }} </div>
                               </td>
                             </tr>
                           </tbody>
                         </table>
                       </div>
                     </td>
                   </tr>
                 </tbody>
               </table>
              </div>
            </div>
          </div>
</body>
</html>
