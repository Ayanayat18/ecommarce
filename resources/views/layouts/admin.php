<?php use App\Core\View; use App\Core\Auth; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin - <?= e(config('app','name','Aurora Holdings')) ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= asset('css/admin.css') ?>" rel="stylesheet">
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
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
					<li class="list-group-item"><a href="/admin/resource/sliders">Sliders</a></li>
					<li class="list-group-item"><a href="/admin/resource/features">Features</a></li>
					<li class="list-group-item"><a href="/admin/resource/partners">Partners</a></li>
					<li class="list-group-item"><a href="/admin/resource/pages">Pages</a></li>
					<li class="list-group-item"><a href="/admin/resource/projects">Projects</a></li>
					<li class="list-group-item"><a href="/admin/resource/project_gallery">Project Gallery</a></li>
					<li class="list-group-item"><a href="/admin/resource/units">Units</a></li>
					<li class="list-group-item"><a href="/admin/resource/testimonials">Testimonials</a></li>
					<li class="list-group-item"><a href="/admin/resource/team">Team</a></li>
					<li class="list-group-item"><a href="/admin/resource/posts">Blog</a></li>
					<li class="list-group-item"><a href="/admin/resource/categories">Categories</a></li>
					<li class="list-group-item"><a href="/admin/resource/tags">Tags</a></li>
					<li class="list-group-item"><a href="/admin/resource/csr_posts">CSR Posts</a></li>
					<li class="list-group-item"><a href="/admin/resource/jobs">Jobs</a></li>
					<li class="list-group-item"><a href="/admin/resource/applications">Applications</a></li>
					<li class="list-group-item"><a href="/admin/resource/enquiries">Enquiries</a></li>
					<li class="list-group-item"><a href="/admin/resource/menus">Menus</a></li>
					<li class="list-group-item"><a href="/admin/resource/menu_items">Menu Items</a></li>
					<li class="list-group-item"><a href="/admin/resource/users">Users & Roles</a></li>
				</ul>
			</aside>
			<main class="col-md-10 p-4">
				<?php View::section('content'); ?>
			</main>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded',function(){
			if (document.querySelector('.wysiwyg')) {
				tinymce.init({ selector: '.wysiwyg', height: 360, menubar: false, plugins: 'link lists code image table', toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code' });
			}
		});
	</script>
</body>
</html>