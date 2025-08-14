<?php
namespace App\Core;

class CSRF
{
	public static function init(): void {
		if (!isset($_SESSION['_token'])) {
			$_SESSION['_token'] = bin2hex(random_bytes(32));
		}
	}

	public static function token(): string { return $_SESSION['_token'] ?? ''; }

	public static function verify(): bool {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$token = $_POST['_token'] ?? '';
			return hash_equals($_SESSION['_token'] ?? '', $token);
		}
		return true;
	}
}