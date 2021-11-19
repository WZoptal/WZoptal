<div class="container">
	<div class="row">
		<?php if(!empty($pages)) : ?>
			<?php foreach($pages as $page) : ?>
				<div class="col-sm-12">
					<h1 class="heading"><?= $page['page_title']; ?></h1>
					<div class="page-content"><?= $page['page_content']; ?></div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div class="row">
		<?php if(!empty($contactus)) : ?>
			<div class="col-sm-12">
				<h1 class="heading">Contact us/Admin</h1>
				<div class="page-content">
					<?php if(!empty($contactus['contact_email'])) : ?> 
						<p><i class="fa fa-envelope-o"></i> <?= $contactus['contact_email']; ?></p>
					<?php endif; ?>
					<?php if(!empty($contactus['city'])) : ?> 
						<p><i class="fa fa-building"></i> <?= $contactus['city']; ?></p>
					<?php endif; ?>
					<?php if(!empty($contactus['state'])) : ?>
						<p><i class="fa fa-flag-o"></i> <?= $contactus['state']; ?></p>
					<?php endif; ?>
					<?php if(!empty($contactus['contact_number'])) : ?> 
						<p><i class="fa fa-phone"></i><?= $contactus['contact_number']; ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<style type="text/css">
	.page-content ul{padding-left: 20px;}
</style>