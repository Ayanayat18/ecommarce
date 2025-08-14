<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<h1 class="mb-4">Projects</h1>
		<form method="get" class="row g-3 mb-4">
			<div class="col-md-3">
				<select name="status" class="form-select">
					<option value="">Status</option>
					<?php foreach (['completed','ongoing','upcoming'] as $s): ?>
						<option value="<?= $s ?>" <?= ($_GET['status'] ?? '')===$s?'selected':'' ?>><?= ucfirst($s) ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-md-3"><input class="form-control" name="city" placeholder="City" value="<?= e($_GET['city'] ?? '') ?>"></div>
			<div class="col-md-3"><input class="form-control" name="bedrooms" placeholder="Bedrooms" value="<?= e($_GET['bedrooms'] ?? '') ?>"></div>
			<div class="col-md-3"><button class="btn btn-primary w-100">Filter</button></div>
		</form>
		<div class="row g-4">
			<?php foreach ($projects as $p): ?>
				<div class="col-md-4">
					<a class="text-decoration-none" href="/projects/<?= e($p['slug']) ?>">
						<div class="card h-100">
							<img src="<?= upload_url($p['cover_image']) ?>" class="card-img-top" alt="<?= e($p['title']) ?>">
							<div class="card-body">
								<h5 class="card-title"><?= e($p['title']) ?></h5>
								<div class="small text-muted text-uppercase"><?= e($p['status']) ?> • <?= e($p['city']) ?></div>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>