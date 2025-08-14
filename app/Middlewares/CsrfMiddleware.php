<?php
namespace App\Middlewares;

use App\Core\CSRF;

class CsrfMiddleware
{
	public function handle(callable $next): void {
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && !CSRF::verify()) {
			http_response_code(419);
			echo 'CSRF token mismatch';
			return;
		}
		$next();
	}
}