<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo base_url();?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
 <!-- incluse all the scripts and css here in this file -->
 <div class="row">
  <div class="col-md-12"> 
     <!-- BEGIN PAGE TITLE & BREADCRUMB-->
     <h3 class="page-title"> Dashboard <small>statistics and more</small> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="<?php echo base_url(); ?>"> Dashboard </a> </li>
       <!--<li class="pull-right">
         <div id="dashboard-report-range" class="dashboard-date-range tooltips" data-placement="top" data-original-title="Change dashboard date range"> <i class="fa fa-calendar"></i> <span> </span> <i class="fa fa-angle-down"></i> </div>
       </li>-->
     </ul>
     <!-- END PAGE TITLE & BREADCRUMB--> 
   </div>
</div>
 <!-- END PAGE HEADER--> 
 <!-- BEGIN DASHBOARD STATS -->
 <div class="row">
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat yellow	">
      <div class="visual"><i class="fa fa-user" aria-hidden="true"></i> </div>
      <div class="details">
        <div class="number">
          <?php echo $this->common->totalUsersRegisted(2); ?>
        </div>
        <div class="desc"> Total Business's </div>
      </div>   
      <a class="more" href="<?php echo base_url(); ?>users/manage_business"> View more <i class="m-icon-swapright m-icon-white"></i> </a> </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat blue">
      <div class="visual"> <i class="fa fa-user-secret" aria-hidden="true"></i> </div>
      <div class="details">
        <div class="number">
          <?php echo $this->common->totalUsersRegisted(1); ?>
        </div>
        <div class="desc"> Total User's </div>
      </div>
      <a class="more" href="<?php echo base_url(); ?>users/manage_user"> View more <i class="m-icon-swapright m-icon-white"></i> </a> </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat green">
      <div class="visual"> <i class="fa fa-object-group" aria-hidden="true"></i> </div>
      <div class="details">
        <div class="number">
          <?php  //echo $this->common->totalGroups(); ?>
        </div>
        <div class="desc"> Total Posts </div>
      </div>
      <a class="more" href="<?php echo base_url(); ?>posts/manage_posts"> View more <i class="m-icon-swapright m-icon-white"></i> </a> </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat purple">
      <div class="visual"> <i class="fa fa-ra" aria-hidden="true"></i> </div>
      <div class="details">
        <div class="number">
           <?php //echo $this->common->totalPosts(); ?>
        </div>
        <div class="desc"> Total Menu </div>
      </div>
      <a class="more" href="<?php echo base_url(); ?>menu/manage_menu"> View more <i class="m-icon-swapright m-icon-white"></i> </a> </div>
  </div>
</div>
<!-- END DASHBOARD STATS -->
<div class="clearfix"> </div>
<div class="clearfix"> </div>
<!-- BEGIN CORE PLUGINS --> 
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/excanvas.min.js"></script> 
<![endif]--> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip --> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<!--<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script> --> 
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script> 

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support --> 
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script> 

<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<?php echo base_url(); ?>assets/scripts/core/app.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/index.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/tasks.js" type="text/javascript"></script> 

<!-- END PAGE LEVEL SCRIPTS --> 
<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   initMap();
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initDashboardDaterange();
   Index.initIntro();
   Tasks.initDashboardWidget();
});
</script> 
<!-- END JAVASCRIPTS --> 