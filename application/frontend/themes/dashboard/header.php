<div class="header navbar navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->    
    <div class="header-inner">
        <!-- BEGIN LOGO -->         
        <a class="navbar-brand" href="<?=base_url(); ?>">
            <!--<img height="27" src="<?=base_url();?>assets/logo1.png" alt="pic"/>-->&nbsp;<?=$this->config->item('sitename'); ?>
        </a>
        <!-- END LOGO -->         
        <!-- BEGIN HORIZANTAL MENU -->        
        <div class="hor-menu hidden-sm hidden-xs">
            <ul class="nav navbar-nav">
                <li class="classic-menu-dropdown <?php $pagename=$this->uri->segment(1); if($pagename=="dashboard"){ echo 'active'; }?>"> <a href="<?=base_url(); ?>dashboard"> Dashboard <span class="selected"> </span> </a> </li>
            </ul>
        </div>
        <!-- END HORIZANTAL MENU -->         
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->         
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">             
        	<img src="<?=base_url(); ?>assets/dashboard/img/menu-toggler.png" alt=""/>         
        </a>         
        <!-- END RESPONSIVE MENU TOGGLER -->         
        <!-- BEGIN TOP NAVIGATION MENU -->        
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown user">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img alt="" src="<?=base_url(); ?>assets/img/avatar1_small.jpg"/> 
                    <span class="username"><?=ucfirst($this->session->userdata['username']); ?> </span> <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <!--<li> <a href="extra_profile.html"> <i class="fa fa-user"></i> My Profile </a> </li>-->                    
                    <li> <a href="<?=base_url(); ?>dashboard/update_profile"> <i class="fa fa-cloud-upload" style="margin-right:5px;"></i>Update Profile </a> </li>
                    <!-- <li> <a href="#"> <i class="fa fa-envelope"></i> Change Password </a> </li>-->                    
                    <!--<li><a href="#"><i class="fa fa-tasks"></i> My Tasks<span class="badge badge-success">7</span></a></li>-->
                    <li class="divider"> </li>
                    <li> <a href="javascript:;" id="trigger_fullscreen"> <i class="fa fa-arrows"></i> Full Screen </a> </li>
                    <li> <a href="<?=base_url(); ?>login/logout"> <i class="fa fa-key"></i> Log Out </a> </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->        
        </ul>
        <!-- END TOP NAVIGATION MENU -->     
    </div>
    <!-- END TOP NAVIGATION BAR --> 
</div>