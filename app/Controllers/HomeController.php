<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Services\SitemapService;
use App\Services\RssService;

class HomeController extends Controller
{
	public function index(): void {
		$pdo = Database::pdo();
		$sliders = $pdo->query('SELECT * FROM sliders ORDER BY sort_order ASC')->fetchAll();
		$features = $pdo->query('SELECT * FROM features ORDER BY sort_order ASC')->fetchAll();
		$projects = $pdo->query('SELECT * FROM projects ORDER BY created_at DESC LIMIT 9')->fetchAll();
		$testimonials = $pdo->query('SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 6')->fetchAll();
		$partners = $pdo->query('SELECT * FROM partners ORDER BY sort_order ASC')->fetchAll();
		view('home/index', compact('sliders','features','projects','testimonials','partners'));
	}

	public function about(): void {
		$pdo = Database::pdo();
		$page = $pdo->query("SELECT * FROM pages WHERE slug = 'about' LIMIT 1")->fetch();
		$team = $pdo->query('SELECT * FROM team ORDER BY sort_order ASC')->fetchAll();
		view('home/about', compact('page','team'));
	}

	public function sitemap(): void {
		header('Content-Type: application/xml');
		echo SitemapService::generate();
	}

	public function rss(): void {
		header('Content-Type: application/rss+xml');
		echo RssService::feed();
	}

	public function switchLang(string $locale): void {
		$available = config('locales', 'available', ['en','bn']);
		if (in_array($locale, $available, true)) {
			$_SESSION['locale'] = $locale;
		}
		redirect($_SERVER['HTTP_REFERER'] ?? '/');
	}
}