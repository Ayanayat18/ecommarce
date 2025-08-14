<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="position-relative">
	<div id="hero" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-inner">
			<?php foreach ($sliders as $i => $slide): ?>
				<div class="carousel-item <?= $i===0?'active':'' ?>">
					<img src="<?= upload_url($slide['image']) ?>" class="d-block w-100" alt="<?= e($slide['headline']) ?>">
					<div class="carousel-caption text-start">
						<h1 class="display-5 fw-bold"><?= e($slide['headline']) ?></h1>
						<p class="lead"><?= e($slide['subtext']) ?></p>
						<?php if (!empty($slide['cta_url'])): ?>
							<a href="<?= e($slide['cta_url']) ?>" class="btn btn-primary"><?= e($slide['cta_text'] ?: 'Learn More') ?></a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#hero" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
		<button class="carousel-control-next" type="button" data-bs-target="#hero" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
	</div>
</section>

<section id="why" class="py-5 bg-light">
	<div class="container">
		<h2 class="text-center mb-4">Why Choose Us</h2>
		<div class="row g-4">
			<?php foreach ($features as $f): ?>
				<div class="col-md-4">
					<div class="card h-100 text-center p-3">
						<div class="display-6">🏢</div>
						<h5 class="mt-2"><?= e($f['title']) ?></h5>
						<p class="text-muted"><?= e($f['body']) ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="py-5">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h2 class="mb-0">Projects</h2>
			<div class="btn-group" role="group">
				<a class="btn btn-outline-secondary" href="/projects?status=completed">Completed</a>
				<a class="btn btn-outline-secondary" href="/projects?status=ongoing">Ongoing</a>
				<a class="btn btn-outline-secondary" href="/projects?status=upcoming">Upcoming</a>
			</div>
		</div>
		<div class="row g-4">
			<?php foreach ($projects as $p): ?>
				<div class="col-md-4">
					<a class="text-decoration-none" href="/projects/<?= e($p['slug']) ?>">
						<div class="card h-100">
							<img src="<?= upload_url($p['cover_image']) ?>" class="card-img-top" alt="<?= e($p['title']) ?>">
							<div class="card-body">
								<h5 class="card-title"><?= e($p['title']) ?></h5>
								<div class="small text-muted text-uppercase"><?= e($p['status']) ?> • <?= e($p['city']) ?></div>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="py-5 bg-light">
	<div class="container">
		<h2 class="text-center mb-4">Testimonials</h2>
		<div id="testimonials" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				<?php foreach ($testimonials as $i => $t): ?>
					<div class="carousel-item <?= $i===0?'active':'' ?>">
						<div class="text-center mx-auto" style="max-width:700px">
							<p class="lead">“<?= e($t['quote']) ?>”</p>
							<div class="fw-bold"><?= e($t['name']) ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#testimonials" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
			<button class="carousel-control-next" type="button" data-bs-target="#testimonials" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
		</div>
	</div>
</section>

<section class="py-4 border-top">
	<div class="container">
		<div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
			<?php foreach ($partners as $b): ?>
				<img src="<?= upload_url($b['logo']) ?>" alt="<?= e($b['name']) ?>" height="36" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="py-5 text-white" style="background:#0d6efd">
	<div class="container text-center">
		<h3 class="mb-3">Ready to find your next address?</h3>
		<a href="/projects" class="btn btn-light">Explore Projects</a>
	</div>
</section>
<?php App\Core\View::end(); ?>