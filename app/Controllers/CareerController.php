<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Validator;
use App\Core\Upload;
use App\Core\Mailer;

class CareerController extends Controller
{
	public function index(): void {
		$pdo = Database::pdo();
		$jobs = $pdo->query('SELECT * FROM jobs ORDER BY created_at DESC')->fetchAll();
		view('career/index', compact('jobs'));
	}

	public function show(string $slug): void {
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('SELECT * FROM jobs WHERE slug = :slug LIMIT 1');
		$stmt->execute(['slug' => $slug]);
		$job = $stmt->fetch();
		if (!$job) { http_response_code(404); echo 'Job not found'; return; }
		view('career/show', compact('job'));
	}

	public function apply(int $id): void {
		$validator = new Validator($_POST, $_FILES);
		$validator->rules([
			'name' => 'required|min:2|max:120',
			'email' => 'required|email',
			'phone' => 'required',
			'cv' => 'file|mimes:pdf|max_mb:10',
		]);
		if (!$validator->validate()) {
			flash('errors', $validator->errors());
			$_SESSION['_old'] = $_POST;
			redirect($_SERVER['HTTP_REFERER'] ?? '/career');
		}
		$data = $validator->validated();
		$cvPath = '';
		if (!empty($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
			$cvPath = Upload::save($_FILES['cv'], 'cvs', ['pdf'], (int) env('UPLOAD_MAX_SIZE_MB', 10));
		}
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('INSERT INTO applications (job_id, name, email, phone, cv_path, created_at) VALUES (:job_id, :name, :email, :phone, :cv_path, NOW())');
		$stmt->execute(['job_id' => $id, 'name' => $data['name'], 'email' => $data['email'], 'phone' => $data['phone'], 'cv_path' => $cvPath]);
		Mailer::send(config('mail', 'from_address'), 'New Job Application', 'A new job application has been submitted.');
		flash('success', 'Application submitted.');
		redirect('/career');
	}
}