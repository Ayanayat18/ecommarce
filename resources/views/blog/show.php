<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_2.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up"><?= e($post['title']) ?></h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item"><a href="/blog">Blog</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page"><?= e($post['title']) ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<article class="mb-5">
					<p class="text-black-50 small">Published <?= date('M d, Y', strtotime($post['published_at'])) ?></p>
					<?php if (!empty($post['cover_image'])): ?>
						<img class="img-fluid mb-3 rounded" src="<?= upload_url($post['cover_image']) ?>" alt="<?= e($post['title']) ?>">
					<?php endif; ?>
					<div><?= $post['body'] ?></div>
				</article>
				<h3 class="mb-3">Related</h3>
				<div class="row">
					<?php foreach ($relatedPosts as $r): ?>
						<div class="col-md-4 mb-4">
							<a href="/blog/<?= e($r['slug']) ?>" class="text-decoration-none">
								<div class="property-item mb-30">
									<div class="property-content"><h6 class="mb-1 text-dark"><?= e($r['title']) ?></h6></div>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>