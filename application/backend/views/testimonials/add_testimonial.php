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
      <div style=" position:absolute; float:left; left:211px;" id="message"> <font color='red'><?php echo $this->session->flashdata('errormsg'); ?></font> <font color='green'><?php echo $this->session->flashdata('successmsg'); ?></font> </div>
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
                <form name="frm" id="frm" action="<?php echo base_url();?>testimonials/add_testimonials_to_database" method="post" enctype="multipart/form-data">
                  <?php if($do=="edit"){ ?>
                  <input type="hidden" name="id" value="<?php echo $resultset['id'];?>">
                  <?php } ?>
                  <div class="form-group">
                    <label class="control-label col-md-4">Name <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo !empty($resultset['name']) ? $resultset['name']: ""; ?>">
                      <span class="help-block" id="name_error"> </span> </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Image <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="file" class="form-control" name="image" id="image">
                      </br>
                      <input type="hidden" name="prev_image" value="<?php echo $resultset['image'];?>" id="prev_image">
                      <?php //if($do=="edit"){
						  if($resultset['image'] <> ''){
							  $image = BASEURL.'/pics/testimonials/'.$resultset['image'];
						  }
						  else{
							  $image = base_url().'images/no_image.gif';
						  }
					  
					  ?>
                      	<img src="<?php echo $image; ?>" height="90px" width="90px" />
                      <?php // } ?>
                      <span class="help-block">For best resolution : 90px * 90px (JPG,GIF,JPEG,PNG) </span>
                      <span class="help-block1" id="image_error"> </span><div style="margin-bottom:10px;"></div> </div>
                      
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Comment <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="comment" id="comment"><?php echo !empty($resultset['comment']) ? $resultset['comment']: ""; ?></textarea>
                      <span class="help-block" id="comment_error"> </span> </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-4">&nbsp; </label>
                    <div class="col-md-8">
                      <input type="submit" value="Save" class="btn theme-btn green pull-left" onclick="return validate_form();">
                      <a href="<?php echo base_url();?>testimonials/manage_testimonials"  class="btn theme-btn grey pull-left margd">Cancel</a> </div>
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
<script type="text/javascript" src="<?php echo BASEURL; ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<?php /*?><script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<!-- BEGIN PAGE LEVEL SCRIPTS -->  <?php */?>
<script src="<?php echo base_url(); ?>assets/scripts/core/app.js"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/components-pickers.js"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 
<script>
  jQuery(document).ready(function() {       
	 // initiate layout and plugins
	 App.init();
	ComponentsPickers.init();
  });   
</script> 
<script type="text/javascript">
function validate_form(){ 
   var image      = $.trim($('#image').val());
   var prev_image = $.trim($('#prev_image').val());
   var name       = $.trim($('#name').val());
   var comment    = $.trim($('#comment').val());
  // var regex1   =  /^[ A-Za-z0-9_@./#&+-]*$/; /*/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;*/
  // var regex    =  /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   /*if(email == ""){
		$('.help-block').html('');
		$('#email_error').html('Error : Please Provide Email Id').css({'color':'red'});
		$('#email').focus(); 
		return false;
	 }
	else if(!regex.test(email)){
	    $('.help-block').html('');
		$('#email_error').html('Error : Please Provide valid Email Id').css({'color':'red'});
		$('#email').focus(); 
		return false;
	 }
	else if(!regex1.test(email)){
	    $('.help-block').html('');
		$('#email_error').html('Error : Please Provide valid Email Id').css({'color':'red'});
		$('#email').focus(); 
		return false;
	}
    else*/
	if(name == ""){
		$('.help-block').html('');
		$('#name_error').html('Error : Please Provide Name').css({'color':'red'});
		$('#name').focus(); 
		return false;
	 }
    else if(image == "" && prev_image == ""){
		$('.help-block').html('');
		$('#image_error').html('Error : Please Provide Image').css({'color':'red'});
		$('#image').focus(); 
		return false;
	 }
    else if(comment == ""){
		$('.help-block').html('');
		$('#comment_error').html('Error : Please Provide Comment').css({'color':'red'});
		$('#comment').focus(); 
		return false;
	 }
   	 else{  
		  $('.help-block').html('');
		  return true; 
	 }
}

</script> 
