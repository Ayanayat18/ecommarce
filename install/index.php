<?php
declare(strict_types=1);

define('IN_INSTALL', true);

define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', BASE_PATH . '/public');

if (session_status() === PHP_SESSION_NONE) session_start();

function env_write(array $pairs): bool {
	$content = '';
	foreach ($pairs as $k => $v) {
		$content .= $k . '=' . (preg_match('/\s/', (string)$v) ? '"' . $v . '"' : $v) . "\n";
	}
	return file_put_contents(BASE_PATH . '/.env', $content) !== false;
}

function check_ext(string $ext): bool { return extension_loaded($ext); }

$step = (int)($_GET['step'] ?? 1);

if ($step === 1) {
	$exts = ['pdo_mysql','gd','mbstring','fileinfo'];
	$results = [];
	foreach ($exts as $e) $results[$e] = check_ext($e);
	include __DIR__ . '/views/step1.php';
	exit;
}

if ($step === 2) {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$env = [
			'APP_NAME' => $_POST['APP_NAME'] ?? 'Aurora Holdings',
			'APP_URL' => rtrim($_POST['APP_URL'] ?? 'http://localhost','/'),
			'APP_ENV' => 'production',
			'APP_DEBUG' => 'false',
			'APP_LOCALE' => 'en',
			'APP_FALLBACK_LOCALE' => 'en',
			'APP_TIMEZONE' => 'UTC',
			'APP_KEY' => bin2hex(random_bytes(16)),
			'DB_HOST' => $_POST['DB_HOST'] ?? '127.0.0.1',
			'DB_PORT' => $_POST['DB_PORT'] ?? '3306',
			'DB_DATABASE' => $_POST['DB_DATABASE'] ?? 'realestate',
			'DB_USERNAME' => $_POST['DB_USERNAME'] ?? 'root',
			'DB_PASSWORD' => $_POST['DB_PASSWORD'] ?? '',
			'INSTALL_LOCK' => 'false',
		];
		if (!env_write($env)) { $error = 'Failed to write .env'; }
		else { header('Location: ?step=3'); exit; }
	}
	include __DIR__ . '/views/step2.php';
	exit;
}

if ($step === 3) {
	require BASE_PATH . '/public/index.php'; // boot minimal env helpers and DB
	// generate placeholder images if not exist
	$phDir = PUBLIC_PATH . '/uploads/placeholders';
	if (!is_dir($phDir)) mkdir($phDir, 0775, true);
	for ($i=1;$i<=9;$i++) { $f = $phDir . '/p' . $i . '.jpg'; if (!file_exists($f)) { imagejpeg(imagecreatetruecolor(1200,680), $f, 80); } }
	for ($i=1;$i<=6;$i++) { $f = $phDir . '/g' . $i . '.jpg'; if (!file_exists($f)) { imagejpeg(imagecreatetruecolor(1200,800), $f, 80); } }
	for ($i=1;$i<=6;$i++) { $f = $phDir . '/t' . $i . '.jpg'; if (!file_exists($f)) { imagejpeg(imagecreatetruecolor(600,600), $f, 80); } }
	for ($i=1;$i<=6;$i++) { $f = $phDir . '/b' . $i . '.jpg'; if (!file_exists($f)) { imagejpeg(imagecreatetruecolor(1200,630), $f, 80); } }
	for ($i=1;$i<=4;$i++) { $f = $phDir . '/brand' . $i . '.png'; if (!file_exists($f)) { imagepng(imagecreatetruecolor(200,60), $f, 6); } }
	$slide1 = $phDir . '/slide1.jpg'; if (!file_exists($slide1)) imagejpeg(imagecreatetruecolor(1600,700), $slide1, 80);
	$slide2 = $phDir . '/slide2.jpg'; if (!file_exists($slide2)) imagejpeg(imagecreatetruecolor(1600,700), $slide2, 80);
	$slide3 = $phDir . '/slide3.jpg'; if (!file_exists($slide3)) imagejpeg(imagecreatetruecolor(1600,700), $slide3, 80);
	try {
		$pdo = App\Core\Database::pdo();
		$schema = file_get_contents(BASE_PATH . '/database/schema.sql');
		$pdo->exec($schema);
		$seed = file_get_contents(BASE_PATH . '/database/seed.sql');
		$seed = str_replace('placeholders/', 'placeholders/', $seed);
		$pdo->exec($seed);
		header('Location: ?step=4');
		exit;
	} catch (Throwable $e) { $error = $e->getMessage(); }
	include __DIR__ . '/views/step3.php';
	exit;
}

if ($step === 4) {
	require BASE_PATH . '/public/index.php';
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$name = trim($_POST['name'] ?? '');
		$email = trim($_POST['email'] ?? '');
		$password = (string)($_POST['password'] ?? '');
		if (!$name || !$email || !$password) { $error = 'All fields are required'; }
		else {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$pdo = App\Core\Database::pdo();
			$stmt = $pdo->prepare('INSERT INTO users (name, email, password, role, created_at) VALUES (:name, :email, :password, :role, NOW())');
			$stmt->execute(['name' => $name, 'email' => $email, 'password' => $hash, 'role' => 'super']);
			// lock installer
			$env = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES);
			$found = false;
			foreach ($env as &$line) { if (str_starts_with($line, 'INSTALL_LOCK=')) { $line = 'INSTALL_LOCK=true'; $found = true; } }
			if (!$found) $env[] = 'INSTALL_LOCK=true';
			file_put_contents(BASE_PATH . '/.env', implode("\n", $env));
			header('Location: /admin');
			exit;
		}
	}
	include __DIR__ . '/views/step4.php';
	exit;
}