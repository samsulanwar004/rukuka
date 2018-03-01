<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
{{-- <html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ trans('app.activation_subject',[], $locale) }}</title>
    <style type="text/css">
        @import url(http://fonts.googleapis.com/css?family=Raleway:400);

        /* Take care of image borders and formatting */

        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a {
            text-decoration: none;
            border: 0;
            outline: none;
        }

        a img {
            border: none;
        }

        /* General styling */

        td, h1, h2, h3  {
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
        }

        body {
            -webkit-font-smoothing:antialiased;
            -webkit-text-size-adjust:none;
            width: 100%;
            height: 100%;
            color: #37302d;
            background: #ffffff;
        }

        table {

        }

        h1, h2, h3 {
            padding: 0;
            margin: 0;
            color: #ffffff;
            font-weight: 400;
        }

        h3 {
            color: #ffffff;
            font-size: 24px;
        }

        .font-white {
            color: #FFFFFF;
        }
    </style>

    <style type="text/css" media="screen">
        @media screen {
            /* Thanks Outlook 2013! http://goo.gl/XLxpyl*/
            td, h1, h2, h3 {
                font-family: 'Raleway', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
            }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 480px)">
        /* Mobile styles */
        @media only screen and (max-width: 480px) {

            table[class="w320"] {
                width: 320px !important;
            }

            table[class="w300"] {
                width: 300px !important;
            }

            table[class="w290"] {
                width: 290px !important;
            }

            td[class="w320"] {
                width: 320px !important;
            }

            td[class="mobile-center"] {
                text-align: center !important;
            }

            td[class="mobile-padding"] {
                padding-left: 20px !important;
                padding-right: 20px !important;
                padding-bottom: 20px !important;
            }
        }
    </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
    <tr>
        <td align="center" valign="top" bgcolor="#ffffff"  width="100%">

            <table cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td height="350" background="https://s3-ap-southeast-1.amazonaws.com/rukuka-assets/uploads/2017-11/9b41f941c74fe229774c3382cd753e57.jpeg" bgcolor="#64594b" valign="top" style="background: url(https://s3-ap-southeast-1.amazonaws.com/rukuka-assets/uploads/2017-11/9b41f941c74fe229774c3382cd753e57.jpeg) no-repeat center; background-color: #F8F8F8; background-position: center;">
                        <!--[if gte mso 9]>
                        <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:303px;">
                            <v:fill type="tile" src="https://s3-ap-southeast-1.amazonaws.com/rukuka-assets/uploads/2017-11/9b41f941c74fe229774c3382cd753e57.jpeg" color="#64594b" />
                            <v:textbox inset="0,0,0,0">
                        <![endif]-->
                        <div>
                            <center>
                                <table cellspacing="0" cellpadding="0" width="530" height="303" class="w320">
                                    <tr>
                                        <td valign="middle" style="vertical-align:middle; padding-right: 15px; padding-left: 15px; text-align:left;" class="mobile-center" height="303">
                                            <h1 class="font-white">{{ trans('app.activation_title',[], $locale) }}</h1><br>
                                            <h2 class="font-white">{{ trans('app.activation_subtitle_1',[], $locale) }}<br> {{ trans('app.activation_subtitle_2',[], $locale) }}</h2>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </div>
                        <!--[if gte mso 9]>
                        </v:textbox>
                        </v:rect>
                        <![endif]-->
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <center>
                            <table cellspacing="0" cellpadding="0" width="500" class="w320">
                                <tr>
                                    <td>
                                        <table cellspacing="0" cellpadding="0" width="100%">
                                            <tr>
                                                <td class="mobile-padding" style="text-align:left;">
                                                    <br>
                                                    {{ trans('app.hi',[], $locale) }} {{ $user->first_name }}
                                                    <br>
                                                    {{ trans('app.activation_text',[], $locale) }}
                                                    <br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mobile-padding">
                                        <table cellspacing="0" cellpadding="0" width="100%">
                                            <tr>
                                                <td>
                                                    <div>
                                                        @component('mail::button', ['url' => route('activation', ['code' => $user->verification_token ])])
                                                            {{ trans('app.activation_activate_now',[], $locale) }}
                                                        @endcomponent
                                                    </div>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellspacing="0" cellpadding="0" class="force-full-width">
                                            <tr>
                                                <td class="mobile-padding" style="text-align:left;">
                                                    <b>{{ trans('app.account',[], $locale) }}</b><br>
                                                    <table border="0">
                                                        <tr><td>{{ trans('app.email',[], $locale) }}</td><td>:</td><td>{{ $user->email }}</td></tr>
                                                        <tr><td>{{ trans('app.first_name',[], $locale) }}</td><td>:</td><td>{{ $user->first_name }}</td></tr>
                                                        <tr><td>{{ trans('app.last_name',[], $locale) }}</td><td>:</td><td>{{ $user->last_name }}</td></tr>
                                                    </table>
                                                    <br><br>
                                                    {{ trans('app.sincerely',[], $locale) }},<br>
                                                    {{ trans('app.rukuka_team',[], $locale) }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellspacing="0" cellpadding="25" width="100%">
                                            <tr>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td style="background-color:#F8F8F8;">
                        <center>
                            <table cellspacing="50" cellpadding="0" width="500" class="w320">
                                <tr>
                                    <td>
                                        <center>
                                            <table style="margin:0 auto;" cellspacing="0" cellpadding="5" width="100%">
                                                <tr>
                                                    <td style="text-align:center; margin:0 auto;" width="100%">
                                                        <a href="/" class="uk-link-reset"><img src="{{ imageCDN(config('common.logo')) }}" alt="rukuka" width="90"></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:center; margin:0 auto;" width="100%">
                                                        {{ trans('app.copyright',[], $locale) }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html> --}}

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <title>{{ trans('app.activation_subject') }}</title>
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
  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: font-family: 'Lato', sans-serif;}
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
<style type="text/css">
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
    </td>
  </tr>
</tbody>
</table>
</div
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
                  {{ trans('app.hi') }} {{ $user->first_name }} {{ $user->first_name }}
                </div>
              </td>
            </tr>
            <tr>
              <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                <div style="cursor:auto;color:#333;font-size:22px;line-height:22px;text-align:center;">
                  {{ trans('app.activation_title') }}
                </div>
              </td>
            </tr>
            <tr>
              <td style="word-wrap:break-word;padding:10px 25px;" align="center">
                <div style="cursor:auto;color:#333;font-size:14px;line-height:22px;text-align:center;">
                  {{ trans('app.activation_text') }}
                </div>
              </td>
            </tr>
            <tr>
              <td style="word-wrap:break-word;" align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0">
                  <tbody>
                    <tr>
                      <td>
                        @component('mail::button', ['url' => route('activation', ['code' => $user->verification_token ])])
                            {{ trans('app.activation_activate_now') }} {{ $user->email }}
                        @endcomponent
                      </td>
                    </tr>
                  </tbody>
                </table>
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
              <div style="cursor:auto;color:#999;font-size:10px;line-height:22px;text-align:center;">
                 {{ trans('app.footmail_question') }} {{ trans('app.footmail_email_sup') }} <br>
             {{-- Don't want to receive email from us? <a href="http://rukuka.com/" name="unsubscribe" style="color:#999; text-decoration:underline;">unsubscribe</a> <br> --}}
              {{ trans('app.footmail_city') }} <br>
             {{ trans('app.footmail_copyright') }} </div>
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
</body>
</html>
