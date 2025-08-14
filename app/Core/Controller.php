<?php
namespace App\Core;

abstract class Controller
{
	protected function input(string $key, $default = null) {
		return $_POST[$key] ?? $_GET[$key] ?? $default;
	}

	protected function only(array $keys): array {
		$out = [];
		foreach ($keys as $k) $out[$k] = $this->input($k);
		return $out;
	}

	protected function guard(string $permission = ''): void {
		if (!Auth::check()) redirect('/admin/login');
		if ($permission && !Auth::userCan($permission)) {
			http_response_code(403); echo 'Forbidden'; exit;
		}
	}

	protected function validate(array $rules): array {
		$validator = new Validator($_POST, $_FILES);
		$validator->rules($rules);
		if (!$validator->validate()) {
			flash('errors', $validator->errors());
			$_SESSION['_old'] = $_POST;
			redirect($_SERVER['HTTP_REFERER'] ?? '/');
		}
		return $validator->validated();
	}
}