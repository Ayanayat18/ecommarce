<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class BlogController extends Controller
{
	public function index(): void {
		$pdo = Database::pdo();
		$search = trim($_GET['q'] ?? '');
		$sql = 'SELECT * FROM posts WHERE status = "published"';
		$params = [];
		if ($search !== '') { $sql .= ' AND (title LIKE :q OR body LIKE :q)'; $params['q'] = '%' . $search . '%'; }
		$sql .= ' ORDER BY published_at DESC LIMIT 10';
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$posts = $stmt->fetchAll();
		view('blog/index', compact('posts','search'));
	}

	public function category(string $slug): void {
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT p.* FROM posts p JOIN post_categories pc ON pc.post_id = p.id JOIN categories c ON c.id = pc.category_id WHERE c.slug = :slug AND p.status = "published" ORDER BY p.published_at DESC');
		$stmt->execute(['slug' => $slug]);
		$posts = $stmt->fetchAll();
		view('blog/index', ['posts' => $posts, 'search' => '']);
	}

	public function tag(string $slug): void {
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT p.* FROM posts p JOIN post_tags pt ON pt.post_id = p.id JOIN tags t ON t.id = pt.tag_id WHERE t.slug = :slug AND p.status = "published" ORDER BY p.published_at DESC');
		$stmt->execute(['slug' => $slug]);
		$posts = $stmt->fetchAll();
		view('blog/index', ['posts' => $posts, 'search' => '']);
	}

	public function show(string $slug): void {
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT * FROM posts WHERE slug = :slug AND status = "published" LIMIT 1');
		$stmt->execute(['slug' => $slug]);
		$post = $stmt->fetch();
		if (!$post) { http_response_code(404); echo 'Post not found'; return; }
		$related = $pdo->prepare('SELECT * FROM posts WHERE status = "published" AND id <> :id ORDER BY RAND() LIMIT 3');
		$related->execute(['id' => $post['id']]);
		$relatedPosts = $related->fetchAll();
		view('blog/show', compact('post','relatedPosts'));
	}
}