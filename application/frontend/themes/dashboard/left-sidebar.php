<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse"> 
		<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
			<li class="sidebar-toggler-wrapper"> 
				<div class="sidebar-toggler hidden-phone"> </div>
			</li>
			<li class="sidebar-search-wrapper"><br /></li>
			<li class="start <?php if($this->uri->segment(1) == "dashboard"){ ?> active<?php } ?>"> <a href="<?php echo base_url(); ?>"> <i class="fa fa-home"></i> <span class="title"> Dashboard </span> </a> </li>
			<li class="<?php if($this->uri->segment(1) == "users"){ ?> active<?php } ?>"> <a href="<?= base_url(); ?>users"> <i class="fa fa-users"></i> <span class="title"> User Management </span> </a></li>
			<li <?php if($this->uri->segment(1) == "content"){ ?> class="active"<?php } ?>> <a href="javascript:void(0);"> <i class="fa fa-files-o"></i> <span class="title"> Content Management </span> <span class="arrow"> </span> </a>
				<ul class="sub-menu">
					<li <?php if($this->uri->segment(2) == "appinfo"){ ?> class="active"<?php } ?>> <a href="<?= base_url(); ?>content/appinfo"> <i class="fa fa-info-circle"></i> App Information</a> </li>
					<li <?php if($this->uri->segment(2) == "terms"){ ?> class="active"<?php } ?>> <a href="<?= base_url(); ?>content/terms"> <i class="fa fa-gavel"></i> Term & Condition</a> </li>
					<li <?php if($this->uri->segment(2) == "disclaimer"){ ?> class="active"<?php } ?>> <a href="<?= base_url(); ?>content/disclaimer"><i class="fa fa-file-text-o"></i> Disclaimer</a> </li>
				</ul>
			</li>
		</ul>
	</div>
</div>
