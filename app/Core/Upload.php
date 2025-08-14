<?php
namespace App\Core;

class Upload
{
	public static function save(array $file, string $dir = 'uploads', array $allowedExt = ['jpg','jpeg','png','webp','pdf'], int $maxMb = 10): string {
		if ($file['error'] !== UPLOAD_ERR_OK) throw new \RuntimeException('Upload failed.');
		$maxBytes = $maxMb * 1024 * 1024;
		if ($file['size'] > $maxBytes) throw new \RuntimeException('File too large.');
		$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		if (!in_array($ext, $allowedExt, true)) throw new \RuntimeException('Invalid file type.');
		$targetDir = PUBLIC_PATH . '/uploads/' . trim($dir, '/');
		if (!is_dir($targetDir)) mkdir($targetDir, 0775, true);
		$basename = bin2hex(random_bytes(8)) . '-' . preg_replace('/[^a-z0-9\.\-]/i', '_', basename($file['name']));
		$path = $targetDir . '/' . $basename;
		if (!move_uploaded_file($file['tmp_name'], $path)) throw new \RuntimeException('Failed to move upload.');
		return trim($dir, '/') . '/' . $basename;
	}
}