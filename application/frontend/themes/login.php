<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8"/>
        <title><?=$master_title; ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <?php require_once("dashboard/head.php");?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard/plugins/select2/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard/plugins/select2/select2-metronic.css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
    </head>

<!-- BEGIN BODY -->
<body class="login">
    
    <div class="logo"> 
        <a href="<?=base_url();?>login"><img width="200" src="<?=base_url();?>assets/dashboard/logo.png" alt="pic"/> </a> 
    </div>
    
    <div class="content"> 
        <!-- BEGIN LOGIN FORM -->
        <form name="login" action="<?=base_url();?>login/check_login" method="post"  class="login-form" >
            <h3 class="form-title">Login to your account</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>Enter email and password.</span>
            </div>
            <div class="row">
                <?=$this->common->includeBootstrapAlertMessageHtml();?>
            </div>
            <div class="form-group"> 
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon"> <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" value="<?=$userdata['email'];?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon"> <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
                </div>
            </div>
            <div class="form-actions">
                <label class="checkbox"><input type="checkbox" name="remember" value="1"/> Remember me </label>
                <button type="submit" class="btn blue pull-right"> Login <i class="m-icon-swapright m-icon-white"></i> </button>
            </div>
            <div class="forget-password">
                <h4>Forgot your password ?</h4>
                <p> no worries, click<a href="<?php echo base_url();?>login/forgot_password"> here </a> to reset your password. </p>
            </div>
         </form>
      </div>
    <!-- END LOGIN --> 
     <!-- BEGIN COPYRIGHT -->
    <div class="copyright"> © Copyright <?php echo date('Y', time()); echo ' &nbsp; '. $this->config->item('sitename'); ?>.  All Rights Reserved. </div>
    <div class="copyright"> <a href="javascrit:void(0)" style="color:#fff; font-weight:400" target="_blank">Powered by <em>Zoptal Solutions Pvt Ltd </em> </a></div>
    <!-- END COPYRIGHT -->

    <script src="<?=base_url(); ?>assets/dashboard/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?=base_url(); ?>assets/dashboard/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/dashboard/plugins/select2/select2.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=base_url(); ?>assets/dashboard/scripts/core/app.js" type="text/javascript"></script>
    <script src="<?=base_url(); ?>assets/dashboard/scripts/custom/login-soft.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});
	</script>
    <!-- END JAVASCRIPTS -->
</body>
</html>