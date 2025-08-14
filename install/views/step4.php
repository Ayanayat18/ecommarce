<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><title>Install - Step 4</title></head>
<body class="bg-light">
	<div class="container py-5">
		<h1 class="h4 mb-4">Installation - Step 4: Create Admin</h1>
		<?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
		<form method="post" class="row g-3">
			<div class="col-md-4"><label class="form-label">Name</label><input class="form-control" name="name"></div>
			<div class="col-md-4"><label class="form-label">Email</label><input class="form-control" type="email" name="email"></div>
			<div class="col-md-4"><label class="form-label">Password</label><input class="form-control" type="password" name="password"></div>
			<div class="col-12"><button class="btn btn-primary">Finish Installation</button></div>
		</form>
	</div>
</body></html>