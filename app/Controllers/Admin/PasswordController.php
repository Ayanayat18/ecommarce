<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Mailer;

class PasswordController extends Controller
{
	public function forgotForm(): void { view('admin/auth/forgot'); }

	public function sendLink(): void {
		$email = trim($_POST['email'] ?? '');
		$token = bin2hex(random_bytes(32));
		$pdo = Database::pdo();
		$pdo->exec('CREATE TABLE IF NOT EXISTS password_resets (email VARCHAR(190) NOT NULL, token VARCHAR(100) NOT NULL, created_at DATETIME NULL, UNIQUE KEY (email))');
		$stmt = $pdo->prepare('REPLACE INTO password_resets (email, token, created_at) VALUES (:email,:token,NOW())');
		$stmt->execute(['email' => $email, 'token' => $token]);
		$link = rtrim(config('app','url',''),'/') . '/admin/reset?email=' . urlencode($email) . '&token=' . $token;
		Mailer::send($email, 'Password Reset', 'Click to reset: <a href="' . e($link) . '">Reset Password</a>');
		flash('success', 'If the email exists, a reset link has been sent.');
		redirect('/admin/forgot');
	}

	public function resetForm(): void { view('admin/auth/reset', ['email' => $_GET['email'] ?? '', 'token' => $_GET['token'] ?? '']); }

	public function reset(): void {
		$email = trim($_POST['email'] ?? '');
		$token = trim($_POST['token'] ?? '');
		$password = (string)($_POST['password'] ?? '');
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT * FROM password_resets WHERE email = :email AND token = :token');
		$stmt->execute(['email' => $email, 'token' => $token]);
		$row = $stmt->fetch();
		if (!$row) { flash('errors', ['email' => ['Invalid token']]); redirect('/admin/forgot'); }
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$upd = $pdo->prepare('UPDATE users SET password = :p WHERE email = :e');
		$upd->execute(['p' => $hash, 'e' => $email]);
		$pdo->prepare('DELETE FROM password_resets WHERE email = :email')->execute(['email' => $email]);
		flash('success', 'Password updated. Please login.');
		redirect('/admin/login');
	}
}