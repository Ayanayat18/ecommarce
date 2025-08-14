<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<div class="hero page-inner overlay" style="background-image: url('<?= asset('vendor/uire/images/hero_bg_1.jpg') ?>')">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-9 text-center mt-5">
				<h1 class="heading" data-aos="fade-up">Contact Us</h1>
				<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
					<ol class="breadcrumb text-center justify-content-center">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active text-white-50" aria-current="page">Contact</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
				<div class="contact-info">
					<div class="address mt-2">
						<i class="icon-room"></i>
						<h4 class="mb-2">Location:</h4>
						<p><?= e(settings('site.address','')) ?></p>
					</div>
					<div class="open-hours mt-4">
						<i class="icon-clock-o"></i>
						<h4 class="mb-2">Open Hours:</h4>
						<p>Sunday-Friday: 10:00 AM - 6:00 PM</p>
					</div>
					<div class="email mt-4">
						<i class="icon-envelope"></i>
						<h4 class="mb-2">Email:</h4>
						<p><?= e(settings('site.email','')) ?></p>
					</div>
					<div class="phone mt-4">
						<i class="icon-phone"></i>
						<h4 class="mb-2">Call:</h4>
						<p><?= e(settings('site.phone','')) ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
				<?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
				<?php $errs = flash('errors') ?? []; ?>
				<form method="post" action="/contact">
					<?= csrf_field() ?>
					<div class="row">
						<div class="col-6 mb-3">
							<input type="text" class="form-control" name="name" placeholder="Your Name" value="<?= e(old('name')) ?>" />
							<?php if (!empty($errs['name'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['name'])) ?></div><?php endif; ?>
						</div>
						<div class="col-6 mb-3">
							<input type="email" class="form-control" name="email" placeholder="Your Email" value="<?= e(old('email')) ?>" />
							<?php if (!empty($errs['email'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['email'])) ?></div><?php endif; ?>
						</div>
						<div class="col-12 mb-3">
							<input type="text" class="form-control" name="topic" placeholder="Subject" value="<?= e(old('topic')) ?>" />
							<?php if (!empty($errs['topic'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['topic'])) ?></div><?php endif; ?>
						</div>
						<div class="col-12 mb-3">
							<textarea cols="30" rows="7" class="form-control" name="message" placeholder="Message"><?= e(old('message')) ?></textarea>
							<?php if (!empty($errs['message'])): ?><div class="text-danger small"><?= e(implode(', ',$errs['message'])) ?></div><?php endif; ?>
						</div>
						<div class="col-12">
							<input type="submit" value="Send Message" class="btn btn-primary" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>