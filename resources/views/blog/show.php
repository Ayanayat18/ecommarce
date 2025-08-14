<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<article class="mb-5">
			<h1 class="mb-3"><?= e($post['title']) ?></h1>
			<p class="text-muted small">Published <?= date('M d, Y', strtotime($post['published_at'])) ?></p>
			<?php if (!empty($post['cover_image'])): ?>
				<img class="img-fluid mb-3" src="<?= upload_url($post['cover_image']) ?>" alt="<?= e($post['title']) ?>">
			<?php endif; ?>
			<div><?= $post['body'] ?></div>
		</article>
		<h3 class="mb-3">Related</h3>
		<div class="row g-4">
			<?php foreach ($relatedPosts as $r): ?>
				<div class="col-md-4"><a href="/blog/<?= e($r['slug']) ?>" class="text-decoration-none"><div class="card h-100"><div class="card-body"><h5 class="card-title"><?= e($r['title']) ?></h5></div></div></a></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>