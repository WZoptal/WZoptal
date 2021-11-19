<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<?php $pagename=$this->uri->segment(2);  ?>
<link href="<?php echo base_url(); ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>

<!-- BEGIN PAGE HEADER-->

<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Homepage Content </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="<?php echo base_url();?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="javascript:void(0);"> Content Mangement / Homepage Content </a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>

<!-- END PAGE HEADER--> 

<!-- BEGIN PAGE CONTENT-->

<div class="row profile">
  <div class="col-md-12"> 
    
    <!--BEGIN TABS-->
    
    <div class="tabbable tabbable-custom tabbable-full-width">
      <ul class="nav nav-tabs">
        <li class="active"> <a href="#tab_1_1" data-toggle="tab"> Homepage Content </a> </li>
      </ul>
      <div class="message2" id="message"> <font color='red'><?php echo $this->session->flashdata('errormsg'); ?></font> <font color='green'><?php echo $this->session->flashdata('successmsg'); ?></font> </div>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1_1">
          <div class="row">
            <div class="col-md-9" style="width:100%">
              <div class="row"> </div>
              
              <!--end row-->
              
              <div class="tab-pane active" id="tab1"> </div>
              <form name="frm" id="frm" action="<?php echo base_url(); ?>content/update_homecontent_information" method="post" enctype="multipart/form-data">
                <?php if($do=="edit"){ ?>
                <input type="hidden" name="id" value="<?php echo $resultset['id'];?>">
                <input type="hidden" name="page_name" value="<?php echo $pagename;?>">
                <?php	} ?>
                <div class="form-group flare">
                  <label class="control-label col-md-4"> Convenient Booking </label>
                  <div class="col-md-8">
                  	<textarea class="form-control" name="page_content" style="width:500px; height:50px" id="description"><?php echo $resultset['page_content']; ?></textarea>
                    <br />
                     Character Left :<span id="charLeft" ></span>
                    <span class="help-block" id="description_error"> </span> </div>
                </div>
                <div class="form-group flare">
                  <label class="control-label col-md-4"> Instant Accessing </label>
                  <div class="col-md-8">
                  	<textarea class="form-control" name="address" style="width:500px; height:50px" id="address"><?php echo $resultset['address']; ?></textarea>
                    <br />
                     Character Left :<span id="charLeft_address" ></span>
                    <span class="help-block" id="address_error"> </span> </div>
                </div>
                <div class="form-group flare">
                  <label class="control-label col-md-4"> Easy Searching </label>
                  <div class="col-md-8">
                  	<textarea class="form-control" name="rightbar_heading" style="width:500px; height:50px" id="rightbar_heading"><?php echo $resultset['rightbar_heading']; ?></textarea>
                    <br />
                     Character Left :<span id="charLeft_rightbar_heading" ></span>
                    <span class="help-block" id="rightbar_heading_error"> </span> </div>
                </div>
                <div class="form-group flare">
                  <label class="control-label col-md-4"> Fast Connecting </label>
                  <div class="col-md-8">
                  	<textarea class="form-control" name="summary" style="width:500px; height:50px" id="summary"><?php echo $resultset['summary']; ?></textarea>
                    <br />
                     Character Left :<span id="charLeft_summary" ></span>
                    <span class="help-block" id="summary_error"> </span> </div>
                </div>
                <br />
                <div class="form-group flare">
                  <label class="control-label col-md-4"> Upcoming Events </label>
                  <div class="col-md-8">
                  	<textarea class="form-control" name="event_content" style="width:500px; height:50px" id="event_content"><?php echo $resultset['event_content']; ?></textarea>
                    <br />
                     Character Left :<span id="charLeft_event_content" ></span>
                    <span class="help-block" id="event_content_error"> </span> </div>
                </div>
                <br />
                <div class="form-group flare">
                  <label class="control-label col-md-4"> Testimonials </label>
                  <div class="col-md-8">
                  	<textarea class="form-control" name="test_content" style="width:500px; height:50px" id="test_content"><?php echo $resultset['test_content']; ?></textarea>
                    <br />
                     Character Left :<span id="charLeft_test_content" ></span>
                    <span class="help-block" id="test_content_error"> </span> </div>
                </div>
                <br />
                <div class="form-group">
                  <label class="control-label col-md-4">&nbsp; </label>
                  <div class="col-md-8">
                    <input type="submit" value="Save" class="btn theme-btn green pull-left" onclick="return validate_form();">
                    <a href="<?php echo base_url();?>content/home_content"  class="btn theme-btn grey pull-left margd">Cancel</a> </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <!--tab_1_2--> 
      
    </div>
  </div>
  
  <!--END TABS--> 
  
