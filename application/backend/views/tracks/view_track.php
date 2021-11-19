<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<div class="row">
   <div class="col-md-12">
      <h3 class="page-title"> View <?=$item?></h3>
      <ul class="page-breadcrumb breadcrumb">
         <li> <i class="fa fa-home"></i> <a href="<?php echo base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
         <li> <a href="javascript:void(0);"> View <?=$item?> </a> </li>
      </ul>
  </div>
</div>

<div class="row profile">
   <div class="col-md-12">
      <div class="tabbable tabbable-custom tabbable-full-width">
         <ul class="nav nav-tabs">
            <li class="active"> <a href="#tab_1_1" data-toggle="tab"> View Post </a> </li>
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
					            <?php $user_data=$this->tracks_model->get_user_data($userdata['user_id']); ?>
                        <div class="form-group detra">
                           <label class="control-label col-md-4"> Posted By </label>
                           <div class="col-md-8"> <span class="detail_for_name"><?= ucfirst($user_data['username']); ?></span> </div>
                        </div> 
					             	<div class="form-group detra">
                           <label class="control-label col-md-4"> File Type </label>
                           <div class="col-md-8"> <span class="detail_for_name"><?= $userdata['file_type']== 1 ? 'Recorded': ""; ?></span> </div>
                        </div>
                         <div class="form-group detra">
                           <label class="control-label col-md-4">Title</label>
                           <div class="col-md-8"> <span class="detail_for_name"><?= ucfirst($userdata['trackname']); ?></span> </div>
                        </div>
						            <div class="form-group detra">
                           <label class="control-label col-md-4">Audio Track</label>
                           <div class="col-md-8"><span class="detail_for_name">

                             <audio controls autoplay>
                              <source src="<?=BASEURL."/pics/music_files/".$userdata['music_file']?>" type="audio/ogg">
                              <source src="horse.mp3" type="audio/mpeg">
                              Your browser does not support the audio element.
                            </audio>

                            </span> </div>
                        </div>
                        <div class="form-group detra">
                           <label class="control-label col-md-4"> Tags</label>
                           <div class="col-md-8"> <span class="detail_for_name"><?= $userdata['tags']; ?></span> </div>
                        </div>


                        <div class="form-group detra">
                           <label class="control-label col-md-4"> Post Image </label>
                           <?php if($userdata['playlistthumbnail'] <> ''){
                               $music_thumb = BASEURL."/pics/music_files/".$userdata['playlistthumbnail'];
                           }
                           else{
                               $music_thumb = base_url()."/images/no_image.gif";
                           }
                           ?>
                           <div class="col-md-8"> <img src="<?= $music_thumb; ?>" width="120"> </div>
                        </div>
                         <div class="form-group detra">
                          <label class="control-label col-md-4">Registration Date </label>
                          <div class="col-md-8"> <span class="detail_for_name"><?php echo date('d/m/Y',  $userdata['time']); ?></span> </div>
                        </div>
                         <div class="form-group detra">
                          <label class="control-label col-md-4">Status </label>
                          <div class="col-md-8"> <span class="detail_for_name">
                            <?php if($userdata['status'] == 0){ ?> Disable <?php } else if($userdata['status'] == 1){ ?> Enable <?php } else if($userdata['status'] == 2){ ?> Blocked <?php } ?></span> </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">&nbsp; </label>
                           <div class="col-md-8"> <a href="<?php echo base_url();?>tracks/<?=$landing?>"  class="btn theme-btn green pull-left">Back</a> </div>
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