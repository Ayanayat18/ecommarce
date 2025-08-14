<?php App\Core\View::extend('main'); ?>
<?php App\Core\View::start('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('css/template.css') ?>">

<header>
	<div class="header-top">
		<div class="container-template">
			<div class="header-top-content">
				<div class="header-contact">
					<span><i class="fas fa-phone"></i> <?= e(settings('site.phone','+880 1234 567 890')) ?></span>
					<span><i class="fas fa-envelope"></i> <?= e(settings('site.email','hello@example.com')) ?></span>
				</div>
				<div class="header-social">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-linkedin-in"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="header-main">
		<div class="container-template">
			<div class="header-main-content" style="display:flex;justify-content:space-between;align-items:center;">
				<a href="#home" class="logo">
					<div class="logo-icon"><i class="fas fa-building"></i></div>
					<div class="logo-text"><?= e(settings('site.name', config('app','name','Aurora Holdings'))) ?></div>
				</a>
				<nav>
					<ul id="nav-menu">
						<li><a href="#home">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#services">Services</a></li>
						<li><a href="#projects">Projects</a></li>
						<li><a href="#testimonials">Testimonials</a></li>
						<li><a href="#contact">Contact</a></li>
					</ul>
					<button class="mobile-menu-toggle" id="mobile-menu-toggle"><i class="fas fa-bars"></i></button>
				</nav>
			</div>
		</div>
	</div>
</header>

<section class="hero" id="home">
	<div class="container-template">
		<div class="hero-content">
			<h2><?= e($sliders[0]['headline'] ?? 'Building Excellence, Creating Legacies') ?></h2>
			<p class="hero-subtitle"><?= e($sliders[0]['subtext'] ?? 'Where vision meets precision in construction and development') ?></p>
			<div class="hero-buttons">
				<a href="/contact" class="btn-t primary">Start Your Project</a>
				<a href="#services" class="btn-t secondary">Our Services</a>
			</div>
		</div>
	</div>
</section>

<section class="about" id="about">
	<div class="container-template">
		<div class="section-header fade-in">
			<h2>About <?= e(settings('site.name', 'Our Company')) ?></h2>
			<p><?= e(strip_tags($aboutPage['meta_description'] ?? 'Delivering world-class developments through innovation and quality.')) ?></p>
		</div>
		<div class="about-content">
			<div class="about-image fade-in">
				<img src="<?= upload_url($sliders[1]['image'] ?? ($sliders[0]['image'] ?? 'placeholders/p1.jpg')) ?>" alt="About Us">
			</div>
			<div class="about-text fade-in">
				<h3>Your Trusted Construction Partner</h3>
				<div><?= $aboutPage['body'] ?? '<p>We specialize in delivering premium residential, commercial, and infrastructure projects with a strong focus on sustainability and customer satisfaction.</p>' ?></div>
				<div class="stats-grid">
					<div class="stat-item"><div class="stat-number"><?= (int)($counts['completed'] ?? 0) ?></div><div class="stat-label">Completed Projects</div></div>
					<div class="stat-item"><div class="stat-number"><?= (int)($counts['ongoing'] ?? 0) ?></div><div class="stat-label">Ongoing</div></div>
					<div class="stat-item"><div class="stat-number"><?= (int)($counts['upcoming'] ?? 0) ?></div><div class="stat-label">Upcoming</div></div>
					<div class="stat-item"><div class="stat-number">100%</div><div class="stat-label">Commitment</div></div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="services" id="services">
	<div class="container-template">
		<div class="section-header fade-in">
			<h2>Our Premium Services</h2>
			<p>What we do for residential, commercial, and community spaces</p>
		</div>
		<div class="services-grid">
			<?php foreach (array_slice($features, 0, 6) as $f): ?>
				<div class="service-card fade-in">
					<div class="service-icon"><i class="fas fa-city"></i></div>
					<h3><?= e($f['title']) ?></h3>
					<p><?= e($f['body']) ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="projects" id="projects">
	<div class="container-template">
		<div class="section-header fade-in">
			<h2>Featured Projects</h2>
			<p>Explore our latest residential and commercial developments</p>
		</div>
		<div class="projects-grid">
			<?php foreach (array_slice($projects, 0, 6) as $p): ?>
				<div class="project-card fade-in">
					<div class="project-image">
						<img src="<?= upload_url($p['cover_image']) ?>" alt="<?= e($p['title']) ?>">
						<div class="project-overlay"><div class="project-overlay-text"><h3>View Project Details</h3></div></div>
					</div>
					<div class="project-info">
						<h3><?= e($p['title']) ?></h3>
						<p><?= e(mb_substr(strip_tags($p['overview'] ?? ''), 0, 120)) ?>...</p>
						<div class="project-meta"><span><i class="fas fa-map-marker-alt"></i> <?= e($p['city']) ?></span><span><i class="fas fa-calendar"></i> <?= date('Y', strtotime($p['created_at'] ?? date('Y-m-d'))) ?></span></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="testimonials" id="testimonials">
	<div class="container-template">
		<div class="section-header fade-in"><h2>Client Testimonials</h2><p>What our customers say</p></div>
		<div class="testimonials-grid">
			<?php foreach (array_slice($testimonials, 0, 3) as $t): ?>
				<div class="testimonial-card fade-in">
					<div class="quote-icon"><i class="fas fa-quote-right"></i></div>
					<div class="testimonial-text"><?= e($t['quote']) ?></div>
					<div class="client-info">
						<img src="<?= upload_url($t['photo'] ?? 'placeholders/t1.jpg') ?>" alt="<?= e($t['name']) ?>" class="client-image">
						<div class="client-details"><h4><?= e($t['name']) ?></h4><p>Homeowner</p></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="contact" id="contact">
	<div class="container-template">
		<div class="section-header fade-in"><h2>Get In Touch</h2><p>Let's discuss how we can bring your vision to life</p></div>
		<div class="contact-content">
			<div class="contact-form fade-in">
				<form method="post" action="/contact">
					<?= csrf_field() ?>
					<div class="form-group"><label>Full Name</label><input type="text" name="name" required></div>
					<div class="form-group"><label>Email Address</label><input type="email" name="email" required></div>
					<div class="form-group"><label>Topic</label><input type="text" name="topic" required></div>
					<div class="form-group"><label>Message</label><textarea name="message" rows="5" required></textarea></div>
					<button type="submit" class="btn-t primary">Send Message</button>
				</form>
			</div>
			<div class="contact-info fade-in">
				<h3>Contact Information</h3>
				<div class="contact-item"><i class="fas fa-map-marker-alt"></i><p><?= e(settings('site.address','123 Skyline Avenue, Dhaka')) ?></p></div>
				<div class="contact-item"><i class="fas fa-phone"></i><p><?= e(settings('site.phone','+880 1234 567 890')) ?></p></div>
				<div class="contact-item"><i class="fas fa-envelope"></i><p><?= e(settings('site.email','hello@example.com')) ?></p></div>
			</div>
		</div>
	</div>
</section>

<footer class="template-footer">
	<div class="container-template">
		<div class="footer-content">
			<div class="footer-column">
				<h3>About <?= e(settings('site.name', 'Aurora Holdings')) ?></h3>
				<p>Leading the construction industry with innovation, excellence, and sustainable practices.</p>
				<div class="header-social">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-linkedin-in"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
				</div>
			</div>
			<div class="footer-column"><h3>Quick Links</h3>
				<ul class="footer-links">
					<li><a href="#home">Home</a></li>
					<li><a href="#about">About Us</a></li>
					<li><a href="#services">Services</a></li>
					<li><a href="#projects">Projects</a></li>
					<li><a href="#testimonials">Testimonials</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div>
			<div class="footer-column"><h3>Our Services</h3>
				<ul class="footer-links">
					<?php foreach (array_slice($features, 0, 6) as $f): ?>
						<li><a href="#services"><?= e($f['title']) ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="footer-column"><h3>Newsletter</h3>
				<p>Stay updated with our latest projects and news</p>
				<form class="newsletter-form" action="#" onsubmit="this.reset(); return false;">
					<input type="email" placeholder="Your Email Address" required>
					<button type="submit">Subscribe</button>
				</form>
			</div>
		</div>
		<div class="footer-bottom">
			<p>&copy; <?= date('Y') ?> <?= e(settings('site.name', config('app','name'))) ?>. All Rights Reserved.</p>
		</div>
	</div>
</footer>

<script>
const mobileMenuToggle=document.getElementById('mobile-menu-toggle');
const navMenu=document.getElementById('nav-menu');
if(mobileMenuToggle){mobileMenuToggle.addEventListener('click',()=>{navMenu.classList.toggle('active')});}
</script>
<?php App\Core\View::end(); ?>