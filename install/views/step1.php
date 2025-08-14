<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><title>Install - Step 1</title></head>
<body class="bg-light">
	<div class="container py-5">
		<h1 class="h4 mb-4">Installation - Step 1: Requirements</h1>
		<table class="table table-bordered w-auto">
			<tr><th>Extension</th><th>Status</th></tr>
			<?php foreach ($results as $name => $ok): ?>
			<tr><td><?= htmlspecialchars($name) ?></td><td><?= $ok?'<span class="text-success">Enabled</span>':'<span class="text-danger">Missing</span>' ?></td></tr>
			<?php endforeach; ?>
		</table>
		<a class="btn btn-primary" href="?step=2" <?= in_array(false, $results, true)?'disabled':'' ?>>Continue</a>
	</div>
</body></html>