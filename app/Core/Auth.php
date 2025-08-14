<?php
namespace App\Core;

use App\Models\User;

class Auth
{
	protected static ?array $user = null;

	public static function init(): void {
		if (!empty($_SESSION['user_id'])) {
			self::$user = User::find($_SESSION['user_id']);
		}
	}

	public static function check(): bool { return self::$user !== null; }
	public static function user(): ?array { return self::$user; }

	public static function attempt(string $email, string $password): bool {
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
		$stmt->execute(['email' => $email]);
		$user = $stmt->fetch();
		if ($user && password_verify($password, $user['password'])) {
			$_SESSION['user_id'] = (int)$user['id'];
			self::$user = $user;
			return true;
		}
		return false;
	}

	public static function logout(): void {
		unset($_SESSION['user_id']);
		self::$user = null;
	}

	public static function userCan(string $permission): bool {
		if (!self::$user) return false;
		if (self::$user['role'] === 'super') return true;
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT COUNT(*) FROM permissions WHERE role = :role AND permission = :permission');
		$stmt->execute(['role' => self::$user['role'], 'permission' => $permission]);
		return (bool) $stmt->fetchColumn();
	}

	public static function rateLimit(string $key, int $maxAttempts, int $decaySeconds): bool {
		$now = time();
		$_SESSION['_rate'][$key] = array_filter($_SESSION['_rate'][$key] ?? [], fn($t) => $t > $now - $decaySeconds);
		if (count($_SESSION['_rate'][$key]) >= $maxAttempts) return false;
		$_SESSION['_rate'][$key][] = $now;
		return true;
	}
}