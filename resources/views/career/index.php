<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_1.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up">Careers</h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page">Careers</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<?php foreach ($jobs as $job): ?>
				<div class="col-md-6 mb-4">
					<div class="property-item mb-30">
						<div class="property-content">
							<div class="mb-2 text-black-50 small"><?= e($job['dept']) ?> • <?= e($job['location']) ?> • <?= e($job['type']) ?></div>
							<h5 class="mb-2 text-dark"><a class="text-decoration-none" href="/career/<?= e($job['slug']) ?>"><?= e($job['title']) ?></a></h5>
							<p class="text-black-50 mb-3"><?= e($job['excerpt'] ?? '') ?></p>
							<a class="btn btn-primary py-2 px-3" href="/career/<?= e($job['slug']) ?>">View</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>