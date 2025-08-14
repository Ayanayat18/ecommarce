<?php
namespace App\Core;

class Mailer
{
	public static function send(string $to, string $subject, string $htmlBody, string $textBody = ''): bool {
		$cfg = config('mail');
		$from = $cfg['from_address'] ?? 'no-reply@example.com';
		$fromName = $cfg['from_name'] ?? 'Website';

		if (class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
			$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
			try {
				$mail->isSMTP();
				$mail->Host = $cfg['host'];
				$mail->Port = (int)$cfg['port'];
				if (($cfg['encryption'] ?? 'none') !== 'none') $mail->SMTPSecure = $cfg['encryption'];
				$mail->SMTPAuth = !empty($cfg['username']);
				$mail->Username = $cfg['username'];
				$mail->Password = $cfg['password'];
				$mail->setFrom($from, $fromName);
				$mail->addAddress($to);
				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $htmlBody;
				$mail->AltBody = $textBody ?: strip_tags($htmlBody);
				return $mail->send();
			} catch (\Throwable $e) { return false; }
		}

		$headers = [
			'MIME-Version: 1.0',
			'Content-type: text/html; charset=utf-8',
			'From: ' . $fromName . ' <' . $from . '>'
		];
		return mail($to, $subject, $htmlBody, implode("\r\n", $headers));
	}
}