<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_3.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up">About</h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page">About</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row text-left mb-5">
			<div class="col-12"><h2 class="font-weight-bold heading text-primary mb-4">About Us</h2></div>
			<div class="col-lg-6">
				<div class="text-black-50"><?= $page['body'] ?? '<p>We craft spaces that inspire city life with a commitment to design, quality, and sustainability.</p>' ?></div>
			</div>
			<div class="col-lg-6">
				<p class="text-black-50">We believe in integrity, customer-centricity, and long-term value creation.</p>
				<ul class="text-black-50">
					<li>Integrity and transparency</li>
					<li>Customer-first experiences</li>
					<li>Long-term value creation</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="section pt-0">
	<div class="container">
		<div class="row justify-content-between mb-5">
			<div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
				<div class="img-about dots"><img src="<?= asset('vendor/uire/images/hero_bg_2.jpg') ?>" alt="Image" class="img-fluid" /></div>
			</div>
			<div class="col-lg-4">
				<div class="d-flex feature-h mb-3"><span class="wrap-icon me-3"><span class="icon-home"></span></span><div class="feature-text"><h3 class="heading">Quality Properties</h3><p class="text-black-50">Premium materials, thoughtful planning, and a focus on community.</p></div></div>
				<div class="d-flex feature-h mb-3"><span class="wrap-icon me-3"><span class="icon-person"></span></span><div class="feature-text"><h3 class="heading">Experienced Team</h3><p class="text-black-50">Seasoned engineers, architects, and project managers.</p></div></div>
				<div class="d-flex feature-h"><span class="wrap-icon me-3"><span class="icon-security"></span></span><div class="feature-text"><h3 class="heading">Safe & Reliable</h3><p class="text-black-50">Compliance, safety, and on-time delivery.</p></div></div>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row section-counter">
			<div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
				<div class="counter-wrap mb-5 mb-lg-0"><span class="number"><span class="countup text-primary"><?= (int)($counts['completed'] ?? 0) ?></span></span><span class="caption text-black-50">Completed</span></div>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
				<div class="counter-wrap mb-5 mb-lg-0"><span class="number"><span class="countup text-primary"><?= (int)($counts['ongoing'] ?? 0) ?></span></span><span class="caption text-black-50">Ongoing</span></div>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
				<div class="counter-wrap mb-5 mb-lg-0"><span class="number"><span class="countup text-primary"><?= (int)($counts['upcoming'] ?? 0) ?></span></span><span class="caption text-black-50">Upcoming</span></div>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
				<div class="counter-wrap mb-5 mb-lg-0"><span class="number"><span class="countup text-primary">100%</span></span><span class="caption text-black-50">Commitment</span></div>
			</div>
		</div>
	</div>
</div>

<div class="section sec-testimonials bg-light">
	<div class="container">
		<div class="row mb-5 align-items-center">
			<div class="col-md-6"><h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">The Team</h2></div>
		</div>
		<div class="row g-4">
			<?php foreach ($team as $m): ?>
				<div class="col-md-3 text-center">
					<img src="<?= upload_url($m['photo']) ?>" alt="<?= e($m['name']) ?>" class="img-fluid rounded-circle w-25 mb-3" />
					<h6 class="text-primary mb-1"><?= e($m['name']) ?></h6>
					<p class="text-black-50 mb-0"><?= e($m['role']) ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>