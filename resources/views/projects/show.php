<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_3.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up"><?= e($project['title']) ?></h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item"><a href="/projects">Projects</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page"><?= e($project['title']) ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-7">
				<div class="img-property-slide-wrap">
					<div class="img-property-slide">
						<?php foreach ($images as $img): ?>
							<img src="<?= upload_url($img['path']) ?>" alt="<?= e($img['alt'] ?? $project['title']) ?>" class="img-fluid" />
						<?php endforeach; ?>
					</div>
				</div>
				<div class="mt-4">
					<h3 class="text-primary">Overview</h3>
					<p class="text-black-50"><?= nl2br(e($project['overview'])) ?></p>
					<h4 class="mt-4 text-primary">Amenities</h4>
					<p class="text-black-50"><?= nl2br(e($project['amenities'])) ?></p>
				</div>
			</div>
			<div class="col-lg-4">
				<h2 class="heading text-primary"><?= e($project['title']) ?></h2>
				<p class="meta"><?= e($project['city']) ?></p>
				<ul class="list-unstyled mb-4">
					<li>Area: <strong><?= e($project['area_sqft']) ?></strong> sqft</li>
					<li>Floors: <strong><?= e($project['floors']) ?></strong></li>
					<li>Units: <strong><?= e($project['units_total']) ?></strong></li>
					<li>Handover: <strong><?= e($project['handover_date']) ?></strong></li>
				</ul>
				<h4 class="text-primary">Availability</h4>
				<table class="table table-sm">
					<thead><tr><th>Type</th><th>Bed</th><th>Size</th><th>Price</th><th>Status</th></tr></thead>
					<tbody>
						<?php foreach ($units as $u): ?>
							<tr>
								<td><?= e($u['type']) ?></td>
								<td><?= e($u['bedrooms']) ?></td>
								<td><?= e($u['size_sqft']) ?> sqft</td>
								<td><?= e(number_format((float)$u['price'])) ?></td>
								<td><?= e(ucfirst($u['status'])) ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<h4 class="mt-4 text-primary">Location</h4>
				<div class="ratio ratio-16x9">
					<?= $project['map_iframe'] ?: '<iframe src="https://maps.google.com" loading="lazy"></iframe>' ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>