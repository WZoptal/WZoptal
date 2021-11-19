<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<div class="row">
   <div class="col-md-12">
      <h3 class="page-title"> View Profile</h3>
      <ul class="page-breadcrumb breadcrumb">
          <li class="btn-group"> <a href="<?php echo base_url(); ?>users/manage_user" class="btn green dropdown-toggle "> <i class="fa fa-arrow-left" aria-hidden="true"></i> <span> Back </span></a> </li>
         <li> <i class="fa fa-home"></i> <a href="<?php echo base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
         <li> <a href="javascript:void(0);"> View Profile </a> </li>
      </ul>
  </div>
</div>

<div class="row profile">
   <div class="col-md-12">
      <div class="tabbable tabbable-custom tabbable-full-width">
         <ul class="nav nav-tabs">
            <li class="active"> <a href="#tab_1_1" data-toggle="tab"> View Profile </a> </li>
         </ul>
         <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row"> 
                        <!--end col-md-8-->
                        <!--end col-md-4--> 
                     </div>
                     <div class="tab-pane active" id="tab1">
                         <div class="form-group detra">
                           <label class="control-label col-md-4">Owner Name </label>
                           <div class="col-md-8"> <span class="detail_for_name"><?= ucfirst($userdata['username']); ?></span> </div>
                        </div>
                         <div class="form-group detra">
                           <label class="control-label col-md-4">Email</label>
                           <div class="col-md-8"> <span class="detail_for_name"><?= $userdata['email']; ?></span> </div>
                        </div>
						          <!--   <div class="form-group detra">
                           <label class="control-label col-md-4">Location</label>
                           <div class="col-md-8"><span class="detail_for_name"><?= $userdata['location']; ?></span> </div>
                        </div> -->
                        <div class="form-group detra">
                           <label class="control-label col-md-4">Contact Number</label>
                           <div class="col-md-8"> <span class="detail_for_name"><?= $userdata['phone']; ?></span> </div>
                        </div>
                        <div class="form-group detra">
                           <label class="control-label col-md-4">Profile Picture </label>
                           <?php if($userdata['profile_pic'] <> ''){
                               $profile_pic = BASEURL."/pics/profile_pics/".$userdata['profile_pic'];
                           }
                           else{
                               $profile_pic = base_url()."/images/no_image.gif";
                           }
                           ?>
                           <div class="col-md-8"> <img src="<?= $profile_pic; ?>" width="120"> </div>
                        </div>
                         <div class="form-group detra">
                          <label class="control-label col-md-4">Registration Date </label>
                          <div class="col-md-8"> <span class="detail_for_name"><?php echo date('d/m/Y',  $userdata['time']); ?></span> </div>
                        </div>
                        <div class="form-group detra">
                          <label class="control-label col-md-4">Last Login Date </label>
                          <div class="col-md-8"> <span class="detail_for_name"><?php if($userdata['last_login'] <> 0 && $userdata['last_login'] !== $userdata['posted']){ echo date('d/m/Y',  $userdata['last_login']); } else{ ?> - <?php } ?></span> </div>
                        </div>
                         <div class="form-group detra">
                          <label class="control-label col-md-4">Status </label>
                          <div class="col-md-8"> <span class="detail_for_name">
                            <?php if($userdata['status'] == 0){ ?> Disable <?php } else if($userdata['status'] == 1){ ?> Enable <?php } else if($userdata['status'] == 2){ ?> Blocked <?php } ?></span> </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">&nbsp; </label>
                           <div class="col-md-8"> <a href="<?php echo base_url();?>users/manage_user"  class="btn theme-btn green pull-left">Back</a> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>   
   </div>
</div>
<script src="<?= base_url(); ?>assets/plugins/jquery-1.10.2.min.js"></script>
<script src="<?= base_url(); ?>assets/scripts/msdropdown/jquery.dd.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/jquery.blockui.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/jquery.cokie.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>assets/scripts/core/app.js"></script>
<script src="<?= base_url(); ?>assets/scripts/custom/components-pickers.js"></script> 
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