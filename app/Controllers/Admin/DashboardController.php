<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Auth;

class DashboardController extends Controller
{
	public function index(): void {
		if (!Auth::check()) redirect('/admin/login');
		$pdo = Database::pdo();
		$kpis = [
			'projects' => (int)$pdo->query('SELECT COUNT(*) FROM projects')->fetchColumn(),
			'leads' => (int)$pdo->query('SELECT COUNT(*) FROM enquiries')->fetchColumn(),
			'applications' => (int)$pdo->query('SELECT COUNT(*) FROM applications')->fetchColumn(),
			'posts' => (int)$pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn(),
		];
		$latestEnquiries = $pdo->query('SELECT * FROM enquiries ORDER BY created_at DESC LIMIT 10')->fetchAll();
		$recentPosts = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 5')->fetchAll();
		view('admin/dashboard/index', compact('kpis','latestEnquiries','recentPosts'));
	}
}