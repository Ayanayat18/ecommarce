<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/projects">Projects</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= e($project['title']) ?></li>
			</ol>
		</nav>
		<div class="row g-4">
			<div class="col-md-7">
				<div id="gallery" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<?php foreach ($images as $i => $img): ?>
							<div class="carousel-item <?= $i===0?'active':'' ?>">
								<img src="<?= upload_url($img['path']) ?>" class="d-block w-100" alt="<?= e($img['alt'] ?? $project['title']) ?>">
							</div>
						<?php endforeach; ?>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#gallery" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
					<button class="carousel-control-next" type="button" data-bs-target="#gallery" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
				</div>
				<div class="mt-3">
					<h3>Overview</h3>
					<p><?= nl2br(e($project['overview'])) ?></p>
					<h4 class="mt-4">Amenities</h4>
					<p><?= nl2br(e($project['amenities'])) ?></p>
				</div>
			</div>
			<div class="col-md-5">
				<h2 class="mb-3"><?= e($project['title']) ?></h2>
				<div class="mb-3 text-muted text-uppercase">Status: <?= e($project['status']) ?> • <?= e($project['city']) ?></div>
				<ul class="list-group mb-4">
					<li class="list-group-item">Area: <?= e($project['area_sqft']) ?> sqft</li>
					<li class="list-group-item">Floors: <?= e($project['floors']) ?></li>
					<li class="list-group-item">Units: <?= e($project['units_total']) ?></li>
					<li class="list-group-item">Handover: <?= e($project['handover_date']) ?></li>
				</ul>
				<h4>Availability</h4>
				<table class="table table-sm">
					<thead><tr><th>Type</th><th>Bed</th><th>Size (sqft)</th><th>Price</th><th>Status</th></tr></thead>
					<tbody>
						<?php foreach ($units as $u): ?>
							<tr>
								<td><?= e($u['type']) ?></td>
								<td><?= e($u['bedrooms']) ?></td>
								<td><?= e($u['size_sqft']) ?></td>
								<td><?= e(number_format((float)$u['price'])) ?></td>
								<td><span class="badge bg-<?= $u['status']==='available'?'success':($u['status']==='booked'?'warning':'secondary') ?>"><?= e(ucfirst($u['status'])) ?></span></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<h4 class="mt-4">Location</h4>
				<div class="ratio ratio-16x9">
					<?= $project['map_iframe'] ?: '<iframe src="https://maps.google.com" loading="lazy"></iframe>' ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>