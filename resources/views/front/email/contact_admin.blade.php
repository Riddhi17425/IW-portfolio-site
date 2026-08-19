<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Armstrong</title>
</head>
<body style="margin:0; padding:0;">
  <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" align="center" style="max-width:600px; margin:0 auto;">
    <!-- Header -->
    <tr>
      <td style="padding:30px 20px 15px 20px;">
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr>
            <!-- Logo -->
            <td align="left" style="vertical-align:middle;">
              <img src="{{asset ('public/front/img/logo.png')}}" alt="Logo" style="display:block; max-width:150px;">
            </td>
            <!-- Contact -->
           <td align="right" style="font-family:Arial, sans-serif; font-size:12px; color:#666666; padding-left: 30px;">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="padding-right:10px; border-right:1px solid #888888;white-space: nowrap;">
                    <a href="tel:+91 76000 13134" style="color:#666666; text-decoration:none;white-space: nowrap;">
                      <strong style="color:#182653;">M :</strong> ++91 76000 13134
                    </a><br>
                    <a href="tel:+1 614-999-2286" style="color:#666666; text-decoration:none;white-space: nowrap;">
                      <strong style="color:#182653;">M :</strong> +1 614-999-2286
                    </a>
                  </td>
                  <td style="padding-left:10px;white-space: nowrap;">
                    <a href="tel:+971 56 650 6550" style="color:#666666; text-decoration:none;white-space: nowrap;">
                      <strong style="color:#182653;">M :</strong> +971 56 650 6550
                    </a><br>
                    <a href="mailto:hello@intelliworkz.tech" style="color:#666666; text-decoration:none;white-space: nowrap;">
                      <strong style="color:#182653;">E :</strong> hello@intelliworkz.tech
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Divider -->
    <tr>
      <td style="background:#94BDDA; height:4px; font-size:0; line-height:0;">&nbsp;</td>
    </tr>

    <!-- Banner -->
    <tr>
      <td style="padding:24px 20px;">
        <img src="{{asset ('public/front/img/eaperience.png')}}" alt="Banner" style="width:100%; max-width:100%; display:block;">
      </td>
    </tr>

    <!-- Details Table -->
    <tr>
      <td style="padding:34px 20px 37px 20px;">
        <h2 style="color:#111111; font-weight:600; font-size:18px; font-family:Arial, sans-serif; margin:0 0 10px;">Hello Team,</h2>
        <p style="font-size:14px; line-height:20px; color:#333333; font-family:Arial, sans-serif; margin:0 0 10px; margin-bottom:0px;">
          A new lead has contacted through the website form.
        </p>
        <p style="font-size:14px; line-height:20px; color:#333333; font-family:Arial, sans-serif; margin:0 0 10px;">
         Lead Details:
        </p>
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border:1px solid #DDD; border-radius:5px; font-size:14px; color:#333; font-family:Arial, sans-serif;">
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; width:30%; font-weight:bold;">Name: </td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{ $data['name'] }}</td>
          </tr>
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Company:</td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{  $data['company_name'] }}</td>
          </tr>
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Email: </td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{ $data['email'] }}</td>
          </tr>
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Contact: </td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{ $data['number'] }}</td>
          </tr>
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Looking For:</td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{  $data['interested_in'] }}</td>
          </tr>
          @if(!empty($data['other_service_details'])) 
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Looking For: </td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{ $data['other_service_details'] }}</td>
          </tr>
          @endif
           @if(!empty($data['project_description'])) 
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">About Your Project: </td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{ $data['project_description'] }}</td>
          </tr>
          @endif
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Current business:</td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{  $data['venture_or_growth'] }}</td>
          </tr>
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Expected Timeline:</td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{  $data['timeline'] }}</td>
          </tr>
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Budget:</td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{  $data['budget'] }}</td>
          </tr>
          @if(!empty($data['extra_details'])) 
          <tr>
            <td style="border:1px solid #DDD; padding:8px 20px; font-weight:bold;">Extra Details: </td>
            <td style="border:1px solid #DDD; padding:8px 20px;">{{ $data['extra_details'] }}</td>
          </tr>
          @endif
        </table>
        <p>Thanks,</p>
      </td>
     
    </tr>

    <!-- Contact Row -->
    <tr>
  <td colspan="2" style="padding:20px;">
    <hr style="border:none; border-top:1px solid #DDDDDD; margin:0 0 15px;">
    <!--<p style="font-size:14px; line-height:22px; color:#666666; margin:0 0 15px; text-align:center; font-family:Arial, sans-serif;">-->
    <!--  Please follow up within 48 hours -->
    <!--</p>-->

    <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="white-space:nowrap;">
      <tr>
        <!-- Email -->
        <td style="font-size:14px; font-family:Arial, sans-serif; color:#666666; padding-right:10px; border-right:1px solid #888888; white-space:nowrap;">
          <a href="mailto:hello@intelliworkz.tech" style="color:#666666; text-decoration:none; white-space:nowrap; display:inline-block;">
            <img src="{{asset('public/front/img/email.png')}}" alt="Email" style="vertical-align:middle; margin-right:5px;"> hello@intelliworkz.tech
          </a>
        </td>

        <!-- Phone -->
        <td style="font-size:14px; font-family:Arial, sans-serif; color:#666666; padding-left:10px; white-space:nowrap;">
          <a href="tel:+91 76000 13134" style="color:#666666; text-decoration:none; white-space:nowrap; display:inline-block;">
            <img src="{{asset('public/front/img/phone.png')}}" alt="Phone" style="vertical-align:middle; margin-right:5px;"> +91 76000 13134
          </a>
        </td>
      </tr>
    </table>
  </td>
</tr>


    <!-- Footer -->
    <tr>
      <td style="background:#182653; text-align:center; padding:12px;">
        <p style="font-size:12px; color:#FFFFFF; font-family:Arial, sans-serif; margin:0;">
          All Rights Reserved | Iwportfolio © {{ date('Y') }}
        </p>
      </td>
    </tr>
  </table>
</body>
</html>
