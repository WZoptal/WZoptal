<div class="container">
	<div class="row">
		<?php if(!empty($disclaimer)) : ?>
			<div class="col-sm-12">
				<h1 class="heading"><?= $disclaimer['page_title']; ?></h1>
				<div class="page-content"><?= $disclaimer['page_content']; ?></div>
			</div>
		<?php endif; ?>
	</div>
</div>
<style type="text/css">
	.page-content ul{padding-left: 20px;}
</style>