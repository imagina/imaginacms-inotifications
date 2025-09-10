<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body
  style="margin:0; padding:0; word-spacing:normal; background-color:#E8ECED; font-family: Arial, sans-serif;">

<style>
  table{
    border-collapse: collapse;
    border-spacing: 0;
    border: none;
    margin: 0;
    width: 100%;
  }

  div, td{
    padding: 0;
    margin: 0;
  }

  h1, p, table, td, div{
    font-family: 'Open Sans', sans-serif;
  }

  @media screen and (max-width: 530px){
    .email-title, #contend-mail h1{
      font-size: 18px;
      line-height: 20px;
    }

    .email-message{
      font-size: 16px;
      line-height: 18px;
    }

    .col-md-6{
      display: block !important;
      width: 100% !important;
    }

    .w-60{
      width: 90% !important;
    }
  }
</style>

<div role="article" aria-roledescription="email"
     style="display: flex; justify-content: center; text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
  <table role="presentation" cellpadding="0" cellspacing="0" border="0"
         style="background-color: rgba(0,0,0,0.74); max-width: 600px; width: 90%; margin: 0 auto;border-radius: 10px 10px 0 0;">
    <tr>
      <td align="center" style="padding: 20px 0 0; background:#fff;border-radius:10px 10px 0 0;">
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
          @include('notification::emails.base.header')
          <tr>
            <td
              style="background:#f5f5f5;text-align:center;padding:20px 15px 30px;font-family: Arial, sans-serif;font-size:16px;color:#212529;line-height:1.5;">
              @yield('content')
            </td>
          </tr>
          @include('notification::emails.base.footer')
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
