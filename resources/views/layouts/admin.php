<?php use App\Core\View; use App\Core\Auth; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin - <?= e(config('app','name','Aurora Holdings')) ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= asset('css/admin.css') ?>" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="/admin">Admin</a>
			<form method="post" action="/admin/logout" class="d-flex align-items-center">
				<?= csrf_field() ?>
				<span class="text-light me-3 small"><?= e(Auth::user()['email'] ?? '') ?></span>
				<button class="btn btn-sm btn-outline-light">Logout</button>
			</form>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<aside class="col-md-2 bg-light border-end min-vh-100 p-0">
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><a href="/admin">Dashboard</a></li>
					<li class="list-group-item"><a href="#">Sliders</a></li>
					<li class="list-group-item"><a href="#">Pages</a></li>
					<li class="list-group-item"><a href="#">Projects</a></li>
					<li class="list-group-item"><a href="#">Blog</a></li>
					<li class="list-group-item"><a href="#">CSR</a></li>
					<li class="list-group-item"><a href="#">Team</a></li>
					<li class="list-group-item"><a href="#">Testimonials</a></li>
					<li class="list-group-item"><a href="#">Careers</a></li>
					<li class="list-group-item"><a href="#">Applications</a></li>
					<li class="list-group-item"><a href="#">Enquiries</a></li>
					<li class="list-group-item"><a href="#">Media</a></li>
					<li class="list-group-item"><a href="#">Menus</a></li>
					<li class="list-group-item"><a href="#">Settings</a></li>
					<li class="list-group-item"><a href="#">Users & Roles</a></li>
				</ul>
			</aside>
			<main class="col-md-10 p-4">
				<?php View::section('content'); ?>
			</main>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>