<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<h1 class="mb-4">Careers</h1>
		<div class="row g-4">
			<?php foreach ($jobs as $job): ?>
				<div class="col-md-6">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title"><a href="/career/<?= e($job['slug']) ?>" class="text-decoration-none"><?= e($job['title']) ?></a></h5>
							<div class="text-muted small mb-2"><?= e($job['dept']) ?> • <?= e($job['location']) ?> • <?= e($job['type']) ?></div>
							<p class="card-text"><?= e($job['excerpt'] ?? '') ?></p>
							<a class="btn btn-outline-primary btn-sm" href="/career/<?= e($job['slug']) ?>">View</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>