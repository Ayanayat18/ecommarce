<?php
namespace App\Services;

use App\Core\Database;

class SearchService
{
	public static function search(string $q, int $limit = 20): array {
		$q = '%' . $q . '%';
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('(
			SELECT "post" as type, id, title, slug, excerpt as snippet, created_at FROM posts WHERE (title LIKE :q OR body LIKE :q) AND status = "published"
		) UNION ALL (
			SELECT "project" as type, id, title, slug, overview as snippet, created_at FROM projects WHERE (title LIKE :q OR overview LIKE :q)
		) ORDER BY created_at DESC LIMIT ' . (int)$limit);
		$stmt->execute(['q' => $q]);
		return $stmt->fetchAll();
	}
}