<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<h1 class="mb-4">Corporate Social Responsibility</h1>
		<div class="row g-4">
			<?php foreach ($posts as $p): ?>
				<div class="col-md-4">
					<a class="text-decoration-none" href="/csr/<?= e($p['slug']) ?>">
						<div class="card h-100">
							<?php if (!empty($p['cover_image'])): ?><img src="<?= upload_url($p['cover_image']) ?>" class="card-img-top" alt="<?= e($p['title']) ?>"><?php endif; ?>
							<div class="card-body"><h5 class="card-title"><?= e($p['title']) ?></h5><p class="card-text"><?= e($p['excerpt'] ?? '') ?></p></div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>