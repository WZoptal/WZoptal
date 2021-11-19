<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EverLasting</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <link rel="stylesheet" type="text/css" href="">
  <link rel="shortcut icon" type="image/png"  href="images/favicon.png" />
  <meta http-equiv="refresh" content="3;URL='<?=base_url()?>subscription'" />    

<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Montserrat|Poppins" rel="stylesheet">


<style>
  @import url('https://fonts.googleapis.com/css?family=Dancing+Script|Montserrat|Poppins');
  body{
    margin: 0rem;padding:0rem;
    background:url(../assets/images/thankou_bg_img.png) no-repeat;
    width:100%;
    height:100%;
    background-size: cover;
    background-position: center;
  }
  .font-family1{font-family: 'Dancing Script', cursive;}
  .font-family2{font-family: 'Montserrat', sans-serif;}
  .font-family3{font-family: 'Poppins', sans-serif;}
  .thankyou_icon{
    width:249px;
    height: 203px;
  }
  .h1{
    font-size: 84px;
    color:#C3A563;
    font-weight: 700;
    margin-bottom: 0.625rem;
  }
  .h2{
    font-size: 48px;
    color:#C3A563;
    font-weight: 400;
    margin-top:30px;
  }
  .p{
    font-size: 16px;
    color:rgba(255,255,255,.60);
    font-weight: 400;

  }
  .text-center{text-align: center;}
  .btn{
    color:#FFFFFF;
    background:#C3A563;
    border-radius:4px;
    height:48px;
    width:230px;
    display: inline-block;
    text-decoration: none;
    font-size: 14px;
    line-height: 48px;
    margin-top:25px;
  }
  .line-bottom{
    width:100%;
  }

  @media only screen and (max-width: 600px){
    body{
      height:100%;
      background-size: cover;
    }
    .text-center{
      padding:40px 20px !important;
    }
    .h1.font-family1{
      font-size: 60px;
    }
  }
  
</style>
</head>
<body>
  <div class="text-center" style="padding:80px;">
    <img src="<?php echo base_url('img/BHPS Logo_Final-Couloured.png');?>" class="thankyou_icon">
    <h1 class="h1 font-family1" style="">Thankyou!</h1>
    <img src="<?php echo base_url('img/line-icon.svg'); ?>" class="line-bottom">
    <h2 class="h2 font-family1" style="">
  <?php if($this->session->flashdata('message')){
    echo $this->session->flashdata('message'); }
    else{
      echo "Membership Done Successfully";
    } ?>
    </h2>
    <p class="p font-family3"> <!-- Click <br>  on the below button to continue. --></p>
    <!-- <a href="" style="" class="font-family2 btn">CLICK TO CONTINUE</a> -->
  </div>
</body>
</html>