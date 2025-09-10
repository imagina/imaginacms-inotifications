<tr>
  <td
    style="padding:30px; text-align:center; font-size:12px;color:#8292A1; font-family: Arial, sans-serif;background:#dfdfdf">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
      <tbody about="information">

      <tr>
        <td align="center" style="padding: 0 0 24px 0;">
          <table role="presentation" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td style="padding: 0 0 0 20px"></td>
              <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center">
                  <tr>
                    @php
                      $social = json_decode(setting("isite::socialNetworks"));
                      $socialUse = ['facebook', 'twitter', 'tiktok', 'youtube', 'instagram'];
                    @endphp
                    <td align="center" style="padding: 0 20px 0 20px;">
                      <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center">
                        <tr>
                          @foreach($socialUse as $platform)
                            @if(!empty($social->{$platform}))
                              <td align="center" style="padding: 0 6px;" width="26">
                                <a href="{{ $social->{$platform} }}" target="_blank"
                                   title="{{ ucfirst($platform) }}"
                                   style="display:block; width:24px;"
                                >
                                  <img src="{{ url('modules/notification/img/' . $platform . '.png') }}"
                                       alt="{{ ucfirst($platform) }}"
                                       width="24" height="24"
                                       style="display:block; width:24px; height:24px;">
                                </a>
                              </td>
                            @endif
                          @endforeach
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
              <td style="padding: 0 20px 0 0"></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding-bottom: 16px;">
          @php
            $phone = json_decode(setting("isite::phones"));
            $email = json_decode(setting("isite::emails"));
          @endphp

          @if(!empty($phone))
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone[0]) }}"
               style="font-size:14px; line-height:20px; font-weight:600; color:#212529; text-decoration:none; display:inline-block;">
              {{ $phone[0] }}
            </a>
          @endif

          @if(!empty($email))
            <span
              style="display:inline-block; width:1px; height:14px; background:#232323; margin: 0 10px;"></span>
            <a href="mailto:{{ $email[0] }}"
               style="font-size:14px; line-height:20px; font-weight:600; color:#212529; text-decoration:none; display:inline-block;">
              {{ $email[0] }}
            </a>
          @endif
        </td>
      </tr>
      <tr>
        <td align="center" style="padding-bottom: 16px;">
          <a href="{{ env('FRONT_APP_URL', url('')) }}" target="_blank" style="text-decoration:none;">
            <p style="font-size:13px; line-height:1.4; font-weight:300; color:#555555; margin:0;">
                            <span style="color:{{ setting('isite::brandPrimary') }}; font-weight:500;">
                              ©{{ date("Y") }} @setting('core::site-name')
                            </span>
              {{ trans('isite::copyright.text') }}
            </p>
          </a>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding: 16px 0;">
          <hr style="border:0; border-top:2px solid #ccc; margin:0; width:100%;">
        </td>
      </tr>
      <tr>
        <td align="center">
          <a href="{{ env('FRONT_APP_URL', url('')) }}"
             style="font-size:16px; font-weight:600; color:#131421; text-decoration:none;">
            {{ env('FRONT_APP_URL', url('')) }}
          </a>
        </td>
      </tr>

      </tbody>
    </table>
  </td>
</tr>
