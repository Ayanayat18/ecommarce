<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h1 class="mb-0">Blog</h1>
			<form method="get" class="d-flex" action="/blog">
				<input class="form-control me-2" name="q" placeholder="Search" value="<?= e($search ?? '') ?>">
				<button class="btn btn-outline-secondary">Search</button>
			</form>
		</div>
		<div class="row g-4">
			<?php foreach ($posts as $post): ?>
				<div class="col-md-4">
					<a class="text-decoration-none" href="/blog/<?= e($post['slug']) ?>">
						<div class="card h-100">
							<?php if (!empty($post['cover_image'])): ?>
								<img src="<?= upload_url($post['cover_image']) ?>" class="card-img-top" alt="<?= e($post['title']) ?>">
							<?php endif; ?>
							<div class="card-body">
								<h5 class="card-title"><?= e($post['title']) ?></h5>
								<p class="text-muted small mb-2"><?= date('M d, Y', strtotime($post['published_at'])) ?></p>
								<p class="card-text"><?= e($post['excerpt'] ?? '') ?></p>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>