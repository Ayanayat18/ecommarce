<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_2.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up"><?= e($sliders[0]['headline'] ?? settings('site.name','Aurora Holdings')) ?></h1>
				<p class="lead text-white-50" data-aos="fade-up" data-aos-delay="150"><?= e($sliders[0]['subtext'] ?? 'Premium developments crafted with care and precision.') ?></p>
				<p data-aos="fade-up" data-aos-delay="300">
					<a href="/projects" class="btn btn-primary py-2 px-4">Explore Projects</a>
					<a href="/contact" class="btn btn-outline-light py-2 px-4">Contact Us</a>
				</p>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row mb-5 align-items-center">
			<div class="col-lg-6 text-center mx-auto">
				<h2 class="font-weight-bold text-primary heading">Why Choose Us</h2>
				<p class="text-muted">Thoughtful design, dependable delivery, and lasting value.</p>
			</div>
		</div>
		<div class="row g-4">
			<?php foreach (array_slice($features, 0, 6) as $f): ?>
				<div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">
					<div class="p-4 bg-white rounded-3 shadow-sm h-100">
						<div class="mb-3"><span class="icon-home2 text-primary" style="font-size:28px"></span></div>
						<h5 class="mb-1"><?= e($f['title']) ?></h5>
						<p class="text-muted mb-0"><?= e($f['body']) ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row mb-4 align-items-center">
			<div class="col-lg-6">
				<h2 class="font-weight-bold text-primary heading mb-0">Featured Properties</h2>
			</div>
			<div class="col-lg-6 text-lg-end"><a href="/projects" class="btn btn-outline-primary">View All</a></div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="property-slider-wrap" data-aos="fade-up">
					<div class="property-slider">
						<?php foreach (array_slice($projects, 0, 8) as $p): ?>
							<div class="property-item">
								<a href="/projects/<?= e($p['slug']) ?>" class="img">
									<img src="<?= upload_url($p['cover_image']) ?>" alt="<?= e($p['title']) ?>" class="img-fluid" />
								</a>
								<div class="property-content">
									<div class="price mb-2"><span><?= e($p['price_label'] ?? '') ?></span></div>
									<div>
										<span class="d-block mb-2 text-black-50"><?= e($p['address'] ?? '') ?></span>
										<span class="city d-block mb-3"><?= e($p['city']) ?></span>
										<div class="specs d-flex mb-4">
											<span class="d-block d-flex align-items-center me-3"><span class="icon-bed me-2"></span><span class="caption"><?= e($p['bedrooms'] ?? '') ?> beds</span></span>
											<span class="d-block d-flex align-items-center"><span class="icon-bath me-2"></span><span class="caption"><?= e($p['baths'] ?? '') ?> baths</span></span>
										</div>
										<a href="/projects/<?= e($p['slug']) ?>" class="btn btn-primary py-2 px-3">See details</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
						<span class="prev" data-controls="prev">Prev</span>
						<span class="next" data-controls="next">Next</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section bg-light">
	<div class="container">
		<div class="row mb-5 align-items-center">
			<div class="col-lg-6 text-center mx-auto">
				<h2 class="font-weight-bold text-primary heading">Testimonials</h2>
				<p class="text-muted">What our customers say</p>
			</div>
		</div>
		<div class="row g-4">
			<?php foreach (array_slice($testimonials, 0, 3) as $t): ?>
				<div class="col-md-4" data-aos="fade-up">
					<div class="p-4 bg-white rounded-3 shadow-sm h-100">
						<p class="mb-3">“<?= e($t['quote']) ?>”</p>
						<div class="d-flex align-items-center">
							<img src="<?= upload_url($t['photo'] ?? 'placeholders/t1.jpg') ?>" class="rounded-circle me-3" width="48" height="48" alt="<?= e($t['name']) ?>">
							<div class="fw-semibold"><?= e($t['name']) ?></div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<div class="section pt-0">
	<div class="container">
		<div class="row justify-content-center align-items-center bg-primary text-white rounded-3 p-5" data-aos="fade-up">
			<div class="col-lg-8 text-center">
				<h3 class="mb-3">Ready to find your next address?</h3>
				<a href="/projects" class="btn btn-light py-2 px-4">Browse Projects</a>
			</div>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>