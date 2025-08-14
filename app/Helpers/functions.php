<?php

function env(string $key, $default = null) {
	return $_ENV[$key] ?? $default;
}

function config(string $file, ?string $key = null, $default = null) {
	static $configs = [];
	if (!isset($configs[$file])) {
		$path = BASE_PATH . '/config/' . $file . '.php';
		$configs[$file] = file_exists($path) ? require $path : [];
	}
	if ($key === null) return $configs[$file];
	return $configs[$file][$key] ?? $default;
}

function view(string $template, array $data = []): void {
	App\Core\View::render($template, $data);
}

function asset(string $path): string {
	return '/assets/' . ltrim($path, '/');
}

function upload_url(string $path): string {
	return '/uploads/' . ltrim($path, '/');
}

function url(string $path = ''): string {
	$base = rtrim(config('app', 'url', ''), '/');
	return $base . '/' . ltrim($path, '/');
}

function redirect(string $path): void {
	header('Location: ' . url($path));
	exit;
}

function e(?string $value): string {
	return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function csrf_token(): string {
	return App\Core\CSRF::token();
}

function csrf_field(): string {
	return '<input type="hidden" name="_token" value="' . csrf_token() . '">';
}

function is_post(): bool { return $_SERVER['REQUEST_METHOD'] === 'POST'; }

function old(string $key, $default = '') {
	return $_SESSION['_old'][$key] ?? $default;
}

function flash(string $key, ?string $value = null) {
	if ($value === null) {
		$value = $_SESSION['_flash'][$key] ?? null;
		if ($value !== null) unset($_SESSION['_flash'][$key]);
		return $value;
	}
	$_SESSION['_flash'][$key] = $value;
}

function trans(string $key, array $replace = []): string {
	$locale = $_SESSION['locale'] ?? config('locales', 'default', 'en');
	$path = BASE_PATH . '/resources/lang/' . $locale . '.php';
	$lines = file_exists($path) ? require $path : [];
	$text = $lines[$key] ?? $key;
	foreach ($replace as $k => $v) {
		$text = str_replace(':' . $k, (string) $v, $text);
	}
	return $text;
}

function settings(string $key, $default = null) {
	return App\Core\Cache::remember('settings', 300, function(){
		$rows = App\Core\Database::pdo()->query('SELECT `key`,`value` FROM settings')->fetchAll();
		$out = [];
		foreach ($rows as $r) { $out[$r['key']] = $r['value']; }
		return $out;
	})[$key] ?? $default;
}

function menu(string $name = 'primary'): array {
	$key = 'menu_' . $name;
	return App\Core\Cache::remember($key, 300, function() use ($name) {
		$pdo = App\Core\Database::pdo();
		$stmt = $pdo->prepare('SELECT mi.* FROM menus m JOIN menu_items mi ON mi.menu_id = m.id WHERE m.name = :n ORDER BY mi.sort_order ASC');
		$stmt->execute(['n' => $name]);
		return $stmt->fetchAll();
	});
}