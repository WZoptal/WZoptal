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
		<h3 class="page-title">  Testimonials</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li> <i class="fa fa-home"></i> <a href="<?php echo base_url();?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
			<li> <a href="javascript:void(0);"> Content Mangement / Testimonials  </a> </li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB--> 
	</div>
</div>
<!-- END PAGE HEADER--> 
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
<!-- BEGIN PAGE CONTENT-->
<div class="row profile">
	<div class="col-md-12"> 
		<!--BEGIN TABS-->
		<div class="tabbable tabbable-custom tabbable-full-width">
			<ul class="nav nav-tabs">
				<li class="active"> <a href="#tab_1_1" data-toggle="tab"> Testimonials </a> </li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1_1">
					<div class="row">
						<div class="col-md-9" style="width:100%">
							<div class="row">  </div>
								<!--end row-->
								<div class="tab-pane active" id="tab1"> </div>
								<form name="frm" id="frm" action="<?php echo base_url(); ?>content/update_page_to_database" method="post" enctype="multipart/form-data">
								<?php if($do=="edit"){ ?>
								<input type="hidden" name="id" value="<?php echo $resultset['id'];?>">
								<input type="hidden" name="page_name" value="<?php echo $pagename;?>">
								<?php	} ?>
								<div class="form-group">
									<label class="control-label col-md-4" style="width:13%">Title</label>
									<div class="col-md-8" style="width:87%">
										<input type="text" class="form-control" name="page_title" id="page_title" value="<?php echo stripslashes($resultset['page_title']);?>">
										<span class="help-block" id="page_title_error"> </span> 
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4" style="width:13%">Page Content  </label>
									<div class="col-md-8" style="width:87%">
										<textarea class="form-control ckeditor" rows = "6" name="page_content" id="page_content" ><?php echo stripslashes($resultset['page_content']);?></textarea>
										<span class="help-block" id="contact_number_error"> </span> 
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">&nbsp; </label>
									<div class="col-md-8">
										<input type="submit" value="Save" class="btn theme-btn green pull-left" onclick="return validate_form();">
										<a href="<?php echo base_url();?>content/disclaimer"  class="btn theme-btn grey pull-left margd">Cancel</a>
									</div>
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
	  ComponentsPickers.init();
	});   
</script> 

<script type="text/javascript" src="<?php echo base_url(); ?>js/validate_functions.js"></script>
<script type="text/javascript">

</script>

