<?php
namespace App\Core;

class Image
{
	public static function thumbnail(string $relativePath, int $width, int $height, string $suffix = '_thumb'): string {
		$source = PUBLIC_PATH . '/uploads/' . ltrim($relativePath, '/');
		$info = pathinfo($source);
		$ext = strtolower($info['extension'] ?? '');
		$destRel = $info['dirname'] . '/' . $info['filename'] . $suffix . '.' . $ext;
		$dest = $destRel;
		if (!file_exists($source)) return $relativePath;
		[$w, $h] = getimagesize($source);
		$srcRatio = $w / $h; $dstRatio = $width / $height;
		if ($dstRatio > $srcRatio) { $newHeight = (int)($width / $srcRatio); $newWidth = $width; }
		else { $newWidth = (int)($height * $srcRatio); $newHeight = $height; }
		$create = match ($ext) { 'jpg','jpeg' => 'imagecreatefromjpeg', 'png' => 'imagecreatefrompng', 'webp' => 'imagecreatefromwebp', default => null };
		$save = match ($ext) { 'jpg','jpeg' => 'imagejpeg', 'png' => 'imagepng', 'webp' => 'imagewebp', default => null };
		if (!$create || !$save) return $relativePath;
		$src = @$create($source); if (!$src) return $relativePath;
		$tmp = imagecreatetruecolor($width, $height);
		imagecopyresampled($tmp, $src, 0 - ($newWidth - $width) / 2, 0 - ($newHeight - $height) / 2, 0, 0, $newWidth, $newHeight, $w, $h);
		@$save($tmp, $dest, 85);
		imagedestroy($src); imagedestroy($tmp);
		$rootUploads = PUBLIC_PATH . '/uploads/';
		return ltrim(str_replace($rootUploads, '', $dest), '/');
	}
}