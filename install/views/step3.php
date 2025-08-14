<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><title>Install - Step 3</title></head>
<body class="bg-light">
	<div class="container py-5">
		<h1 class="h4 mb-4">Installation - Step 3: Database Migration</h1>
		<?php if (!empty($error)): ?>
			<div class="alert alert-danger">Error: <?= htmlspecialchars($error) ?></div>
			<a class="btn btn-secondary" href="?step=3">Retry</a>
		<?php else: ?>
			<div class="alert alert-success">Database schema and seeds executed successfully.</div>
			<a class="btn btn-primary" href="?step=4">Continue</a>
		<?php endif; ?>
	</div>
</body></html>