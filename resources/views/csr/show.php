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
						<li class="breadcrumb-item"><a href="/csr">CSR</a></li>
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
				<?php if (!empty($post['cover_image'])): ?><img class="img-fluid mb-4 rounded" src="<?= upload_url($post['cover_image']) ?>" alt="<?= e($post['title']) ?>"><?php endif; ?>
				<div><?= $post['body'] ?></div>
			</div>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>