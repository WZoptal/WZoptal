<div class="container">
	<div class="row">
		<?php if(!empty($terms)) : ?>
			<div class="col-sm-12">
				<h1 class="heading"><?= $terms['page_title']; ?></h1>
				<div class="page-content"><?= $terms['page_content']; ?></div>
			</div>
		<?php endif; ?>
	</div>
</div>
<style type="text/css">
	.page-content ul{padding-left: 20px;}
</style>