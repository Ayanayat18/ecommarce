<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<h1 class="mb-4">About Us</h1>
		<div class="row g-4">
			<div class="col-md-8">
				<div class="mb-3">
					<?= $page['body'] ?? '<p>We craft spaces that inspire city life with a commitment to design, quality, and sustainability.</p>' ?>
				</div>
				<h3 class="mt-4">Our Values</h3>
				<ul>
					<li>Integrity and transparency</li>
					<li>Customer-centric experiences</li>
					<li>Long-term value creation</li>
				</ul>
				<h3 class="mt-4">Timeline</h3>
				<ul class="timeline">
					<li>2015 - Founded with a vision to uplift living standards</li>
					<li>2018 - Delivered first landmark residential project</li>
					<li>2022 - Expanded to multiple cities</li>
				</ul>
			</div>
			<div class="col-md-4">
				<div class="p-3 bg-white border rounded">
					<h5>Contact</h5>
					<p>Address: 123 Skyline Avenue
					<br>Phone: +880 1234 567 890
					<br>Email: hello@example.com</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="py-5">
	<div class="container">
		<h2 class="mb-4">Leadership</h2>
		<div class="row g-4">
			<?php foreach ($team as $m): ?>
				<div class="col-md-3">
					<div class="card h-100 text-center">
						<img src="<?= upload_url($m['photo']) ?>" class="card-img-top" alt="<?= e($m['name']) ?>">
						<div class="card-body">
							<h6 class="mb-1"><?= e($m['name']) ?></h6>
							<div class="text-muted small"><?= e($m['role']) ?></div>
							<p class="small mt-2"><?= e($m['bio']) ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>