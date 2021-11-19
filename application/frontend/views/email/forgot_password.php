<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EverLasting Date</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <link rel="stylesheet" type="text/css" href="">
  <link rel="shortcut icon" type="image/png"  href="images/favicon.png" />

<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Montserrat|Poppins" rel="stylesheet">

<style>
  .font-family1{font-family: 'Dancing Script', cursive;}
  .font-family2{font-family: 'Montserrat', sans-serif;}
  .font-family3{font-family: 'Poppins', sans-serif;}
    @import url('https://fonts.googleapis.com/css?family=Dancing+Script|Montserrat|Poppins');
    
    table tr td,
    table tr td p{
      vertical-align: top;
    }
    
   

</style>

</head>
<body class="" style="background:#e8e8e8;margin:0rem;padding:0rem;font-family: 'Poppins';">
    <table width="600" style="background: #fff;margin:0 auto;" cellspacing="0">
      <tr style="">
        <th style="text-align: center;vertical-align: middle;">
          <img src="<?php echo base_url("assets/images/logo_with_bg_img.png"); ?>" style="width:600px;height:80px;">
        </th>
      </tr>
      <tr>
        <td style="text-align: center;padding:40px;">
          <p style="font-size: 48px;color:#C3A563;font-weight: 400;margin-top:0px;border-bottom:1px solid rgba(00,00,00,.30);display:inline-block;padding-bottom:40px;" class="font-family1">Reset your password</p>

          <p style="color:#999999;font-size:16px;font-weight: 400;" class="font-family3">You're receiving this e-mail because you requested a password reset for your Everlasting Date account.</p>
          <p style="color:#999999;font-size:16px;font-weight: 400;" class="font-family3">Please tap the button below to choose a new password.</p>


          <?php if(isset($link)){ ?>
          <div style="text-align:center;margin-top:40px;margin-bottom:10px;">
            <a href="<?php echo $link; ?>" style="color:#FFFFFF;background:#C3A563;border-radius:4px;height:48px;width:210px;display: inline-block;text-decoration: none;font-size: 14px;line-height: 48px;" class="font-family2">RESET PASSWORD</a>
          </div>
          <?php } ?>
        </td>       
      </tr>
      <tr>
        <td style="text-align: center;padding:34px 130px;background: #F7F7F7;line-height: 18px;">
          <span style="color:#999999;font-size:12px;" class="font-family3">If you have any questions or concerns, we're here to help. Contact us via our <a href="http://www.everlastingdate.com/everlastingdate" style="color: #00B1FF;"> Help Center. </a></span>
        </td>
      </tr>

    </table>
</body>
</html>