</div>

<!-- END PAGE CONTENT--> 

<!-- BEGIN PAGE LEVEL PLUGINS --> 

<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/jsFunctions.js"></script> 
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 

<script src="<?php echo base_url(); ?>assets/scripts/core/app.js"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/components-pickers.js"></script> 

<!-- END PAGE LEVEL SCRIPTS --> 

<script>

        jQuery(document).ready(function() {       
            // initiate layout and plugins
            App.init();
           //ComponentsPickers.init();
		    check_text_limit();
         });   

    </script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/validate_functions.js"></script> 
<script type="text/javascript">

function validate_form(){
 	var description = $('#description').val();
 	var address = $('#address').val();
 	var rightbar_heading = $('#rightbar_heading').val();
 	var summary = $('#summary').val();
 	//var email_regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
 	if(description == ""){
 		$('.help-block').html('');
 		$('#description_error').html('Error : Please Provide Convenient Booking').css({'color':'red'});
 		$('#description').focus(); 
 		return false;
 	 } 
 	else if(description == ""){
 		$('.help-block').html('');
 		$('#address_error').html('Error : Please Provide Instant Accessing').css({'color':'red'});
 		$('#address').focus(); 
 		return false;
 	 } 
 	else if(rightbar_heading == ""){
 		$('.help-block').html('');
 		$('#rightbar_heading_error').html('Error : Please Provide Easy Searching').css({'color':'red'});
 		$('#rightbar_heading').focus(); 
 		return false;
 	 } 
 	else if(summary == ""){
 		$('.help-block').html('');
 		$('#summary_error').html('Error : Please Provide Fast Connecting').css({'color':'red'});
 		$('#summary').focus(); 
 		return false;
 	 } 
  	 else{
 	   return true;
 	 }
 }

//for text length
  $('#description').keyup(function() {
	 var len = this.value.length;
	   if (len >= 85) {
			this.value = this.value.substring(0, 85);
	   }
	   $('#charLeft').text(85 - len);
  });
  $('#charLeft').text(85);
  
  $('#address').keyup(function() {
	 var len = this.value.length;
	   if (len >= 85) {
			this.value = this.value.substring(0, 85);
	   }
	   $('#charLeft_address').text(85 - len);
  });
  $('#charLeft_address').text(85);

  $('#rightbar_heading').keyup(function() {
	 var len = this.value.length;
	   if (len >= 85) {
			this.value = this.value.substring(0, 85);
	   }
	   $('#charLeft_rightbar_heading').text(85 - len);
  });
  $('#charLeft_rightbar_heading').text(85);

  $('#summary').keyup(function() {
	 var len = this.value.length;
	   if (len >= 85) {
			this.value = this.value.substring(0, 85);
	   }
	   $('#charLeft_summary').text(85 - len);
  });
  $('#charLeft_summary').text(85);
  
  $('#event_content').keyup(function() {
	 var len = this.value.length;
	   if (len >= 85) {
			this.value = this.value.substring(0, 85);
	   }
	   $('#charLeft_event_content').text(85 - len);
  });
  $('#charLeft_event_content').text(85);

  $('#test_content').keyup(function() {
	 var len = this.value.length;
	   if (len >= 85) {
			this.value = this.value.substring(0, 85);
	   }
	   $('#charLeft_test_content').text(85 - len);
  });
  $('#charLeft_test_content').text(85);
  
  function check_text_limit(){
	 var len = $('#description').val().length; //alert(len);
 	  $('#charLeft').text(85 - len);
	  
	 var len1 = $('#address').val().length;  
 	  $('#charLeft_address').text(85 - len1);

	 var len2 = $('#rightbar_heading').val().length;  
 	  $('#charLeft_rightbar_heading').text(85 - len2);

	 var len3 = $('#summary').val().length; 
 	  $('#charLeft_summary').text(85 - len3);
	  
	 var len3 = $('#event_content').val().length; 
 	  $('#charLeft_event_content').text(85 - len3);
	  
	 var len3 = $('#test_content').val().length;  
 	  $('#charLeft_test_content').text(85 - len3);
   }
</script> 
