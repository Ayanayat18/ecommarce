<?php
namespace App\Core;

class View
{
	protected static string $basePath;
	protected static array $sections = [];
	protected static array $sectionStack = [];
	protected static ?string $layout = null;

	public static function init(string $basePath): void { self::$basePath = rtrim($basePath, '/'); }

	public static function render(string $template, array $data = []): void {
		extract($data, EXTR_OVERWRITE);
		self::$sections = [];
		self::$sectionStack = [];
		self::$layout = null;
		$__file = self::path($template);
		ob_start();
		require $__file;
		$content = ob_get_clean();
		if (self::$layout) {
			$__layout = self::path(self::$layout);
			ob_start();
			require $__layout;
			echo ob_get_clean();
			return;
		}
		echo $content;
	}

	public static function extend(string $layout): void { self::$layout = 'layouts/' . $layout; }

	public static function start(string $name): void { self::$sectionStack[] = $name; ob_start(); }
	public static function end(): void {
		$name = array_pop(self::$sectionStack);
		self::$sections[$name] = ob_get_clean();
	}
	public static function section(string $name, string $default = ''): void { echo self::$sections[$name] ?? $default; }
	public static function include(string $path, array $data = []): void { extract($data, EXTR_OVERWRITE); require self::path($path); }

	protected static function path(string $template): string { return self::$basePath . '/' . trim($template, '/') . '.php'; }
}