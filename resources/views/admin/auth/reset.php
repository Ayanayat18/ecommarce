<?php App\Core\View::extend('admin'); ?>
<?php App\Core\View::start('content'); ?>
<div class="row justify-content-center mt-5">
	<div class="col-md-4">
		<h1 class="h4 mb-3">Reset Password</h1>
		<form method="post" action="/admin/reset">
			<?= csrf_field() ?>
			<input type="hidden" name="email" value="<?= e($email ?? '') ?>">
			<input type="hidden" name="token" value="<?= e($token ?? '') ?>">
			<div class="mb-3"><label class="form-label">New Password</label><input class="form-control" name="password" type="password"></div>
			<button class="btn btn-primary w-100">Update Password</button>
		</form>
	</div>
</div>
<?php App\Core\View::end(); ?>