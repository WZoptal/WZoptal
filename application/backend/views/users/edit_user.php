<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo base_url(); ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Edit <?php echo $item; ?> </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li class="btn-group"> <!--<a href="<?php echo base_url(); ?>users/add_user" class="btn blue dropdown-toggle"> <span style="color:#FFF"> Add Hotel </span></a>--> </li>
      <li> <i class="fa fa-home"></i> <a href="<?php echo base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="javascript:void(0);"> Edit <?php echo $item; ?> </a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row">
  <form method="post" action="<?php echo base_url('/users/edit_users_to_database');?>" enctype="multipart/form-data">
    
    <div class="col-md-12">
      <div class="mx-auto tm-about-text-container px-3">
          <?php $successmsg = $this->session->flashdata('successmsg'); ?>
          <?php if(!empty($successmsg)) : ?>
              <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                  <strong>Success!</strong> <?= $successmsg; ?>
              </div>
          <?php endif; ?>
          <?php $infomsg = $this->session->flashdata('infomsg'); ?>
          <?php if(!empty($infomsg)) : ?>
              <div class="alert alert-info">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                  <strong>Info!</strong> <?= $infomsg; ?>
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
  <div class="col-md-6">
     <div class="form-group">
      <label>Name</label>
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>" class="form-control"> 
      <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control"> 
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email"  value="<?php echo $user['email']; ?>" class="form-control"> 
    </div>
    <div class="form-group">
      <label>Phone</label>
      <input type="tel" name="phone" value="<?php echo $user['phone']; ?>" class="form-control"> 
    </div>
    <div class="form-group">
      <label>Address</label>
      <textarea name="address" class="form-control"><?php echo $user['address']; ?></textarea> 
    </div>
    <div class="form-group">
      <label>User Type</label>
      <select class="form-control" name="user_type">
        <option selected>Choose Type...</option>
        <option value="1" <?php if($user['user_type'] == 1){ echo "selected"; } ?>>Admin</option>
        <option value="2" <?php if($user['user_type'] == 2){ echo "selected"; } ?>>User</option>
      </select>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control"> 
    </div>
   <div class="form-group required">
      <label class="control-label">Country</label>
      <select class="form-control" id="contact-select" name="country">
        
        <?php foreach ($country as $key => $value) {?>
          <option value="<?=$value['id']?>" <?=$user['country']== $value['id'] ? "selected" : ""?> ><?=$value['nicename']?></option>
        <?php  } ?>

       
      </select>
    </div>
    <div class="form-group required">
      <label class="control-label">Change Plan</label>
      <select class="form-control" id="contact-select" name="planId">
        
        <?php foreach ($plan as $key => $value) {?>
          <option value="<?=$value['id']?>" <?=$user['planId']== $value['id'] ? "selected" : ""?> ><?=$value['name']?></option>
        <?php  } ?>

       
      </select>
    </div>
    <div class="form-group">
      <label>Plan Status</label>
      <select class="form-control" name="plan_status">
        <option selected>Choose Status...</option>
        <option value="Free" <?php if($user['plan_status'] == 'Free'){ echo "selected"; } ?>>Free</option>
        <option value="active" <?php if($user['plan_status'] == 'active'){ echo "selected"; } ?>>Active</option>
        <option value="inactive" <?php if($user['plan_status'] == 'inactive'){ echo "selected"; } ?>>Inactive</option>
        <option value="deleted" <?php if($user['plan_status'] == 'deleted'){ echo "selected"; } ?>>Deleted</option>
      </select>
    </div>
    <div class="form-group">
      <?php 
        if(!empty($user['profile_pic']) )
        {
      ?>
      <label>Edit Profile</label>
      <img src="<?php echo $user['profile_pic'];?>" width="70px" height="70px">
      <?php    
        }else{
      ?>
      <label>Add Profile</label>
      <?php } ?>
      <input type="file" name="image" class="form-control" > 
    </div>
    <div class="form-group">
      <button class="btn green">Update</button>
    </div>

  </div>
  <!--end tabbable--> 
</form>
</div>
<!-- END PAGE CONTENT--> 
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
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script> 
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
