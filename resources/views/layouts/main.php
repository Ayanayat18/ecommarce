<?php use App\Core\View; $items = menu('primary'); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= e(settings('site.meta_title', config('app','name','Aurora Holdings'))) ?></title>
	<meta name="description" content="<?= e(settings('site.meta_description','')) ?>">
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= asset('vendor/uire/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?= asset('vendor/uire/css/aos.css') ?>">
	<link rel="stylesheet" href="<?= asset('vendor/uire/css/tiny-slider.css') ?>">
	<link rel="stylesheet" href="<?= asset('vendor/uire/css/style.css') ?>">
	<link rel="icon" href="<?= asset('images/favicon.png') ?>">
</head>
<body>
	<!-- Top bar -->
	<div class="header-top">
		<div class="container">
			<div class="d-flex justify-content-between py-1 small text-white">
				<div><i class="bi bi-geo-alt me-1"></i><?= e(settings('site.address','')) ?> | <i class="bi bi-telephone me-1"></i><?= e(settings('site.phone','')) ?> | <i class="bi bi-envelope me-1"></i><?= e(settings('site.email','')) ?></div>
				<div class="d-none d-md-block">
					<a class="text-white-50 me-3" href="#">Facebook</a>
					<a class="text-white-50 me-3" href="#">LinkedIn</a>
					<a class="text-white-50" href="#">YouTube</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Navbar -->
	<nav class="site-nav">
		<div class="container">
			<div class="site-navigation">
				<a href="/" class="logo m-0"><?= e(settings('site.name', config('app','name'))) ?><span class="text-primary">.</span></a>
				<ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
					<?php foreach ($items as $it): ?>
						<li><a href="<?= e($it['url']) ?>"><?= e($it['title']) ?></a></li>
					<?php endforeach; ?>
				</ul>
				<a href="#" class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
					<span></span>
				</a>
			</div>
		</div>
	</nav>

	<?php View::section('content'); ?>

	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<h3><?= e(settings('site.name', config('app','name'))) ?></h3>
					<p><?= e(settings('site.tagline','Premium developments and customer-first services across city skylines.')) ?></p>
				</div>
				<div class="col-lg-4">
					<div class="row links-wrap">
						<div class="col-6">
							<ul class="list-unstyled">
								<?php foreach ($items as $it): ?>
									<li><a href="<?= e($it['url']) ?>"><?= e($it['title']) ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="col-6">
							<ul class="list-unstyled">
								<li><a href="#">Privacy</a></li>
								<li><a href="#">Terms</a></li>
								<li><a href="#">Sitemap</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<h3>Subscribe</h3>
					<p>Get updates about new launches and news.</p>
					<form class="form-subscribe" action="#" onsubmit="this.reset(); return false;">
						<div class="form-group d-flex">
							<input type="email" class="form-control" placeholder="Email">
							<input type="submit" class="btn btn-primary" value="Subscribe">
						</div>
					</form>
				</div>
			</div>
			<div class="border-top mt-4 pt-4 d-flex justify-content-between small">
				<div>&copy; <?= date('Y') ?> <?= e(settings('site.name', config('app','name'))) ?></div>
				<div class="d-flex gap-3">
					<a href="/rss.xml" class="text-muted">RSS</a>
					<a href="/sitemap.xml" class="text-muted">Sitemap</a>
				</div>
			</div>
		</div>
	</footer>
	<script src="<?= asset('vendor/uire/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= asset('vendor/uire/js/tiny-slider.js') ?>"></script>
	<script src="<?= asset('vendor/uire/js/aos.js') ?>"></script>
	<script src="<?= asset('vendor/uire/js/navbar.js') ?>"></script>
	<script src="<?= asset('vendor/uire/js/custom.js') ?>"></script>
</body>
</html>