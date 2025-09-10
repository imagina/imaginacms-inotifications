<tr>
  <td align="center" style="padding: 0;">
    <!-- Contenedor interno con border-radius -->
    <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse: collapse; border-radius: 15px 15px 0 0; overflow: hidden; background-color: #ffffff; box-shadow: -1px 8px 10px rgba(0,0,0,0.09);">
      <tr>
        <td style="padding: 10px 20px 10px 20px; font-family: Arial, sans-serif;">
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                 style="border-collapse: collapse;">
            <tr>
              <!-- Logo -->
              <td align="left" valign="middle" width="50%" style="padding: 10px 0;">
                <a href="{{ env('FRONT_APP_URL', url('')) }}" target="_blank" style="display: inline-block;">
                  @php
                    $logo = Setting::get('isite::logo1');

                    if(Setting::get('notification::logoEmail') &&
                    strpos(Setting::get('notification::logoEmail'), 'default.jpg') == false){
                      $settingLogo = json_decode(Setting::get('notification::logoEmail'));

                      if(!isset($settingLogo->medias_single)){
                        $logo = Setting::get('notification::logoEmail');
                      }
                    }
                  @endphp
                  <img src="{{ $logo }}" alt="@setting('core::site-name-mini')" width="120" height="65"
                       style="display:block; width:120px; height:65px; object-fit:contain; object-position:left; border:0; outline:none; text-decoration:none;">
                </a>
              </td>

              <!-- Date -->
              <td align="right" valign="middle" width="50%" style="padding: 10px 0;">
                <p
                  style="margin: 0; font-weight: 600; color: #212529; font-size: 14px; line-height: 1; text-transform: capitalize;">
                  {{ strftime("%d de %B, %G") }}
                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
