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
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<?php include("head.php");?>
</head>
<?php
	foreach($this->_ci_view_paths as $key=>$val){
		$view_path=$key;	
	}
?>
<body class="page-header-fixed"  <?php $pagename=$this->uri->segment(1); if($pagename=="dashboard"){ }?>>
	<?php	$controllername=$this->router->class; ?>
<!-- BEGIN HEADER -->

    <?php 
		include('top_area.php');   // Are above menu bar is included in this file 
	?>
<!-- END HEADER -->
    <div class="clearfix"> </div>
<!-- BEGIN CONTAINER -->
    <div class="page-container"> 
  <!-- BEGIN SIDEBAR -->
	<?php include('menu_bar_admin.php');   // Menu bar is included in this file ?>
  <!-- END SIDEBAR --> 
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <div class="page-content"> 
      <?php if(isset($master_body) && $master_body!=""){ ?>
    	  <?php include($view_path.$controllername."/".$master_body.".php"); ?>
      <?php } ?>
    </div>
    <div class="clearfix"> </div>
    <div class="clearfix"> </div>
  </div>
</div>
<div class="footer">
  <div class="footer-inner"> © Copyright <?php echo date('Y', time()); echo ' &nbsp; '. $this->config->item('sitename'); ?>. All Rights Reserved </div>
  <div class="footer-tools"> <span class="go-top"> <i class="fa fa-angle-up"></i> </span> </div>
</div>

</body>
</html>
<?php
	if($this->config->item("process")=="yes"){
	 $this->output->enable_profiler(TRUE);
	}
?>