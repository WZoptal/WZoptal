

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<!-- END PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dd.css" />
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"><?php if($do=="edit"){ ?> Edit <?php } else{ ?> Add <?php } ?>  <?php echo $item; ?></h3>
    <ul class="page-breadcrumb breadcrumb">
      <li class="btn-group"> <a href="<?php echo base_url(); ?>location" class="btn green dropdown-toggle "> <i class="fa fa-arrow-left" aria-hidden="true"></i> <span> Back </span></a> </li>
      <li> <i class="fa fa-home"></i> <a href="<?php echo base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#"> <?php if($do=="edit"){ ?> Edit <?php } else{ ?> Add <?php } ?>  <?php echo $item; ?></a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<div class="row profile">
  <div class="col-md-12"> 
    <!--BEGIN TABS-->
    <div class="tabbable tabbable-custom tabbable-full-width">
      <ul class="nav nav-tabs">
        <li class="active"> <a href="#tab_1_1" data-toggle="tab">
          <?php if($do=="edit"){ ?> Edit <?php } else{ ?> Add <?php } ?>  <?php echo $item; ?></a> </li>
      </ul>
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
<!-- END ALERT MESSAGE -->
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1_1">
          <div class="row">
            <div class="col-md-9">
              <div class="row"> 
                <!--end col-md-8--> 
                <!--end col-md-4--> 
              </div>
              <!--end row-->
              <div class="tab-pane active" id="tab1">
                <form name="frm" id="frm" action="<?php echo base_url();?>location/add_location_to_database" method="post" enctype="multipart/form-data">
                  <?php if($do=="edit"){ ?>
                  <input type="hidden" name="id" value="<?php echo $categorydata['id'];?>">
                  <?php } ?>
                  <div class="form-group">
                    <label class="control-label col-md-4">Title <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="title" name="title" placeholder=" Title" value="<?php echo !empty($categorydata['title']) ? $categorydata['title']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Address<span class="required"> * </span></label>
                    <div class="col-md-8">
                      <textarea class="form-control ckeditor" rows = "1" placeholder=" Add the location address " name="address" id="address" ><?php echo !empty($categorydata['address']) ? $categorydata['address']: ""; ?></textarea>
                    <!--   <input type="text" class="form-control" id="address" name="address" value="<?php echo !empty($categorydata['address']) ? $categorydata['address']: ""; ?>"> -->
                      <span class="help-block" id="matthew_error"> </span> </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Direction<span class="required"> * </span></label>
                    <div class="col-md-8">
                       <textarea class="form-control ckeditor" rows = "1" placeholder="Add the direction how to reach" name="direction" id="direction" ><?php echo !empty($categorydata['direction']) ? $categorydata['direction']: ""; ?></textarea>
                   
                      <span class="help-block" id="subal_stearns_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Pin Code <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="number" class="form-control" placeholder=" PinCode" id="pincode" name="pincode" value="<?php echo !empty($categorydata['pincode']) ? $categorydata['pincode']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Latitude <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" placeholder=" Latitude" id="latitude" name="latitude" value="<?php echo !empty($categorydata['latitude']) ? $categorydata['latitude']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Longitude <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control"  placeholder=" Longitude" id="longitude" name="longitude" value="<?php echo !empty($categorydata['longitude']) ? $categorydata['longitude']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Access Difficulty <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <select name="access_difficulty" class="form-control">
                          <option value="LOW" <?php if( trim($categorydata['access_difficulty']) == 'LOW') { echo "selected"; } ?>>Easy</option>
                          <option value="MEDIUM" <?php if(trim($categorydata['access_difficulty']) == 'MEDIUM') { echo "selected"; } ?>>Medium</option>
                          <option value="HIGH" <?php if(trim($categorydata['access_difficulty']) == 'HIGH') { echo "selected"; } ?>>Difficult</option>

                      </select>

                      <span class="help-block" id="title_error"> </span> </div>
                  </div>



                  <div class="form-group">
                  <label class="control-label col-md-4" >Location Icon <span class="required">*</span></label>
                  <div class="col-md-8">
                    <div class="dummy_location">
                      <div class="col-md-5">
                        <input type="checkbox" id="dummy_location_check" name="default_location" <?php if($categorydata['icon'] == 'location_default_icon.jpg') { echo "checked"; }?>>
                        <img src="<?php echo base_url().'../pics/location/location_default_icon.jpg'; ?>">
                        <label class="control-label" >Default Icon </label>
                      </div>
                      <div class="col-md-2">
                        <label class="control-label" >  OR </label>
                      </div>
                      <div class="col-md-5">
                        <?php if($do=="edit"){ ?>
                        <input type="file" class="form-control location_icon" name="icon" accept="image/*"  <?php if($categorydata['icon'] != 'location_default_icon.jpg') { echo "required"; } ?> >
                        <?php if($categorydata['icon'] != 'location_default_icon.jpg') { ?>
                        <img src="<?php echo !empty($categorydata['icon']) ? base_url().'../pics/location/'.$categorydata['icon']: ""; ?>">
                        <?php } ?>
                        <span class="required" style="color:red">*please upload icon image</span>
                       <?php }else{?>
                        <input type="file" class="form-control location_icon" name="icon" accept="image/*"> 
                        <span class="required" style="color:red">*please upload icon image</span>
                       <?php }?>
                     </div>
                    </div>

                   <!-- <?php if($do=="edit"){ ?>
                    <input type="file" class="form-control" name="icon" accept="image/*" >
                    <img src="<?php echo !empty($categorydata['icon']) ? base_url().'../pics/location/'.$categorydata['icon']: ""; ?>">
                    <span class="required" style="color:red">*please upload icon image</span>
                   <?php }else{?>
                    <input type="file" class="form-control" name="icon" accept="image/*" required=""> 
                    <span class="required" style="color:red">*please upload icon image</span>
                   <?php }?> -->
                  </div>
                 </div>
                  <div class="form-group">
                  <label class="control-label col-md-4" >Image <span class="required">*</span></label>
                  <div class="col-md-8">
                   <?php if($do=="edit"){ ?>
                    <input type="file" class="form-control" name="image[]" multiple accept="image/*" >

                     <?php foreach (array_filter(explode(",",$categorydata['image'])) as $key => $value) { ?>
                     
                         <img src="<?php echo !empty($categorydata['image']) ? base_url().'../pics/location/'.$value: ""; ?>">
                   <?php  }   ?>
                  <!--   <img src="<?php echo !empty($categorydata['image']) ? base_url().'../pics/location/'.$categorydata['image']: ""; ?>"> -->
                    <span class="required" style="color:red">*please upload image</span>
                   <?php }else{?>
                    <input type="file" class="form-control" name="image[]" multiple accept="image/*" required=""> 
                    <span class="required" style="color:red">*please upload image</span>
                   <?php }?>
                  </div>
                 </div>



                 <!-- <div class="form-group">
                  <label class="control-label col-md-4" >Audio <span class="required">*</span></label>
                  <div class="col-md-8">
                   <?php if($do=="edit"){ ?>
                    <input type="file" class="form-control" name="audio[]" multiple accept="audio/*" >
                    <span class="required" style="color:red">*please upload audio</span>

                       <?php foreach (array_filter(explode(",",$categorydata['audio'])) as $key => $value) { ?>
                        <audio controls>
                          <source src="horse.ogg" type="audio/ogg">
                          <source src="<?php echo !empty($categorydata['audio']) ? base_url().'../pics/location/'.$value: ""; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio>

                     <?php  }   ?>

                   <?php }else{?>
                    <input type="file" class="form-control" name="audio[]" multiple accept="audio/*" required=""> 
                    <span class="required" style="color:red">*please upload audio</span>
                   <?php }?>
                  </div>
                 </div> -->


                 <!-- <div class="form-group">
                  <label class="control-label col-md-4" >Video <span class="required">*</span></label>
                  <div class="col-md-8">
                   <?php if($do=="edit"){ ?>
                    <input type="file" class="form-control" name="video[]" multiple accept="video/*" >
                    <span class="required" style="color:red">*please upload video</span>

                     <?php foreach (array_filter(explode(",",$categorydata['video'])) as $key => $value) { ?>
                      <video width="320" height="240" controls>
                        <source src="<?php echo !empty($categorydata['video']) ? base_url().'../pics/episode/'.$value: ""; ?>" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                      Your browser does not support the video tag.
                      </video>


                   <?php  }   ?>
                    
                   <?php }else{?>
                    <input type="file" class="form-control" name="video[]" multiple accept="video/*" required=""> 
                    <span class="required" style="color:red">*please upload video</span>
                   <?php }?>
                  </div>
                 </div> -->


                 

                   <div class="form-group"><br><br>
                    <label class="control-label col-md-4">&nbsp; </label>
                    <div class="col-md-8" style="margin-top: 7px;">
                      <input type="submit" value="Save" class="btn theme-btn green pull-left" onclick="return validate_form();">
                      <a href="<?php echo base_url();?>location"  class="btn theme-btn grey pull-left margd">Cancel</a> </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--tab_1_2--> 
    </div>
  </div>
  <!--END TABS--> 
</div>
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/msdropdown/jquery.dd.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<?php /*?><script type="text/javascript" src="<?php echo BASEURL; ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<!-- BEGIN PAGE LEVEL SCRIPTS -->  <?php */?>
<script src="<?php echo base_url(); ?>assets/scripts/core/app.js"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/components-pickers.js"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 
<script>
  jQuery(document).ready(function() {       
   // initiate layout and plugins
  // App.init();
  //ComponentsPickers.init();
  });   
</script> 
<script>
function validate_form(){
  var title = $('#title').val();
     if(title == ""){
    $('.help-block').html('');
    $('#title_error').html('Error : Please Provide Title').css({'color':'red'});
    $('#title').focus(); 
    return false;
   } 
     else{
     return true;
   }
}

$("#dummy_location_check").on("click", function(){
  if ($(this).is(':checked')) {
    $('.location_icon').removeAttr('required');
  }else{
    $('.location_icon').attr('required', 'required');
  }
}); 

</script> 
<style type="text/css">
  .dummy_location img {
      width: 50px;
  }
</style>
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTJA6Vn26LzTvHcOEREnWrWDlpCBU3wEs&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('address');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                //document.getElementById('city2').value = place.name;
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
 -->