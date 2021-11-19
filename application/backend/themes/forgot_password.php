<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $master_title; ?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php include"head.php"  ?>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/select2/select2-metronic.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<style>
.has-error .help-inline, .has-error .help-block, .has-error .control-label {
    color: #f00;
}
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo" style="margin-top: 20px;"> <a href="<?php echo base_url();?>"> <img src="<?php echo base_url();?>../img/BHPS Logo_Final - White.png" alt="pic" width="240"/> </a> </div>
<!-- END LOGO --> 
<!-- BEGIN LOGIN -->
<div class="content"> 
  <!-- BEGIN ALERT MESSAGE --> 
  <div class="row">
     <div class="col-md-12">
        <?php $successmsg = $this->session->flashdata('successmsg'); ?>
        <?php if(!empty($successmsg)) : ?>
           <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
              <strong>Success!</strong> <?= $successmsg; ?>
           </div>
        <?php endif; ?>
        <?php $errormsg = $this->session->flashdata('errormsg'); ?>
        <?php if(!empty($errormsg)) : ?>
           <div class="alert alert-danger">
              <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
              <strong>Error!</strong> <?= $errormsg; ?>
           </div>
        <?php endif; ?>
     </div>
  </div>
  <!-- END ALERT MESSAGE -->
  <!-- BEGIN LOGIN FORM -->
  <form name="login" action="<?php echo base_url();?>login/forgot_password_db" method="post"  class="login-form" >
    <h3 class="form-title">Forgot Password</h3>
    <div class="alert alert-danger display-hide">
      <button class="close" data-close="alert"></button>
      <span>Enter username or email.</span> </div>
    <div class="form-group"> 
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">Username/Email</label>
      <div class="input-icon"> <i class="fa fa-user"></i>
        <input class="form-control placeholder-no-fix" required type="text" autocomplete="off" placeholder="Username/Email" name="username" value="<?php echo $userdata['username'];?>"/>
      </div>
    </div>
     <div class="form-actions">
      <label class="checkbox">
       <!-- <input type="checkbox" value="1" name="type"/>
        Login As Adminstrator--> </label>
      <button type="submit" class="btn blue pull-right"> Submit <i class="m-icon-swapright m-icon-white"></i> </button>
    </div>
    <div class="forget-password">
       <p> For login click <a href="<?php echo base_url();?>login"> here </a>. </p>
    </div>
  </form>
  <!-- END LOGIN FORM --> 
  <!-- BEGIN FORGOT PASSWORD FORM -->
   
  <!-- END FORGOT PASSWORD FORM --> 
  
</div>
<!-- END LOGIN --> 
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> © Copyright <?php echo date('Y', time()); echo ' &nbsp; '. $this->config->item('sitename'); ?>.  All Rights Reserved. </div>
<div class="copyright"> <a href="https://zoptal.com/" style="color:#fff; font-weight:400" target="_blank">Powered by <em>Zoptal Solutions Pvt Ltd </em> </a></div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
	<script src="<?php echo base_url(); ?>assets/plugins/respond.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/excanvas.min.js"></script> 
	<![endif]-->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
 <!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/scripts/core/app.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/scripts/custom/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});
	</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>