<?php App\Core\View::extend('admin'); ?>
<?php App\Core\View::start('content'); ?>
<h1 class="h4 mb-4">Dashboard</h1>
<div class="row g-3">
	<div class="col-md-3"><div class="card text-center"><div class="card-body"><div class="text-muted">Projects</div><div class="display-6"><?= (int)$kpis['projects'] ?></div></div></div></div>
	<div class="col-md-3"><div class="card text-center"><div class="card-body"><div class="text-muted">Leads</div><div class="display-6"><?= (int)$kpis['leads'] ?></div></div></div></div>
	<div class="col-md-3"><div class="card text-center"><div class="card-body"><div class="text-muted">Applications</div><div class="display-6"><?= (int)$kpis['applications'] ?></div></div></div></div>
	<div class="col-md-3"><div class="card text-center"><div class="card-body"><div class="text-muted">Posts</div><div class="display-6"><?= (int)$kpis['posts'] ?></div></div></div></div>
</div>
<div class="row mt-4">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">Latest Enquiries</div>
			<ul class="list-group list-group-flush">
				<?php foreach ($latestEnquiries as $e): ?>
					<li class="list-group-item d-flex justify-content-between"><span><?= e($e['name']) ?> (<?= e($e['topic']) ?>)</span><span class="text-muted small"><?= e(date('M d', strtotime($e['created_at']))) ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">Recent Posts</div>
			<ul class="list-group list-group-flush">
				<?php foreach ($recentPosts as $p): ?>
					<li class="list-group-item d-flex justify-content-between"><span><?= e($p['title']) ?></span><span class="text-muted small"><?= e(date('M d', strtotime($p['created_at']))) ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>