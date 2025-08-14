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
	<div class="admin-wrapper">
		<aside class="admin-sidebar">
			<div class="admin-brand">
				<div class="logo">AH</div>
				<div class="title">Admin</div>
			</div>
			<nav class="admin-nav">
				<a href="/admin" class="<?= $_SERVER['REQUEST_URI']==='/admin'?'active':'' ?>"><span class="icon">🏠</span> <span>Dashboard</span></a>
				<a href="/admin/resource/sliders"><span class="icon">🖼️</span> <span>Sliders</span></a>
				<a href="/admin/resource/features"><span class="icon">✨</span> <span>Features</span></a>
				<a href="/admin/resource/partners"><span class="icon">🤝</span> <span>Partners</span></a>
				<a href="/admin/resource/pages"><span class="icon">📄</span> <span>Pages</span></a>
				<a href="/admin/resource/projects"><span class="icon">🏗️</span> <span>Projects</span></a>
				<a href="/admin/resource/project_gallery"><span class="icon">🖼️</span> <span>Project Gallery</span></a>
				<a href="/admin/resource/units"><span class="icon">📦</span> <span>Units</span></a>
				<a href="/admin/resource/testimonials"><span class="icon">💬</span> <span>Testimonials</span></a>
				<a href="/admin/resource/team"><span class="icon">👥</span> <span>Team</span></a>
				<a href="/admin/resource/posts"><span class="icon">📰</span> <span>Blog</span></a>
				<a href="/admin/resource/categories"><span class="icon">🏷️</span> <span>Categories</span></a>
				<a href="/admin/resource/tags"><span class="icon">🔖</span> <span>Tags</span></a>
				<a href="/admin/resource/csr_posts"><span class="icon">🌍</span> <span>CSR Posts</span></a>
				<a href="/admin/resource/jobs"><span class="icon">💼</span> <span>Jobs</span></a>
				<a href="/admin/resource/applications"><span class="icon">📥</span> <span>Applications</span></a>
				<a href="/admin/resource/enquiries"><span class="icon">📧</span> <span>Enquiries</span></a>
				<a href="/admin/resource/menus"><span class="icon">📚</span> <span>Menus</span></a>
				<a href="/admin/resource/menu_items"><span class="icon">🔗</span> <span>Menu Items</span></a>
				<a href="/admin/resource/users"><span class="icon">👤</span> <span>Users & Roles</span></a>
			</nav>
		</aside>
		<main class="admin-main">
			<header class="admin-header">
				<form class="admin-search">
					<input class="form-control" placeholder="Search in admin...">
				</form>
				<form method="post" action="/admin/logout" class="d-flex align-items-center gap-2 m-0">
					<?= csrf_field() ?>
					<span class="text-muted small"><?= e(Auth::user()['email'] ?? '') ?></span>
					<button class="btn btn-sm btn-outline-secondary">Logout</button>
				</form>
			</header>
			<section class="admin-content">
				<?php View::section('content'); ?>
			</section>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>