<?php use App\Core\View; $items = menu('primary'); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= e(settings('site.meta_title', config('app','name','Aurora Holdings'))) ?></title>
	<meta name="description" content="<?= e(settings('site.meta_description','')) ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= asset('vendor/uire/fonts/icomoon/style.css') ?>">
	<link rel="stylesheet" href="<?= asset('vendor/uire/fonts/flaticon/font/flaticon.css') ?>">
	<link rel="stylesheet" href="<?= asset('vendor/uire/css/tiny-slider.css') ?>">
	<link rel="stylesheet" href="<?= asset('vendor/uire/css/aos.css') ?>">
	<link rel="stylesheet" href="<?= asset('vendor/uire/css/style.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/site.css') ?>">
	<link rel="icon" href="<?= asset('images/favicon.png') ?>">
</head>
<body>
	<div id="overlayer"></div>
	<div class="loader"><div class="spinner-border text-primary" role="status"></div></div>
	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close"><span class="js-menu-toggle"></span></div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>
	<nav class="site-nav">
		<div class="container">
			<div class="menu-bg-wrap">
				<div class="site-navigation">
					<a href="/" class="logo m-0 float-start"><?= e(settings('site.name', config('app','name'))) ?></a>
					<ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
						<?php foreach ($items as $it): ?>
							<li><a href="<?= e($it['url']) ?>"><?= e($it['title']) ?></a></li>
						<?php endforeach; ?>
					</ul>
					<a href="#" class="burger light site-menu-toggle js-menu-toggle d-inline-block d-lg-none"><span></span></a>
				</div>
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
	<script src="<?= asset('vendor/uire/js/counter.js') ?>"></script>
	<script src="<?= asset('vendor/uire/js/navbar.js') ?>"></script>
	<script src="<?= asset('vendor/uire/js/custom.js') ?>"></script>
</body>
</html>