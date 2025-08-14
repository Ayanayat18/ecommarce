<?php
namespace App\Core;

class Router
{
	protected array $routes = [];
	protected array $middleware = [];

	public function get(string $path, $handler, array $middleware = []): void { $this->map('GET', $path, $handler, $middleware); }
	public function post(string $path, $handler, array $middleware = []): void { $this->map('POST', $path, $handler, $middleware); }
	public function any(string $path, $handler, array $middleware = []): void { $this->map('GET', $path, $handler, $middleware); $this->map('POST', $path, $handler, $middleware); }

	public function group(array $opts, callable $cb): void {
		$prev = $this->middleware;
		if (isset($opts['middleware'])) {
			$this->middleware = array_merge($this->middleware, (array)$opts['middleware']);
		}
		$cb($this);
		$this->middleware = $prev;
	}

	public function map(string $method, string $path, $handler, array $middleware = []): void {
		$path = '/' . trim($path, '/');
		$this->routes[$method][] = [
			'path' => $path,
			'handler' => $handler,
			'middleware' => array_merge($this->middleware, $middleware),
		];
	}

	public function dispatch(string $method, string $uri): void {
		$method = strtoupper($method);
		$path = parse_url($uri, PHP_URL_PATH);
		$path = '/' . trim($path, '/');
		$routes = $this->routes[$method] ?? [];
		foreach ($routes as $route) {
			$params = [];
			if ($this->match($route['path'], $path, $params)) {
				$this->run($route['middleware'], $route['handler'], $params);
				return;
			}
		}
		http_response_code(404);
		echo '404 Not Found';
	}

	protected function match(string $routePath, string $requestPath, array &$params): bool {
		$pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_-]*)\}#', '(?P<$1>[^/]+)', $routePath);
		$pattern = '#^' . $pattern . '$#';
		if (preg_match($pattern, $requestPath, $matches)) {
			foreach ($matches as $k => $v) {
				if (is_string($k)) $params[$k] = $v;
			}
			return true;
		}
		return false;
	}

	protected function run(array $middleware, $handler, array $params): void {
		$next = function() use (&$handler, &$params) {
			$this->invoke($handler, $params);
		};
		while ($m = array_pop($middleware)) {
			$prevNext = $next;
			$next = function() use ($m, $prevNext) {
				$instance = new $m();
				$instance->handle($prevNext);
			};
		}
		$next();
	}

	protected function invoke($handler, array $params): void {
		// Support [ClassName, method]
		if (is_array($handler) && count($handler) === 2 && is_string($handler[0]) && is_string($handler[1])) {
			$controller = new $handler[0]();
			call_user_func_array([$controller, $handler[1]], $params);
			return;
		}
		if (is_callable($handler)) { call_user_func_array($handler, $params); return; }
		if (is_string($handler) && str_contains($handler, '@')) {
			[$class, $method] = explode('@', $handler, 2);
			$controller = new $class();
			call_user_func_array([$controller, $method], $params);
			return;
		}
		throw new \RuntimeException('Invalid route handler');
	}
}