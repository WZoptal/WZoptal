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
       <li class="btn-group"> <a href="<?php echo base_url(); ?>subscription" class="btn green dropdown-toggle "> <i class="fa fa-arrow-left" aria-hidden="true"></i> <span>Back </span></a> </li>
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
                <form name="frm" id="frm" action="<?php echo base_url();?>subscription/add_plan_to_database" method="post" enctype="multipart/form-data">
                  <?php if($do=="edit"){ ?>
                  <input type="hidden" name="id" value="<?php echo $categorydata['id'];?>">
                  <?php } ?>

                  <div class="form-group">
                    <label class="control-label col-md-4">Name <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo !empty($categorydata['name']) ? $categorydata['name']: ""; ?>">
                      <span class="help-block" id="name_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Title <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="title" name="title" value="<?php echo !empty($categorydata['title']) ? $categorydata['title']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-4">Price<span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="amount" name="amount" value="<?php echo !empty($categorydata['amount']) ? $categorydata['amount']: ""; ?>">
                      <span class="help-block" id="amount_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Currency <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="currency" name="currency" value="<?php echo !empty($categorydata['currency']) ? $categorydata['currency']: ""; ?>">
                      <span class="help-block" id="currency_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Billing cycle <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="billing_cycle" name="billing_cycle" value="<?php echo !empty($categorydata['billing_cycle']) ? $categorydata['billing_cycle']: ""; ?>">
                      <span class="help-block" id="billing_error"> </span> </div>
                  </div>

                    
                
                 <div class="form-group">
                  <label class="control-label col-md-4" >Image <span class="required">*</span></label>
                  <div class="col-md-8">
                   <?php if($do=="edit"){ ?>
                    <input type="file" class="form-control" name="image" accept="image/*" >
                    <img width="200" src="<?php echo !empty($categorydata['image']) ? base_url().'../pics/plans/'.$categorydata['image']: ""; ?>">
                    <span class="required" style="color:red">*please upload image</span>
                   <?php }else{?>
                    <input type="file" class="form-control" name="image" accept="image/*" required=""> 
                    <span class="required" style="color:red">*please upload image</span>
                   <?php }?>
                  </div>
                 </div>

                


                   <div class="form-group"><br><br>
                    <label class="control-label col-md-4">&nbsp; </label>
                    <div class="col-md-8" style="margin-top: 7px;">
                      <input type="submit" value="Save" class="btn theme-btn green pull-left" onclick="return validate_form();">
                      <a href="<?php echo base_url();?>subscription"  class="btn theme-btn grey pull-left margd">Cancel</a> </div>
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
   App.init();
  //ComponentsPickers.init();
  });   
</script> 
<script>
function validate_form(){
  var title = $('#title').val();
     if(title == ""){
    $('.help-block').html('');
    $('#name_error').html('Error : Please Provide Name').css({'color':'red'});
    $('#title_error').html('Error : Please Provide Title').css({'color':'red'});
    $('#amount_error').html('Error : Please Provide Amount').css({'color':'red'});
    $('#currency_error').html('Error : Please Provide Currency').css({'color':'red'});
    $('#billing_error').html('Error : Please Provide billing cycle').css({'color':'red'});

    $('#title').focus(); 
    return false;
   } 
     else{
     return true;
   }
}
</script> 
