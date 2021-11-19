<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dd.css" />
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Edit User</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i> <a href="index.html">Home </a><i class="fa fa-angle-right"></i> </li>
            <li><a href="javascript:void(0);">Edit User</a></li>
        </ul>
    </div>
</div>
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

<div class="row profile">
    <div class="col-md-12">
        <div class="tabbable tabbable-custom tabbable-full-width">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1_1" data-toggle="tab">Edit User</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row"> </div>
                            <div class="tab-pane active" id="tab1">
                                <h3 class="block">Provide user details</h3>
                                <h4 class="form-section">Edit user Account</h4>
                                <form id="edit_user_form" action="<?= base_url();?>users/update_user_to_database" method="post">
                                    <input type="hidden" name="user_id" value="<?= $userdata['id']; ?>">
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="username">Username <span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="username" name="username" value="<?= $userdata['username']; ?>" readonly> 
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="user_type">User Type<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="user_type" name="user_type" required>
                                                <option value="1" <?= $userdata['user_type'] == '1' ? 'selected': ''; ?>>Host</option>
                                                <option value="2" <?= $userdata['user_type'] == '2' ? 'selected': ''; ?>>Lender</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="first_name">First Name<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $userdata['first_name']; ?>" required> 
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="last_name">Last Name<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $userdata['last_name']; ?>" required> 
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="email">Email<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" id="email" name="email" value="<?= $userdata['email']; ?>" required> 
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="phone">Phone<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $userdata['phone']; ?>" required> 
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="location">Location<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="location" name="location" value="<?= $userdata['location']; ?>" required> 
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="address">Address<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="address" name="address" value="<?= $userdata['address']; ?>" required> 
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4" for="about_user">About User<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" id="about_user" name="about_user" required><?= $userdata['about_user']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-md-4">&nbsp; </label>
                                        <div class="col-md-8">
                                            <input type="submit" value="Update" class="btn theme-btn green pull-left" name="au_submit"> <a href="<?= base_url();?>users/manage_users" class="btn theme-btn grey pull-left margd">Cancel</a> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="<?= base_url(); ?>assets/plugins/jquery-1.10.2.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/jquery.blockui.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/jquery.cokie.min.js"></script> 
<script src="<?= base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script> 
<!-- END PAGE LEVEL PLUGINS --> 

<script src="<?= base_url(); ?>assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script> 
<script src="<?= base_url(); ?>assets/scripts/core/app.js"></script> 
<script src="<?= base_url(); ?>assets/scripts/custom/search.js"></script> 
<script>
   jQuery(document).ready(function() {
      App.init();
      Search.init();
   });
</script>