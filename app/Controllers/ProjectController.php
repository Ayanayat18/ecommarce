<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class ProjectController extends Controller
{
	public function index(): void {
		$pdo = Database::pdo();
		$where = [];
		$params = [];
		if (!empty($_GET['status'])) { $where[] = 'status = :status'; $params['status'] = $_GET['status']; }
		if (!empty($_GET['city'])) { $where[] = 'city = :city'; $params['city'] = $_GET['city']; }
		if (!empty($_GET['bedrooms'])) { $where[] = 'bedrooms = :bedrooms'; $params['bedrooms'] = (int)$_GET['bedrooms']; }
		$sql = 'SELECT * FROM projects';
		if ($where) $sql .= ' WHERE ' . implode(' AND ', $where);
		$sql .= ' ORDER BY created_at DESC';
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$projects = $stmt->fetchAll();
		view('projects/index', compact('projects'));
	}

	public function show(string $slug): void {
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT * FROM projects WHERE slug = :slug LIMIT 1');
		$stmt->execute(['slug' => $slug]);
		$project = $stmt->fetch();
		if (!$project) { http_response_code(404); echo 'Project not found'; return; }
		$gallery = $pdo->prepare('SELECT * FROM project_gallery WHERE project_id = :id ORDER BY sort_order ASC');
		$gallery->execute(['id' => $project['id']]);
		$images = $gallery->fetchAll();
		$unitsStmt = $pdo->prepare('SELECT * FROM units WHERE project_id = :id ORDER BY price ASC');
		$unitsStmt->execute(['id' => $project['id']]);
		$units = $unitsStmt->fetchAll();
		view('projects/show', compact('project','images','units'));
	}
}