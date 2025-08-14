<?php
namespace App\Core;

class Cache
{
	protected static function path(string $key): string {
		$dir = BASE_PATH . '/storage/cache';
		if (!is_dir($dir)) mkdir($dir, 0775, true);
		$fname = preg_replace('/[^a-z0-9_\-]/i','_', $key) . '.cache.php';
		return $dir . '/' . $fname;
	}

	public static function get(string $key, $default = null) {
		$file = self::path($key);
		if (!file_exists($file)) return $default;
		$data = include $file;
		if (!is_array($data) || ($data['expires_at'] !== 0 && $data['expires_at'] < time())) {
			@unlink($file);
			return $default;
		}
		return $data['value'];
	}

	public static function put(string $key, $value, int $seconds = 0): void {
		$file = self::path($key);
		$expires = $seconds > 0 ? time() + $seconds : 0;
		$payload = var_export(['expires_at' => $expires, 'value' => $value], true);
		file_put_contents($file, "<?php\nreturn $payload;\n");
	}

	public static function remember(string $key, int $seconds, callable $callback) {
		$value = self::get($key);
		if ($value !== null) return $value;
		$value = $callback();
		self::put($key, $value, $seconds);
		return $value;
	}

	public static function forget(string $key): void {
		$file = self::path($key);
		if (file_exists($file)) @unlink($file);
	}
}