<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class CsrController extends Controller
{
	public function index(): void {
		$pdo = Database::pdo();
		$posts = $pdo->query('SELECT * FROM csr_posts ORDER BY created_at DESC')->fetchAll();
		view('csr/index', compact('posts'));
	}

	public function show(string $slug): void {
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT * FROM csr_posts WHERE slug = :slug LIMIT 1');
		$stmt->execute(['slug' => $slug]);
		$post = $stmt->fetch();
		if (!$post) { http_response_code(404); echo 'CSR post not found'; return; }
		view('csr/show', compact('post'));
	}
}