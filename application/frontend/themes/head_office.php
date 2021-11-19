<?php DEFINE("BASEURL", base_url()); ?>
<script type="text/javascript">
	var BASEURL='<?php echo BASEURL;?>';
</script>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>admin/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url(); ?>admin/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>admin/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>admin/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>admin/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>admin/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url(); ?>admin/assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>admin/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>admin/assets/img/favicon.ico"/>
<!-- END THEME STYLES -->

<script type="text/javascript">
function dis_fun(itemname){
	if(confirm("Are you sure you want to disable this "+itemname)){
		return true;
	}
	else{
		return false;	
	}	
}

function enb_fun(itemname){
	if(confirm("Are you sure you want to enable this "+itemname)){
		return true;
	}
	else{
		return false;	
	}	
}
function archive_fun(itemname)
{
	if(confirm("Are you sure you want to archive this "+itemname))
	{
		return true;
	}
	else
	{
		return false;	
	}		
}
</script>
