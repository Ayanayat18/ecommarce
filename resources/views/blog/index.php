<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_1.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up">News & Insights</h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page">Blog</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row mb-4 align-items-center">
			<div class="col-lg-8"><h2 class="font-weight-bold text-primary heading mb-0">Latest Articles</h2></div>
			<div class="col-lg-4">
				<form method="get" action="/blog" class="d-flex">
					<input class="form-control me-2" name="q" placeholder="Search" value="<?= e($search ?? '') ?>">
					<button class="btn btn-primary">Search</button>
				</form>
			</div>
		</div>
		<div class="row">
			<?php foreach ($posts as $post): ?>
				<div class="col-md-4 mb-4">
					<a class="text-decoration-none" href="/blog/<?= e($post['slug']) ?>">
						<div class="property-item mb-30">
							<?php if (!empty($post['cover_image'])): ?>
								<div class="img"><img src="<?= upload_url($post['cover_image']) ?>" alt="<?= e($post['title']) ?>" class="img-fluid" /></div>
							<?php endif; ?>
							<div class="property-content">
								<div class="mb-2 text-black-50 small"><?= date('M d, Y', strtotime($post['published_at'])) ?></div>
								<h5 class="mb-1 text-dark"><?= e($post['title']) ?></h5>
								<p class="text-black-50 mb-0"><?= e($post['excerpt'] ?? '') ?></p>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>