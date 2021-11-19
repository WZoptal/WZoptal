<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= $master_title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8" />
		<?php include("micro_head.php"); ?>
	</head>
	<?php foreach($this->_ci_view_paths as $key=>$val){ $view_path=$key; } ?>
	<?php $controllername = $this->router->class; ?>
	<body>
		<div class="tm-page-wrap mx-auto">
			<?php include ("micro_banner.php"); ?>
	        <div class="container">
	            <div id="content" class="mx-auto tm-content-container">
	                <?php if(isset($master_body) && $master_body!=""){  ?>
						<?php include($view_path.$controllername."/".$master_body.".php"); ?>
					<?php } ?>
				   <?php include ("micro_footer_link.php"); ?>
	               <?php include ("micro_footer.php"); ?>
	            </div> <!-- tm-content-container -->
	        </div>

    	</div> <!-- .tm-page-wrap -->
      <?php include ("footer.php"); ?>
	</body>
</html>

 