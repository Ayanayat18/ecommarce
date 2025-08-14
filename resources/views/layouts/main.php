<?php use App\Core\View; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= e(config('app','name','Aurora Holdings')) ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= asset('css/app.css') ?>" rel="stylesheet">
</head>
<body>
	<header class="sticky-top bg-white shadow-sm">
		<nav class="navbar navbar-expand-lg navbar-light container">
			<a class="navbar-brand fw-bold" href="/"><?= e(config('app','name','Aurora Holdings')) ?></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="nav">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item"><a class="nav-link" href="/">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="/about">About</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Projects</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="/projects?status=completed">Completed</a></li>
							<li><a class="dropdown-item" href="/projects?status=ongoing">Ongoing</a></li>
							<li><a class="dropdown-item" href="/projects?status=upcoming">Upcoming</a></li>
						</ul>
					</li>
					<li class="nav-item"><a class="nav-link" href="/csr">CSR</a></li>
					<li class="nav-item"><a class="nav-link" href="/career">Career</a></li>
					<li class="nav-item"><a class="nav-link" href="/blog">Blog/News</a></li>
					<li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
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
					<h5>About</h5>
					<p>Premium developments and customer-first services across city skylines.</p>
				</div>
				<div class="col-md-4">
					<h5>Quick Links</h5>
					<ul class="list-unstyled">
						<li><a class="text-decoration-none text-light" href="/projects">Projects</a></li>
						<li><a class="text-decoration-none text-light" href="/career">Career</a></li>
						<li><a class="text-decoration-none text-light" href="/blog">Blog</a></li>
						<li><a class="text-decoration-none text-light" href="/contact">Contact</a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<h5>Newsletter</h5>
					<form method="post" action="#" class="d-flex gap-2">
						<input type="email" class="form-control form-control-sm" placeholder="Your email">
						<button class="btn btn-primary btn-sm">Subscribe</button>
					</form>
				</div>
			</div>
			<div class="d-flex justify-content-between mt-4 small">
				<div>&copy; <?= date('Y') ?> <?= e(config('app','name','Aurora Holdings')) ?></div>
				<div>
					<a class="text-light me-2" href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
					<a class="text-light me-2" href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
					<a class="text-light" href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
				</div>
			</div>
		</div>
	</footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>