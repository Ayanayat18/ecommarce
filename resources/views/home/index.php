<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="position-relative">
	<div id="hero" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
		<div class="carousel-inner">
			<?php foreach ($sliders as $i => $slide): ?>
				<div class="carousel-item <?= $i===0?'active':'' ?>">
					<img src="<?= upload_url($slide['image']) ?>" class="d-block w-100" alt="<?= e($slide['headline']) ?>">
					<div class="carousel-caption">
						<h1 class="display-5 fw-bold mb-3"><?= e($slide['headline']) ?></h1>
						<p class="lead mb-4"><?= e($slide['subtext']) ?></p>
						<?php if (!empty($slide['cta_url'])): ?>
							<a href="<?= e($slide['cta_url']) ?>" class="btn btn-primary btn-lg px-4"><?= e($slide['cta_text'] ?: 'Learn More') ?></a>
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
		<div class="text-center mb-4">
			<h2 class="fw-semibold">Why Choose Us</h2>
			<p class="text-muted">Thoughtful design, great locations, and dependable delivery.</p>
		</div>
		<div class="row g-4">
			<?php foreach ($features as $f): ?>
				<div class="col-12 col-md-6 col-lg-4">
					<div class="card h-100 text-center p-4 reveal">
						<div class="display-6">🏢</div>
						<h5 class="mt-3 mb-1"><?= e($f['title']) ?></h5>
						<p class="text-muted mb-0"><?= e($f['body']) ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="py-5">
	<div class="container">
		<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
			<h2 class="mb-0 fw-semibold">Projects</h2>
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
						<div class="card h-100 reveal">
							<img src="<?= upload_url($p['cover_image']) ?>" class="card-img-top" alt="<?= e($p['title']) ?>">
							<div class="card-body">
								<div class="small text-uppercase text-muted mb-1"><?= e($p['status']) ?> • <?= e($p['city']) ?></div>
								<h5 class="card-title mb-0"><?= e($p['title']) ?></h5>
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
		<div class="text-center mb-4">
			<h2 class="fw-semibold">Testimonials</h2>
			<p class="text-muted">What our customers say</p>
		</div>
		<div id="testimonials" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
			<div class="carousel-inner">
				<?php foreach ($testimonials as $i => $t): ?>
					<div class="carousel-item <?= $i===0?'active':'' ?>">
						<div class="card border-0 shadow-sm mx-auto text-center" style="max-width:720px">
							<div class="card-body p-4">
								<p class="lead mb-3">“<?= e($t['quote']) ?>”</p>
								<div class="fw-semibold"><?= e($t['name']) ?></div>
							</div>
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
		<div class="d-flex flex-wrap justify-content-center align-items-center gap-5 opacity-75">
			<?php foreach ($partners as $b): ?>
				<img src="<?= upload_url($b['logo']) ?>" alt="<?= e($b['name']) ?>" height="36" loading="lazy" style="filter:grayscale(100%);opacity:.8">
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="py-5 text-white" style="background: linear-gradient(90deg, #0A5AC2, #0b5ed7)">
	<div class="container text-center">
		<h3 class="mb-3 fw-semibold">Ready to find your next address?</h3>
		<a href="/projects" class="btn btn-light btn-lg px-4">Explore Projects</a>
	</div>
</section>
<script>
(function(){
	const els = document.querySelectorAll('.reveal');
	const show = () => els.forEach(el=>{ const r = el.getBoundingClientRect(); if (r.top < innerHeight-80) el.classList.add('show'); });
	window.addEventListener('scroll', show, {passive:true}); show();
})();
</script>
<?php App\Core\View::end(); ?>