<div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
      <li class="sidebar-toggler-wrapper">
        <div class="sidebar-toggler hidden-phone"> </div>
      </li>
      <li class="sidebar-search-wrapper"><br />
      </li>
      <li class="start <?php if($this->uri->segment(1) == "dashboard"){ ?> active<?php } ?>"> <a href="<?php echo base_url(); ?>dashboard"> <i class="fa fa-home"></i> <span class="title"> Dashboard </span> </a> </li>
      <li class="<?php if($this->uri->segment(1) == "leaders"){ ?> active<?php } ?>"> <a href="<?php echo base_url(); ?>leaders"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> <span class="title"> Leaders Management </span> </a></li>
      <li class="<?php if($this->uri->segment(1) == "employees"){ ?> active<?php } ?>"> <a href="<?php echo base_url(); ?>employees"> <i class="fa fa-user-circle" aria-hidden="true"></i> <span class="title"> Employees Management </span> </a></li>
 
     </ul>
  </div>
</div>