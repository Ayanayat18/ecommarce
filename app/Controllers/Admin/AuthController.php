<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;

class AuthController extends Controller
{
	public function loginForm(): void {
		view('admin/auth/login');
	}

	public function login(): void {
		$email = trim($_POST['email'] ?? '');
		$password = (string)($_POST['password'] ?? '');
		if (!Auth::rateLimit('login:' . $_SERVER['REMOTE_ADDR'], 5, 60)) {
			flash('errors', ['email' => ['Too many attempts. Try again later.']]);
			redirect('/admin/login');
		}
		if (Auth::attempt($email, $password)) { redirect('/admin'); }
		flash('errors', ['email' => ['Invalid credentials.']]);
		redirect('/admin/login');
	}

	public function logout(): void {
		Auth::logout();
		redirect('/admin/login');
	}
}