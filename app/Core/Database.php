<?php
namespace App\Core;

use PDO;

class Database
{
	protected static ?PDO $pdo = null;

	public static function init(array $config): void {
		$dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',
			$config['host'], $config['port'], $config['database'], $config['charset']
		);
		self::$pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
	}

	public static function pdo(): PDO {
		if (!self::$pdo) throw new \RuntimeException('Database not initialized');
		return self::$pdo;
	}
}