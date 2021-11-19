<!-- BEGIN PAGE HEADER-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> View  <?php echo $item; ?></h3>
    <ul class="page-breadcrumb breadcrumb">
      <li class="btn-group"> <a href="<?php echo base_url(); ?>subscription" class="btn green dropdown-toggle "> <i class="fa fa-arrow-left" aria-hidden="true"></i> <span> Back </span></a> </li>
      <li> <i class="fa fa-home"></i> <a href="#"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="javascript:void(0);"> View <?php echo $item; ?></a> </li>
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
        <li class="active"> <a href="#tab_1_1" data-toggle="tab"> View <?php echo $item; ?>  </a> </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1_1">
          <div class="row">
            <div class="col-md-12">
              <div class="row"> 
                <!--end col-md-8--> 
                <!--end col-md-4--> 
              </div>
              <!--end row-->
              <div class="tab-pane active" id="tab1">
             
                <div class="form-group detra">
                  <label class="control-label col-md-4">Name</label>
                  <div class="col-md-8"> <span class="detail_for_name"><?php echo !empty($resultset['title']) ? $resultset['name']: ""; ?></span> </div>
                </div>
                 <div class="form-group detra">
                  <label class="control-label col-md-4">Title</label>
                  <div class="col-md-8"> <span class="detail_for_name"><?php echo !empty($resultset['title']) ? $resultset['title']: ""; ?></span> </div>
                </div>
                 <div class="form-group detra">
                  <label class="control-label col-md-4">Description</label>
                  <div class="col-md-8"> <span class="detail_for_name"><?php echo !empty($resultset['description']) ? $resultset['description']: ""; ?></span> </div>
                </div>
                 <div class="form-group detra">
                  <label class="control-label col-md-4">Price</label>
                  <div class="col-md-8"> <span class="detail_for_name"><?php echo !empty($resultset['amount']) ? $resultset['amount']: ""; ?></span> </div>
                </div>
                 <div class="form-group detra">
                  <label class="control-label col-md-4">Currency</label>
                  <div class="col-md-8"> <span class="detail_for_name"><?php echo !empty($resultset['currency']) ? $resultset['currency']: ""; ?></span> </div>
                </div>
                <div class="form-group detra">
                  <label class="control-label col-md-4">Billing cycle</label>
                  <div class="col-md-8"> <span class="detail_for_name"><?php echo !empty($resultset['billing_cycle']) ? $resultset['billing_cycle']: ""; ?></span> </div>
                </div>
                <div class="form-group detra">
                  <label class="control-label col-md-4">Status </label>
                  <div class="col-md-8"> <span class="detail_for_name"><?php if($resultset['status'] == 1){ ?>Enable<?php } else{ ?>Disable<?php } ?></span> </div>
                </div>

                <div class="form-group detra">
                  <label class="control-label col-md-4">Image </label>
                  <div class="col-md-8"> <span class="detail_for_name">
                   <img src="<?php echo !empty($resultset['image']) ? base_url().'../pics/plans/'.$resultset['image']: ""; ?>">
                      
                    </span> </div>
                </div>

                <div class="form-group detra">
                  <label class="control-label col-md-4">Posted </label>
                  <div class="col-md-8"> <span class="detail_for_name"><?php echo date('M d, Y',  $resultset['created_at']); ?></span> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">&nbsp; </label>
                    <div class="col-md-8"> <a href="<?php echo base_url();?>subscription"  class="btn theme-btn green pull-left">Back</a> </div>
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
  </div>
  <!-- END PAGE CONTENT--> 
</div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<?php echo base_url(); ?>assets/scripts/core/app.js"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/components-pickers.js"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 
<script>
        jQuery(document).ready(function() {       
           // initiate layout and plugins
           App.init();
         //  ComponentsPickers.init();
        });   
    </script> 

<!-- END JAVASCRIPTS --> 
