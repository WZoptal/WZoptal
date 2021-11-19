<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= $master_title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8" />
		<?php include("head.php"); ?>
	</head>
	<?php foreach($this->_ci_view_paths as $key=>$val){ $view_path=$key; } ?>
	<?php $controllername = $this->router->class; ?>
	<body>
		<?php include("home_header.php");?>
		<?php if(isset($master_body) && $master_body!=""){?>
			<?php include($view_path.$controllername."/".$master_body.".php"); ?>
		<?php } ?>
		<?php include ("home_footer.php"); ?>
		<?php include ("footer_head.php"); ?>
	</body>
</html>

