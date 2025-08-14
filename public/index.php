<?php
declare(strict_types=1);

ini_set('display_errors', '0');
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', __DIR__);

// Start session
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// Autoloader (PSR-4 like)
spl_autoload_register(function ($class) {
	$prefixes = [
		'App\\' => BASE_PATH . '/app/',
		'Install\\' => BASE_PATH . '/install/',
	];
	foreach ($prefixes as $prefix => $baseDir) {
		$len = strlen($prefix);
		if (strncmp($prefix, $class, $len) !== 0) continue;
		$relativeClass = substr($class, $len);
		$file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
		if (file_exists($file)) { require $file; return; }
	}
});

// Load helpers
require BASE_PATH . '/app/Helpers/functions.php';

// Load .env
$envPath = BASE_PATH . '/.env';
if (file_exists($envPath)) {
	$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($lines as $line) {
		if (str_starts_with(trim($line), '#')) continue;
		[$name, $value] = array_map('trim', array_pad(explode('=', $line, 2), 2, ''));
		$value = trim($value, "\"' ");
		if ($name !== '') { $_ENV[$name] = $value; }
	}
}

// Set timezone
if (!empty(env('APP_TIMEZONE'))) {
	date_default_timezone_set(env('APP_TIMEZONE'));
}

use App\Core\Router;
use App\Core\Database;
use App\Core\View;
use App\Core\Auth;
use App\Core\CSRF;

// Initialize core singletons
Database::init(require BASE_PATH . '/config/database.php');
View::init(BASE_PATH . '/resources/views');
Auth::init();
CSRF::init();

// Redirect to installer if needed (skip when running installer)
if (!defined('IN_INSTALL')) {
	if (!file_exists($envPath) || env('INSTALL_LOCK', 'false') === 'false') {
		$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
		if ($uri !== 'install') {
			header('Location: /install');
			exit;
		}
	}
}

$router = new Router();

// Load routes
require BASE_PATH . '/app/routes.php';

// Dispatch
if (!defined('IN_INSTALL')) {
	$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
}