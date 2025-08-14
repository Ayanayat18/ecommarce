<?php use App\Core\View; $items = menu('primary'); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= e(settings('site.meta_title', config('app','name','Aurora Holdings'))) ?></title>
	<meta name="description" content="<?= e(settings('site.meta_description','')) ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="<?= asset('css/app.css') ?>" rel="stylesheet">
</head>
<body class="theme-aurora">
	<div class="topbar small d-none d-lg-block">
		<div class="container d-flex justify-content-between py-1">
			<div class="text-muted">
				<i class="bi bi-geo-alt me-1"></i><?= e(settings('site.address','123 Skyline Avenue, Dhaka')) ?>
				<span class="mx-2">|</span>
				<i class="bi bi-telephone me-1"></i><?= e(settings('site.phone','+880 1234 567 890')) ?>
				<span class="mx-2">|</span>
				<i class="bi bi-envelope me-1"></i><?= e(settings('site.email','hello@example.com')) ?>
			</div>
			<div class="d-flex gap-3">
				<a class="text-decoration-none text-muted" href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
				<a class="text-decoration-none text-muted" href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
				<a class="text-decoration-none text-muted" href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
			</div>
		</div>
	</div>
	<header class="header shadow-sm">
		<nav class="navbar navbar-expand-lg navbar-light container py-2">
			<a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
				<?php if ($logo = settings('site.logo')): ?><img src="<?= upload_url($logo) ?>" alt="<?= e(settings('site.name', config('app','name'))) ?>" height="32"><?php endif; ?>
				<span><?= e(settings('site.name', config('app','name','Aurora Holdings'))) ?></span>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="nav">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
					<?php foreach ($items as $it): ?>
						<li class="nav-item"><a class="nav-link px-3" href="<?= e($it['url']) ?>"><?= e($it['title']) ?></a></li>
					<?php endforeach; ?>
					<li class="nav-item ms-lg-3 d-none d-lg-block"><a class="btn btn-primary btn-sm" href="/contact">Get in touch</a></li>
				</ul>
				<div class="ms-3 d-lg-none">
					<a class="btn btn-sm btn-outline-secondary" href="/lang/en">EN</a>
					<a class="btn btn-sm btn-outline-secondary" href="/lang/bn">BN</a>
				</div>
			</div>
		</nav>
	</header>

	<main>
		<?php View::section('content'); ?>
	</main>

	<footer class="footer mt-5">
		<div class="container py-5">
			<div class="row gy-4">
				<div class="col-md-4">
					<h5 class="mb-3 text-white"><?= e(settings('site.name', config('app','name'))) ?></h5>
					<p class="text-white-50 mb-3"><?= e(settings('site.tagline','Premium developments and customer-first services across city skylines.')) ?></p>
					<div class="d-flex gap-3">
						<a class="text-decoration-none text-white-50" href="#" aria-label="Facebook"><i class="bi bi-facebook fs-5"></i></a>
						<a class="text-decoration-none text-white-50" href="#" aria-label="LinkedIn"><i class="bi bi-linkedin fs-5"></i></a>
						<a class="text-decoration-none text-white-50" href="#" aria-label="YouTube"><i class="bi bi-youtube fs-5"></i></a>
					</div>
				</div>
				<div class="col-md-4">
					<h6 class="text-white mb-3">Quick Links</h6>
					<ul class="list-unstyled mb-0">
						<?php foreach ($items as $it): ?>
							<li class="mb-2"><a class="text-decoration-none text-white-50" href="<?= e($it['url']) ?>"><?= e($it['title']) ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="col-md-4">
					<h6 class="text-white mb-3">Contact</h6>
					<p class="text-white-50 mb-1"><i class="bi bi-geo-alt me-2"></i><?= e(settings('site.address','')) ?></p>
					<p class="text-white-50 mb-1"><i class="bi bi-telephone me-2"></i><?= e(settings('site.phone','')) ?></p>
					<p class="text-white-50 mb-3"><i class="bi bi-envelope me-2"></i><?= e(settings('site.email','')) ?></p>
					<form method="post" action="#" class="d-flex gap-2">
						<input type="email" class="form-control form-control-sm" placeholder="Your email">
						<button class="btn btn-primary btn-sm">Subscribe</button>
					</form>
				</div>
			</div>
			<hr class="border-white-10 mt-4">
			<div class="d-flex justify-content-between mt-3 small text-white-50">
				<div>&copy; <?= date('Y') ?> <?= e(settings('site.name', config('app','name'))) ?>. All rights reserved.</div>
				<div>
					<a class="text-white-50 me-3" href="#">Privacy</a>
					<a class="text-white-50" href="#">Terms</a>
				</div>
			</div>
		</div>
	</footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>