<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<h1 class="mb-3"><?= e($post['title']) ?></h1>
		<?php if (!empty($post['cover_image'])): ?><img class="img-fluid mb-3" src="<?= upload_url($post['cover_image']) ?>" alt="<?= e($post['title']) ?>"><?php endif; ?>
		<div><?= $post['body'] ?></div>
	</div>
</section>
<?php App\Core\View::end(); ?>