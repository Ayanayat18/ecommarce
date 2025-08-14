<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Upload;
use App\Core\Auth;

class ResourceController extends Controller
{
	protected array $resources;

	public function __construct() { $this->resources = require BASE_PATH . '/config/admin_resources.php'; }

	protected function def(string $resource): array {
		if (!isset($this->resources[$resource])) { http_response_code(404); echo 'Resource not found'; exit; }
		return $this->resources[$resource];
	}

	public function index(string $resource): void {
		if (!Auth::check()) redirect('/admin/login');
		$def = $this->def($resource);
		$pdo = Database::pdo();
		$order = $def['order_by'] ?? 'id DESC';
		$cols = array_keys(array_filter($def['fields'], fn($f) => $f['list'] ?? false));
		$select = $cols ? implode(',', $cols) . ',id' : '*';
		$stmt = $pdo->query('SELECT ' . $select . ' FROM ' . $def['table'] . ' ORDER BY ' . $order);
		$items = $stmt->fetchAll();
		$title = $def['title'];
		view('admin/resources/index', compact('resource','def','items','cols','title'));
	}

	public function create(string $resource): void {
		if (!Auth::check()) redirect('/admin/login');
		$def = $this->def($resource);
		$title = 'Create ' . rtrim($def['title'], 's');
		$item = [];
		$relations = $this->fetchRelationOptions($def);
		view('admin/resources/form', compact('resource','def','item','title','relations'));
	}

	public function store(string $resource): void {
		if (!Auth::check()) redirect('/admin/login');
		$def = $this->def($resource);
		$pdo = Database::pdo();
		$data = $this->gatherData($def, $_POST, $_FILES);
		// auto slug
		if (isset($def['fields']['slug']) && empty($data['slug']) && isset($data['title'])) {
			$data['slug'] = $this->slugify($data['title']);
		}
		$columns = array_keys($data);
		$placeholders = implode(',', array_map(fn($c) => ':' . $c, $columns));
		$sql = 'INSERT INTO ' . $def['table'] . ' (' . implode(',', $columns) . ') VALUES (' . $placeholders . ')';
		$stmt = $pdo->prepare($sql);
		$stmt->execute($data);
		$id = (int)$pdo->lastInsertId();
		$this->syncManyToMany($def, $id, $_POST);
		redirect('/admin/resource/' . $resource);
	}

	public function edit(string $resource, int $id): void {
		if (!Auth::check()) redirect('/admin/login');
		$def = $this->def($resource);
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT * FROM ' . $def['table'] . ' WHERE id = :id');
		$stmt->execute(['id' => $id]);
		$item = $stmt->fetch();
		if (!$item) { http_response_code(404); echo 'Not found'; return; }
		$title = 'Edit ' . rtrim($def['title'], 's');
		$relations = $this->fetchRelationOptions($def, $id);
		view('admin/resources/form', compact('resource','def','item','title','relations'));
	}

	public function update(string $resource, int $id): void {
		if (!Auth::check()) redirect('/admin/login');
		$def = $this->def($resource);
		$pdo = Database::pdo();
		$data = $this->gatherData($def, $_POST, $_FILES, $id);
		if (isset($def['fields']['slug']) && empty($data['slug']) && isset($data['title'])) {
			$data['slug'] = $this->slugify($data['title']);
		}
		$assign = implode(',', array_map(fn($c) => $c . ' = :' . $c, array_keys($data)));
		$sql = 'UPDATE ' . $def['table'] . ' SET ' . $assign . ' WHERE id = :__id';
		$data['__id'] = $id;
		$stmt = $pdo->prepare($sql);
		$stmt->execute($data);
		$this->syncManyToMany($def, $id, $_POST);
		redirect('/admin/resource/' . $resource);
	}

	public function destroy(string $resource, int $id): void {
		if (!Auth::check()) redirect('/admin/login');
		$def = $this->def($resource);
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('DELETE FROM ' . $def['table'] . ' WHERE id = :id');
		$stmt->execute(['id' => $id]);
		redirect('/admin/resource/' . $resource);
	}

	protected function gatherData(array $def, array $post, array $files, ?int $id = null): array {
		$data = [];
		foreach ($def['fields'] as $name => $f) {
			if (($f['type'] ?? '') === 'manyToMany' || ($f['type'] ?? '') === 'file_link' || ($f['type'] ?? '') === 'select_query') continue;
			if (in_array($name, ['created_at','updated_at'])) continue;
			switch ($f['type'] ?? 'text') {
				case 'image':
				case 'file':
					if (!empty($files[$name]) && $files[$name]['error'] === UPLOAD_ERR_OK) {
						$allowed = ($f['type'] === 'image') ? ['jpg','jpeg','png','webp'] : ['pdf'];
						$dir = $f['upload_dir'] ?? $def['table'];
						$data[$name] = Upload::save($files[$name], $dir, $allowed, (int) env('UPLOAD_MAX_SIZE_MB', 10));
					} else {
						if ($id !== null && isset($post['_keep_'.$name]) && $post['_keep_'.$name] === '1') {
							// keep existing; fetch current
							$pdo = Database::pdo();
							$stmt = $pdo->prepare('SELECT ' . $name . ' FROM ' . $def['table'] . ' WHERE id = :id');
							$stmt->execute(['id' => $id]);
							$val = $stmt->fetchColumn();
							if ($val !== false) $data[$name] = $val;
						}
					}
					break;
				case 'number':
					$data[$name] = $post[$name] !== '' ? (float)$post[$name] : null; break;
				case 'date':
				case 'datetime':
					$data[$name] = $post[$name] !== '' ? $post[$name] : null; break;
				case 'password':
					if (!empty($post[$name])) $data[$name] = password_hash((string)$post[$name], PASSWORD_DEFAULT);
					break;
				default:
					$data[$name] = $post[$name] ?? null;
			}
		}
		return $data;
	}

	protected function fetchRelationOptions(array $def, ?int $id = null): array {
		$pdo = Database::pdo();
		$result = [];
		foreach ($def['fields'] as $name => $f) {
			if (($f['type'] ?? '') === 'select_query') {
				$result[$name] = $pdo->query($f['query'])->fetchAll();
			}
			if (($f['type'] ?? '') === 'manyToMany' && !empty($id)) {
				// options
				$result[$name] = $pdo->query($f['options_query'])->fetchAll();
				$sel = $pdo->prepare('SELECT ' . $f['pivot']['other'] . ' FROM ' . $f['pivot']['table'] . ' WHERE ' . $f['pivot']['this'] . ' = :id');
				$sel->execute(['id' => $id]);
				$result[$name . '_selected'] = array_map('intval', array_column($sel->fetchAll(), $f['pivot']['other']));
			}
		}
		return $result;
	}

	protected function syncManyToMany(array $def, int $id, array $post): void {
		$pdo = Database::pdo();
		foreach ($def['fields'] as $name => $f) {
			if (($f['type'] ?? '') !== 'manyToMany') continue;
			$vals = array_filter(array_map('intval', (array)($post[$name] ?? [])));
			$pdo->prepare('DELETE FROM ' . $f['pivot']['table'] . ' WHERE ' . $f['pivot']['this'] . ' = :id')->execute(['id' => $id]);
			foreach ($vals as $other) {
				$pdo->prepare('INSERT INTO ' . $f['pivot']['table'] . ' (' . $f['pivot']['this'] . ',' . $f['pivot']['other'] . ') VALUES (:a,:b)')->execute(['a' => $id, 'b' => $other]);
			}
		}
	}

	protected function slugify(string $title): string {
		$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
		return $slug ?: bin2hex(random_bytes(4));
	}
}