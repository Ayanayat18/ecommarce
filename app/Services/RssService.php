<?php
namespace App\Services;

use App\Core\Database;

class RssService
{
	public static function feed(): string {
		$base = rtrim(config('app', 'url', ''), '/');
		$pdo = Database::pdo();
		$items = $pdo->query('SELECT title, slug, excerpt, created_at FROM posts WHERE status = "published" ORDER BY created_at DESC LIMIT 50')->fetchAll();
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<rss version="2.0"><channel>';
		$xml .= '<title>' . htmlspecialchars(config('app', 'name', 'Aurora Holdings')) . ' Blog</title>';
		$xml .= '<link>' . htmlspecialchars($base . '/blog') . '</link>';
		$xml .= '<description>Latest posts</description>';
		foreach ($items as $item) {
			$xml .= '<item>';
			$xml .= '<title>' . htmlspecialchars($item['title']) . '</title>';
			$xml .= '<link>' . htmlspecialchars($base . '/blog/' . $item['slug']) . '</link>';
			$xml .= '<guid>' . htmlspecialchars($base . '/blog/' . $item['slug']) . '</guid>';
			$xml .= '<pubDate>' . date(DATE_RSS, strtotime($item['created_at'])) . '</pubDate>';
			$xml .= '<description><![CDATA[' . $item['excerpt'] . ']]></description>';
			$xml .= '</item>';
		}
		$xml .= '</channel></rss>';
		return $xml;
	}
}