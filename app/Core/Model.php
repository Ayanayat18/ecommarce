<?php
namespace App\Core;

use App\Core\Database;
use PDO;

abstract class Model
{
	protected static string $table;
	protected static string $primaryKey = 'id';

	public static function pdo(): PDO { return Database::pdo(); }

	public static function find($id) {
		$sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . static::$primaryKey . ' = :id LIMIT 1';
		$stmt = self::pdo()->prepare($sql);
		$stmt->execute(['id' => $id]);
		return $stmt->fetch();
	}

	public static function all($columns = '*'): array {
		$sql = 'SELECT ' . (is_array($columns) ? implode(',', $columns) : $columns) . ' FROM ' . static::$table;
		return self::pdo()->query($sql)->fetchAll();
	}

	public static function where(array $conditions, string $order = '', string $limit = ''): array {
		$clauses = [];
		$params = [];
		foreach ($conditions as $k => $v) {
			$param = str_replace('.', '_', $k);
			$clauses[] = "$k = :$param";
			$params[$param] = $v;
		}
		$sql = 'SELECT * FROM ' . static::$table . (count($clauses) ? ' WHERE ' . implode(' AND ', $clauses) : '');
		if ($order) $sql .= ' ORDER BY ' . $order;
		if ($limit) $sql .= ' LIMIT ' . $limit;
		$stmt = self::pdo()->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll();
	}

	public static function create(array $data): int {
		$keys = array_keys($data);
		$cols = implode(',', $keys);
		$placeholders = implode(',', array_map(fn($k) => ':' . $k, $keys));
		$sql = 'INSERT INTO ' . static::$table . " ($cols) VALUES ($placeholders)";
		$stmt = self::pdo()->prepare($sql);
		$stmt->execute($data);
		return (int) self::pdo()->lastInsertId();
	}

	public static function update($id, array $data): bool {
		$assignments = implode(',', array_map(fn($k) => "$k = :$k", array_keys($data)));
		$data['__id'] = $id;
		$sql = 'UPDATE ' . static::$table . " SET $assignments WHERE " . static::$primaryKey . ' = :__id';
		$stmt = self::pdo()->prepare($sql);
		return $stmt->execute($data);
	}

	public static function delete($id): bool {
		$sql = 'DELETE FROM ' . static::$table . ' WHERE ' . static::$primaryKey . ' = :id';
		$stmt = self::pdo()->prepare($sql);
		return $stmt->execute(['id' => $id]);
	}
}