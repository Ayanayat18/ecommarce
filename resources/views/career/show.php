<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_2.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up"><?= e($job['title']) ?></h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item"><a href="/career">Careers</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page"><?= e($job['title']) ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="text-black-50 mb-4"><?= e($job['dept']) ?> • <?= e($job['location']) ?> • <?= e($job['type']) ?></div>
		<div class="row g-5">
			<div class="col-md-8">
				<h4 class="text-primary">Description</h4>
				<div><?= $job['description'] ?></div>
				<h4 class="mt-4 text-primary">Requirements</h4>
				<div><?= $job['requirements'] ?></div>
			</div>
			<div class="col-md-4">
				<div class="p-4 bg-light rounded-3">
					<h5 class="mb-3">Apply</h5>
					<?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
					<?php $errs = flash('errors') ?? []; ?>
					<form method="post" enctype="multipart/form-data" action="/career/apply/<?= (int)$job['id'] ?>">
						<?= csrf_field() ?>
						<div class="mb-2"><input class="form-control" placeholder="Name" name="name" value="<?= e(old('name')) ?>"><?php if (!empty($errs['name'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['name'])) ?></div><?php endif; ?></div>
						<div class="mb-2"><input class="form-control" placeholder="Email" name="email" value="<?= e(old('email')) ?>"><?php if (!empty($errs['email'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['email'])) ?></div><?php endif; ?></div>
						<div class="mb-2"><input class="form-control" placeholder="Phone" name="phone" value="<?= e(old('phone')) ?>"><?php if (!empty($errs['phone'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['phone'])) ?></div><?php endif; ?></div>
						<div class="mb-3"><input type="file" class="form-control" name="cv" accept="application/pdf"><?php if (!empty($errs['cv'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['cv'])) ?></div><?php endif; ?></div>
						<button class="btn btn-primary w-100">Submit Application</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>