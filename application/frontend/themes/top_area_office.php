<?php  $loginUserData = $this->user_model->getLoginSessionData($this->session->userdata('user_id')); ?>
<div class="header navbar navbar-fixed-top"> 
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="header-inner"> 
    <!-- BEGIN LOGO --> 
    <a style="margin-top:0px; padding: 10px 15px;" class="navbar-brand" href="<?php echo base_url(); ?>dashboard"> <!--<img height="45" src="<?php echo base_url();?>assets/logo1.png" alt="pic"/>-->&nbsp;<?php echo $this->config->item('sitename'); ?></a> 
    <!-- END LOGO --> 
    <!-- BEGIN HORIZANTAL MENU -->
     <div class="hor-menu hidden-sm hidden-xs">
      <ul class="nav navbar-nav">
        <li class="classic-menu-dropdown <?php $pagename=$this->uri->segment(1); if($pagename=="dashboard"){ echo 'active'; }?>"> <a href="<?php echo base_url(); ?>dashboard"> Dashboard <span class="selected"> </span> </a> </li>
       </ul>
    </div>
     <!-- END HORIZANTAL MENU --> 
    <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
    <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <img src="<?php echo base_url(); ?>assets/img/menu-toggler.png" alt=""/> </a> 
    <!-- END RESPONSIVE MENU TOGGLER --> 
    <!-- BEGIN TOP NAVIGATION MENU -->
    <ul class="nav navbar-nav pull-right">
      <li class="dropdown user"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <!--<img alt="" src="<?php echo base_url(); ?>assets/img/avatar1_small.jpg"/>--> <span class="username">  <?php echo ucfirst($loginUserData['title']); ?> </span> <i class="fa fa-angle-down"></i> </a>
        <ul class="dropdown-menu">
          <!--<li> <a href="extra_profile.html"> <i class="fa fa-user"></i> My Profile </a> </li>-->
          <li> <a href="<?php echo base_url(); ?>stores/update_profile"> <i class="fa fa-cloud-upload" style="margin-right:5px;"></i>Update Profile </a> </li>
          <li> <a href="<?php echo base_url(); ?>stores/change_password"> <i class="fa fa-user-o" aria-hidden="true"></i> Change Password </a> </li> 
          <!--<li><a href="#"><i class="fa fa-tasks"></i> My Tasks<span class="badge badge-success">7</span></a></li>-->
          <li class="divider"> </li>
          <li> <a href="<?php echo base_url(); ?>login/logout"> <i class="fa fa-key"></i> Log Out </a> </li>
        </ul>
      </li>
      <!-- END USER LOGIN DROPDOWN -->
    </ul>
    <!-- END TOP NAVIGATION MENU --> 
  </div>
  <!-- END TOP NAVIGATION BAR --> 
</div>
