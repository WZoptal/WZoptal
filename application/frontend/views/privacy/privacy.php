<div class="container">
	<div class="row">
		<?php if(!empty($privacy)) : ?>
			<div class="col-sm-12">
				<h1 class="heading"><?= $privacy['page_title']; ?></h1>
				<div class="page-content"><?= $privacy['page_content']; ?></div>
			</div>
		<?php endif; ?>
	</div>
</div>
<style type="text/css">
	.page-content ul{padding-left: 20px;}
</style>