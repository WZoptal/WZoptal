<div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
      <li class="sidebar-toggler-wrapper">
        <div class="sidebar-toggler hidden-phone"> </div>
      </li>
      <li class="sidebar-search-wrapper"><br />
      </li>
      <li class="start <?php if($this->uri->segment(1) == "dashboard"){ ?> active<?php } ?>"> <a href="<?php echo base_url(); ?>"> <i class="fa fa-home"></i> <span class="title"> Dashboard </span> </a> </li>
      <!--li class="<?php if($this->uri->segment(1) == "category"){ ?> active<?php } ?>"> <a href="<?= base_url(); ?>category"> <i class="fa fa-users" aria-hidden="true"></i> <span class="title"> Categories Management </span> </a> </li-->      	 
       <li class="<?php if($this->uri->segment(1) == "users"){ ?> active<?php } ?>"> <a href="avascript:void(0);"> <i class="fa fa-users" aria-hidden="true"></i> <span class="title"> Users Management </span> </a> 
        <ul class="sub-menu">
          <li <?php if($this->uri->segment(2) == "manage_business"  || $this->uri->segment(2) == "view_installer"){ ?> class="active"<?php } ?>> <a href="<?= base_url(); ?>users/manage_business"><i class="fa fa-user" aria-hidden="true"></i> Business </a> </li>
          <li <?php if($this->uri->segment(2) == "manage_user" || $this->uri->segment(2) == "view_user"){ ?> class="active"<?php } ?>> <a href="<?= base_url(); ?>users/manage_user"><i class="fa fa-user-secret" aria-hidden="true"></i> User </a> </li>
        </ul>
      </li>
       <!--li class="<?php if($this->uri->segment(1) == "users"){ ?> active<?php } ?>"> <a href="<?= base_url(); ?>users/manage_users"> <i class="fa fa-user-plus" aria-hidden="true"></i> <span class="title"> Users Management </span> </a> </li-->
      <li class="<?php if($this->uri->segment(1) == "events"){ ?> active<?php } ?>"> <a href="<?= base_url(); ?>events/manage_events"> <i class="fa fa-calendar" aria-hidden="true"></i> <span class="title"> Events Management </span> </a> </li>
      <li class="<?php if($this->uri->segment(1) == "office"){ ?> active<?php } ?>"> <a href="<?= base_url(); ?>office"> <i class="fa fa-building-o" aria-hidden="true"></i> <span class="title"> Office Management </span> </a> </li>      
      <li <?php if($this->uri->segment(1) == "content"){ ?> class="active"<?php } ?>> <a href="javascript:void(0);"> <i class="fa fa-files-o" aria-hidden="true"></i> <span class="title"> Content Management </span> <span class="arrow"> </span> </a>
        <ul class="sub-menu">
          <li <?php if($this->uri->segment(2) == "about_us"){ ?> class="active"<?php } ?>> <a href="<?= base_url(); ?>content/about_us"><i class="fa fa-file-text-o"></i> About Us</a> </li> 
          <li <?php if($this->uri->segment(2) == "privacy_policy"){ ?> class="active"<?php } ?>> <a href="<?= base_url(); ?>content/privacy_policy"> <i class="fa fa-gavel"></i> Privacy Policy</a> </li>          
          <li <?php if($this->uri->segment(2) == "terms"){ ?> class="active"<?php } ?>> <a href="<?= base_url(); ?>content/terms"> <i class="fa fa-info-circle"></i> Term & Condition</a> </li>
          
        </ul>
      </li>
    </ul>
  </div>
</div>