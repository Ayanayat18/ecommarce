<?php
namespace App\Services;

use App\Core\Database;

class SitemapService
{
	public static function generate(): string {
		$base = rtrim(config('app', 'url', ''), '/');
		$pdo = Database::pdo();
		$urls = [
			['loc' => $base . '/', 'priority' => '1.0'],
			['loc' => $base . '/about', 'priority' => '0.8'],
			['loc' => $base . '/projects', 'priority' => '0.9'],
			['loc' => $base . '/csr', 'priority' => '0.6'],
			['loc' => $base . '/career', 'priority' => '0.6'],
			['loc' => $base . '/blog', 'priority' => '0.7'],
			['loc' => $base . '/contact', 'priority' => '0.6'],
		];
		foreach ($pdo->query('SELECT slug, updated_at FROM posts WHERE status = "published"') as $row) {
			$urls[] = ['loc' => $base . '/blog/' . $row['slug'], 'priority' => '0.7', 'lastmod' => substr($row['updated_at'], 0, 10)];
		}
		foreach ($pdo->query('SELECT slug, updated_at FROM projects') as $row) {
			$urls[] = ['loc' => $base . '/projects/' . $row['slug'], 'priority' => '0.8', 'lastmod' => substr($row['updated_at'], 0, 10)];
		}
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach ($urls as $u) {
			$xml .= '<url>';
			$xml .= '<loc>' . htmlspecialchars($u['loc']) . '</loc>';
			if (!empty($u['lastmod'])) $xml .= '<lastmod>' . $u['lastmod'] . '</lastmod>';
			if (!empty($u['priority'])) $xml .= '<priority>' . $u['priority'] . '</priority>';
			$xml .= '</url>';
		}
		$xml .= '</urlset>';
		return $xml;
	}
}