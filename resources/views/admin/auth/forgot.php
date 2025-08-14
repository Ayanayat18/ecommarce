<?php App\Core\View::extend('admin'); ?>
<?php App\Core\View::start('content'); ?>
<div class="row justify-content-center mt-5">
	<div class="col-md-4">
		<h1 class="h4 mb-3">Forgot Password</h1>
		<?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
		<form method="post" action="/admin/forgot">
			<?= csrf_field() ?>
			<div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" type="email"></div>
			<button class="btn btn-primary w-100">Send Reset Link</button>
		</form>
	</div>
</div>
<?php App\Core\View::end(); ?>