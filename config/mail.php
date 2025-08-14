<?php
return [
	'mailer' => env('MAIL_MAILER', 'smtp'),
	'host' => env('MAIL_HOST', 'localhost'),
	'port' => (int) env('MAIL_PORT', '25'),
	'username' => env('MAIL_USERNAME', ''),
	'password' => env('MAIL_PASSWORD', ''),
	'encryption' => env('MAIL_ENCRYPTION', 'none'), // none|ssl|tls
	'from_address' => env('MAIL_FROM_ADDRESS', 'no-reply@example.com'),
	'from_name' => env('MAIL_FROM_NAME', 'Aurora Holdings'),
];