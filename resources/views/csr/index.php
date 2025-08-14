<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_1.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up">CSR</h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page">CSR</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<?php foreach ($posts as $p): ?>
				<div class="col-md-4 mb-4">
					<a class="text-decoration-none" href="/csr/<?= e($p['slug']) ?>">
						<div class="property-item mb-30">
							<?php if (!empty($p['cover_image'])): ?><div class="img"><img src="<?= upload_url($p['cover_image']) ?>" class="img-fluid" alt="<?= e($p['title']) ?>"></div><?php endif; ?>
							<div class="property-content"><h5 class="mb-1 text-dark"><?= e($p['title']) ?></h5><p class="text-black-50 mb-0"><?= e($p['excerpt'] ?? '') ?></p></div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>