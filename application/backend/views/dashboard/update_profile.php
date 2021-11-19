<?php $resultset['badges'] = ''; //print_r($volunteerdata); 
$userdata['username'] = $this->session->userdata['username'];
?>

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<!-- END PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dd.css" />
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Update Profile </h3>
    <ul class="page-breadcrumb breadcrumb">
      
      <li> <i class="fa fa-home"></i> <a href="<?php echo base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#"> Update Profile </a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
 <!-- BEGIN PAGE CONTENT-->
      <div class="row profile">
        <div class="col-md-12"> 
          <!--BEGIN TABS-->
          <div class="tabbable tabbable-custom tabbable-full-width">
            <ul class="nav nav-tabs">
              <li class="active"> <a href="#tab_1_1" data-toggle="tab"> Update Profile </a> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1_1">
                <div class="row">
                  <div class="col-md-9">
                    <div class="row"> 
                       <!--end col-md-8--> 
                       <!--end col-md-4--> 
                    </div>
                    <!--end row-->
                    
                   <div class="tab-pane active" >
                   <div class="message2" id="message_dev"> <font color='red'><?php echo $this->session->flashdata('errormsg'); ?></font> <font color='green'><?php echo $this->session->flashdata('successmsg'); ?></font> </div>
                     <form  action="<?php echo base_url();?>dashboard/update_profile_db" method="post" enctype="multipart/form-data">
                     <?php if($do=="edit"){ ?>
						<input type="hidden" name="id" value="<?php echo $userdata1['id'];?>">
					<?php } ?>
                    <div class="form-group">
                      <label class="control-label col-md-4">Email <span class="required"> * </span></label>
                      <div class="col-md-8">
                        <input name="email" id="email" value="<?php if(!empty($userdata['email'])){ echo $userdata['email']; } ?>" type="text" <?php  if($this->session->userdata['type'] != "admin"){ ?>readonly="readonly" disabled="disabled"<?php } ?> class="form-control" >
                        <span class="help-block" id="email_error"><!-- Enter your user name--> </span> </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">User Name <span class="required"> * </span></label>
                      <div class="col-md-8">
                        <input name="username" id="username" value="<?php if(!empty($userdata['username'])){ echo $userdata['username']; } ?>" type="text" <?php  if($this->session->userdata['type'] != "admin"){ ?>readonly="readonly" disabled="disabled"<?php } ?> class="form-control" >
                        <span class="help-block" id="username_error"><!-- Enter your user name--> </span> </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">Current Password <span class="required"> * </span></label>
                      <div class="col-md-8">
                        <input type="password" autocomplete="off" id="password" class="form-control" name="old_password" value="">
                        <span class="help-block" id="password_error"> </span> </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">New Password <!--<span class="required"> * </span>--></label>
                      <div class="col-md-8">
                        <input type="password" autocomplete="off" id="n_password" class="form-control" name="password" value="" >
                         <span>(Leave Blank, If you don't want to change Password)</span>
                        <span class="help-block" id="n_password_error"> </span> </div>
                    </div>
                     <br clear="all"  />
                    <div class="form-group">
              <label class="control-label col-md-4">&nbsp; </label>
              <div class="col-md-8">
              <input type="submit" value="Save" class="btn theme-btn green pull-left" onclick="return validate_form();">
               <a href="<?php echo base_url();?>dashboard"  class="btn theme-btn grey pull-left margd">Cancel</a>
              </div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/jsFunctions.js"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/msdropdown/jquery.dd.min.js"></script> 
<script>
//var tc;
$(document).ready(function(e) {
	$("#payments").msDropdown({visibleRows:4});
	$("#tech").msDropdown().data("dd");//{animStyle:'none'} /{animStyle:'slideDown'} {animStyle:'show'}		
	//no use
	try {
		var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
			var val = data.value;
			if(val!="")
				window.location = val;
		}}}).data("dd");

		var pagename = document.location.pathname.toString();
		pagename = pagename.split("/");
		pages.setIndexByValue(pagename[pagename.length-1]);
		$("#ver").html(msBeautify.version.msDropdown);
	} catch(e) {
		//console.log(e);	
	}
	
	$("#ver").html(msBeautify.version.msDropdown);
});

</script>
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
          ComponentsPickers.init();
        });   
    </script> 

<script type="text/javascript">
function validate_form(){
	var username = $('#username').val();
	var password = $('#password').val();
	var n_password = $('#n_password').val();
	vat email = $('#email').val();
	var regex = /^[a-zA-Z0-9]+$/;
	//var email_regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	<?php  if($this->session->userdata['type'] == "admin"){ ?>
	if(email == ""){
		$('.help-block').html('');
		$('#email_error').html('Error : Please Provide Email Id').css({'color':'red'});;
		$('#email').focus(); 
		return false;
	 }
	else if(!regex.test(email)){
	    $('.help-block').html('');
		$('#email_error').html('Error : Please Provide Valid Email Address').css({'color':'red'});;
		$('#email').focus(); 
		return false;
	 }
	else if(!regex1.test(email)){
	    $('.help-block').html('');
		$('#email_error').html('Error : Please Provide Valid Email Address').css({'color':'red'});;
		$('#email').focus(); 
		return false;
	 }	 
	else if(username == ""){
		$('.help-block').html('');
		$('#username_error').html('Provide Username').css({'color':'red'});
		$('#username').focus(); 
		return false;
	 }
	 else if(!regex.test($("#username").val())){
		$('.help-block').html('');
		$('#username_error').html('Provide Correct Username only character & numeric value allowed').css({'color':'red'});
		$('#username').focus(); 
		return false;
	 }
	else if(password == ""){
		$('.help-block').html('');
		$('#password_error').html('Provide Current Password').css({'color':'red'});
		$('#password').focus(); 
		return false;
	 } 
	/*else if(n_password == ""){
		$('.help-block').html('');
		$('#n_password_error').html('Provide Current Password').css({'color':'red'});
		$('#n_password').focus(); 
		return false;
	 } */
	 <?php } else{ ?>
	if(password == ""){
		$('.help-block').html('');
		$('#password_error').html('Provide New Password').css({'color':'red'});
		$('#password').focus(); 
		return false;
	 } 
	/*else if(n_password == ""){
		$('.help-block').html('');
		$('#n_password_error').html('Provide Current Password').css({'color':'red'});
		$('#n_password').focus(); 
		return false;
	 } */
	 <?php } ?>
	 else
	 {
	   return true;
	 }

}
</script>

