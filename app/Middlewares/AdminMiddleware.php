<?php
namespace App\Middlewares;

use App\Core\Auth;

class AdminMiddleware
{
	protected ?string $permission;
	public function __construct(?string $permission = null) { $this->permission = $permission; }
	public function handle(callable $next): void {
		if (!Auth::check()) { header('Location: /admin/login'); return; }
		if ($this->permission && !Auth::userCan($this->permission)) { http_response_code(403); echo 'Forbidden'; return; }
		$next();
	}
}