<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_1.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up">Projects</h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page">Projects</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row mb-4 align-items-center">
			<div class="col-lg-8">
				<h2 class="font-weight-bold text-primary heading mb-0">Explore Our Properties</h2>
			</div>
			<div class="col-lg-4">
				<form method="get" class="row g-2">
					<div class="col-6">
						<select name="status" class="form-select">
							<option value="">Status</option>
							<?php foreach (['completed','ongoing','upcoming'] as $s): ?>
								<option value="<?= $s ?>" <?= ($_GET['status'] ?? '')===$s?'selected':'' ?>><?= ucfirst($s) ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-6"><input class="form-control" name="city" placeholder="City" value="<?= e($_GET['city'] ?? '') ?>"></div>
					<div class="col-6"><input class="form-control" name="bedrooms" placeholder="Bedrooms" value="<?= e($_GET['bedrooms'] ?? '') ?>"></div>
					<div class="col-6"><button class="btn btn-primary w-100">Filter</button></div>
				</form>
			</div>
		</div>
		<div class="row">
			<?php foreach ($projects as $p): ?>
				<div class="col-12 col-md-6 col-lg-4">
					<div class="property-item mb-30">
						<a href="/projects/<?= e($p['slug']) ?>" class="img">
							<img src="<?= upload_url($p['cover_image']) ?>" alt="<?= e($p['title']) ?>" class="img-fluid" />
						</a>
						<div class="property-content">
							<div class="price mb-2"><span><?= e($p['price_label'] ?? '') ?></span></div>
							<div>
								<span class="d-block mb-2 text-black-50"><?= e($p['address'] ?? '') ?></span>
								<span class="city d-block mb-3"><?= e($p['city']) ?></span>
								<div class="specs d-flex mb-4">
									<span class="d-block d-flex align-items-center me-3"><span class="icon-bed me-2"></span><span class="caption"><?= e($p['bedrooms'] ?? '') ?> beds</span></span>
									<span class="d-block d-flex align-items-center"><span class="icon-bath me-2"></span><span class="caption"><?= e($p['baths'] ?? '') ?> baths</span></span>
								</div>
								<a href="/projects/<?= e($p['slug']) ?>" class="btn btn-primary py-2 px-3">See details</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>