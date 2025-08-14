<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Validator;
use App\Core\Mailer;

class ContactController extends Controller
{
	public function index(): void {
		view('contact/index');
	}

	public function submit(): void {
		$validator = new Validator($_POST);
		$validator->rules([
			'name' => 'required|min:2|max:120',
			'email' => 'required|email',
			'topic' => 'required|in:general,sales,support',
			'message' => 'required|min:10|max:2000',
		]);
		if (!$validator->validate()) {
			flash('errors', $validator->errors());
			$_SESSION['_old'] = $_POST;
			redirect('/contact');
		}
		$data = $validator->validated();
		$pdo = Database::pdo();
		$stmt = $pdo->prepare('INSERT INTO enquiries (name, email, topic, message, created_at) VALUES (:name, :email, :topic, :message, NOW())');
		$stmt->execute($data);
		Mailer::send(config('mail', 'from_address'), 'New Enquiry: ' . $data['topic'], nl2br(e($data['message'])));
		flash('success', 'Thanks, we will get back to you.');
		redirect('/contact');
	}
}