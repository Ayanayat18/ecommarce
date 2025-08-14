<?php use App\Core\View; $items = menu('primary'); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= e(settings('site.meta_title', config('app','name','Aurora Holdings'))) ?></title>
	<meta name="description" content="<?= e(settings('site.meta_description','')) ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= asset('css/app.css') ?>" rel="stylesheet">
</head>
<body>
	<header class="sticky-top bg-white shadow-sm">
		<nav class="navbar navbar-expand-lg navbar-light container">
			<a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
				<?php if ($logo = settings('site.logo')): ?><img src="<?= upload_url($logo) ?>" alt="<?= e(settings('site.name', config('app','name'))) ?>" height="28"><?php endif; ?>
				<span><?= e(settings('site.name', config('app','name','Aurora Holdings'))) ?></span>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="nav">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<?php foreach ($items as $it): ?>
						<li class="nav-item"><a class="nav-link" href="<?= e($it['url']) ?>"><?= e($it['title']) ?></a></li>
					<?php endforeach; ?>
				</ul>
				<div class="ms-3">
					<a class="btn btn-sm btn-outline-secondary" href="/lang/en">EN</a>
					<a class="btn btn-sm btn-outline-secondary" href="/lang/bn">BN</a>
				</div>
			</div>
		</nav>
	</header>

	<main>
		<?php View::section('content'); ?>
	</main>

	<footer class="bg-dark text-light mt-5">
		<div class="container py-5">
			<div class="row">
				<div class="col-md-4">
					<h5><?= e(settings('site.name', config('app','name'))) ?></h5>
					<p><?= e(settings('site.tagline','Premium developments and customer-first services across city skylines.')) ?></p>
				</div>
				<div class="col-md-4">
					<h5>Quick Links</h5>
					<ul class="list-unstyled">
						<?php foreach ($items as $it): ?>
							<li><a class="text-decoration-none text-light" href="<?= e($it['url']) ?>"><?= e($it['title']) ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="col-md-4">
					<h5>Contact</h5>
					<p><?= e(settings('site.address','')) ?><br><?= e(settings('site.phone','')) ?><br><?= e(settings('site.email','')) ?></p>
					<h6 class="mt-3">Newsletter</h6>
					<form method="post" action="#" class="d-flex gap-2">
						<input type="email" class="form-control form-control-sm" placeholder="Your email">
						<button class="btn btn-primary btn-sm">Subscribe</button>
					</form>
				</div>
			</div>
			<div class="d-flex justify-content-between mt-4 small">
				<div>&copy; <?= date('Y') ?> <?= e(settings('site.name', config('app','name'))) ?></div>
				<div>
					<a class="text-light me-2" href="#" aria-label="Facebook">FB</a>
					<a class="text-light me-2" href="#" aria-label="LinkedIn">IN</a>
					<a class="text-light" href="#" aria-label="YouTube">YT</a>
				</div>
			</div>
		</div>
	</footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>