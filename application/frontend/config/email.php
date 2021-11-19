<?php
/*$config['signupEmail'] = "Dear #ownme#,\nTo login into the social Tyer please verify your login on clicking the link below:\n\n #url#.\n\nThanks UGK Support Team.";
$config['paypalEmail'] ="Dear #nme#,\nCongratulation you have successully purchased the Plan #plnme# of amount #amt#.\n\nThanks UGK Support Team.";

$config['forget_password_email'] ="Dear #ownme#,\nAs you have requested for password reset request. \n\n<br/><br/> Please click on following link  to complete the password reset process.\n\n #link#\n\nThanks Social Tyer Support Team.";

$config['order_details_email']="Dear #username#, \n\n #orderdetails#";

*/
$config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.gmail.com',
      'smtp_port' => 465,
   	  'smtp_crypto' => 'ssl',
      'smtp_user' => 'slinfydotcom@gmail.com',
      'smtp_pass' => 'khattra007',
      'mailtype'  => 'html', 
      'charset'   => 'iso-8859-1'
    );
	
	
/*$config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'mail.stjohnkenya.org',
      'smtp_port' => 110,
   	  'smtp_crypto' => 'ssl',
      'smtp_user' => 'volunteer@stjohnkenya.org',
      'smtp_pass' => 'volunteers12',
      'mailtype'  => 'html', 
      'charset'   => 'iso-8859-1'
);
?>*/
