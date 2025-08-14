<?php App\Core\View::extend('admin'); ?>
<?php App\Core\View::start('content'); ?>
<div class="row justify-content-center mt-5">
	<div class="col-md-4">
		<h1 class="h4 mb-3">Admin Login</h1>
		<?php $errs = flash('errors') ?? []; ?>
		<?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
		<form method="post" action="/admin/login">
			<?= csrf_field() ?>
			<div class="mb-2">
				<label class="form-label">Email</label>
				<input class="form-control" name="email" type="email">
				<?php if (!empty($errs['email'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['email'])) ?></div><?php endif; ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input class="form-control" name="password" type="password">
			</div>
			<button class="btn btn-primary w-100">Login</button>
		</form>
		<div class="text-center mt-2"><a href="/admin/forgot">Forgot password?</a></div>
	</div>
</div>
<?php App\Core\View::end(); ?>