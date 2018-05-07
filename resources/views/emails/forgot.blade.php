<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <title>{{ trans('app.forgot_subject',[], $locale) }}</title>
  <!--[if !mso]><!-- -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
<style type="text/css">

    @import url(https://fonts.googleapis.com/css?family=Lato);

</style>
<style type="text/css">
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
                        <p style="font-size:1px;margin:0px auto;border-top:1px dashed lightgrey;width:100%;"></p>
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
                                  <div style="cursor:auto;color:#333;font-size:18px;line-height:22px;text-align:center;">
                                    {{ trans('app.hi',[], $locale) }} {{ $user->first_name }} {{ $user->last_name }}
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                                  <div style="cursor:auto;color:#333;font-size:22px;line-height:22px;text-align:center;">
                                    {{ trans('app.forgot_title',[], $locale) }}
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                                  <div style="cursor:auto;color:#333;font-size:14px;line-height:22px;text-align:center;">
                                    {{  trans('app.forgot_text_1',[], $locale)}}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                                <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0">
                                  <tbody>
                                    <tr>
                                      <td align="center" valign="middle">
                                        @component('mail::button', ['url' => route('page.reset', ['code' => $user->verification_token ])])
                                            {{ trans('app.forgot_reset',[], $locale) }}
                                        @endcomponent
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                                <div style="cursor:auto;color:#333;font-size:14px;line-height:22px;text-align:center;">
                                  {{ trans('app.forgot_text_2',[], $locale) }}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="word-wrap:break-word;padding:10px 25px;padding-top:10px;padding-bottom:0px;padding-right:0px;padding-left:0px;">
                                <p style="font-size:1px;margin:0px auto;border-top:1px solid #f8f8f8;width:100%;"></p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </td>
                  </tr>
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
                  <td style="word-wrap:break-word;padding:11px 25px;" align="center">
                    <div style="cursor:auto;color:#999;font-size:10px;line-height:22px;text-align:center;">
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
