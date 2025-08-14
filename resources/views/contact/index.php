<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<section class="py-5 bg-light">
	<div class="container">
		<h1 class="mb-4">Contact Us</h1>
		<div class="row g-4">
			<div class="col-md-6">
				<div class="ratio ratio-16x9 mb-3">
					<iframe src="https://maps.google.com" loading="lazy" aria-label="Google Map"></iframe>
				</div>
				<div class="p-3 bg-white border rounded">
					<h5>Head Office</h5>
					<p>123 Skyline Avenue, Dhaka
					<br>+880 1234 567 890
					<br>hello@example.com</p>
				</div>
			</div>
			<div class="col-md-6">
				<?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
				<?php $errs = flash('errors') ?? []; ?>
				<form method="post" action="/contact">
					<?= csrf_field() ?>
					<div class="mb-2"><label class="form-label">Name</label><input class="form-control" name="name" value="<?= e(old('name')) ?>"><?php if (!empty($errs['name'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['name'])) ?></div><?php endif; ?></div>
					<div class="mb-2"><label class="form-label">Email</label><input class="form-control" name="email" value="<?= e(old('email')) ?>"><?php if (!empty($errs['email'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['email'])) ?></div><?php endif; ?></div>
					<div class="mb-2"><label class="form-label">Topic</label><select name="topic" class="form-select"><option value="general">General</option><option value="sales">Sales</option><option value="support">Support</option></select></div>
					<div class="mb-3"><label class="form-label">Message</label><textarea class="form-control" name="message" rows="5"><?= e(old('message')) ?></textarea><?php if (!empty($errs['message'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['message'])) ?></div><?php endif; ?></div>
					<button class="btn btn-primary">Send</button>
				</form>
			</div>
		</div>
	</div>
</section>
<?php App\Core\View::end(); ?>