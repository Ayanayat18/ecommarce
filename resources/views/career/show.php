<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<h1 class="mb-2"><?= e($job['title']) ?></h1>
		<div class="text-muted mb-4"><?= e($job['dept']) ?> • <?= e($job['location']) ?> • <?= e($job['type']) ?></div>
		<div class="row g-5">
			<div class="col-md-8">
				<h4>Description</h4>
				<div><?= $job['description'] ?></div>
				<h4 class="mt-4">Requirements</h4>
				<div><?= $job['requirements'] ?></div>
			</div>
			<div class="col-md-4">
				<h4>Apply</h4>
				<?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
				<?php $errs = flash('errors') ?? []; ?>
				<form method="post" enctype="multipart/form-data" action="/career/apply/<?= (int)$job['id'] ?>">
					<?= csrf_field() ?>
					<div class="mb-2">
						<label class="form-label">Name</label>
						<input class="form-control" name="name" value="<?= e(old('name')) ?>">
						<?php if (!empty($errs['name'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['name'])) ?></div><?php endif; ?>
					</div>
					<div class="mb-2">
						<label class="form-label">Email</label>
						<input class="form-control" name="email" value="<?= e(old('email')) ?>">
						<?php if (!empty($errs['email'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['email'])) ?></div><?php endif; ?>
					</div>
					<div class="mb-2">
						<label class="form-label">Phone</label>
						<input class="form-control" name="phone" value="<?= e(old('phone')) ?>">
						<?php if (!empty($errs['phone'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['phone'])) ?></div><?php endif; ?>
					</div>
					<div class="mb-3">
						<label class="form-label">CV (PDF)</label>
						<input type="file" class="form-control" name="cv" accept="application/pdf">
						<?php if (!empty($errs['cv'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['cv'])) ?></div><?php endif; ?>
					</div>
					<button class="btn btn-primary w-100">Submit Application</button>
				</form>
			</div>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>