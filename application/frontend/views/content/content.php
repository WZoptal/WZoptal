<div class="container">
	<div class="row">
		<?php if(!empty($support)) : ?>
			<div class="col-sm-12">
				<h1 class="heading"><?= $support['page_title']; ?></h1>
				<div class="page-content"><?= $support['page_content']; ?></div>
			</div>
		<?php endif; ?>
	</div>
</div>

<style type="text/css">
	.page-content ul{padding-left: 20px;}
</style>