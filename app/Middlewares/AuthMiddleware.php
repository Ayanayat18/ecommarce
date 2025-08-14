<?php
namespace App\Middlewares;

use App\Core\Auth;

class AuthMiddleware
{
	public function handle(callable $next): void {
		if (!Auth::check()) {
			header('Location: /admin/login');
			return;
		}
		$next();
	}
}