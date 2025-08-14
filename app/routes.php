<?php
use App\Core\Router;
use App\Middlewares\CsrfMiddleware;
use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\BlogController;
use App\Controllers\CsrController;
use App\Controllers\CareerController;
use App\Controllers\ContactController;
use App\Controllers\Admin\AuthController as AdminAuthController;
use App\Controllers\Admin\DashboardController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/projects', [ProjectController::class, 'index']);
$router->get('/projects/{slug}', [ProjectController::class, 'show']);
$router->get('/csr', [CsrController::class, 'index']);
$router->get('/csr/{slug}', [CsrController::class, 'show']);
$router->get('/career', [CareerController::class, 'index']);
$router->get('/career/{slug}', [CareerController::class, 'show']);
$router->post('/career/apply/{id}', [CareerController::class, 'apply'], [CsrfMiddleware::class]);
$router->get('/blog', [BlogController::class, 'index']);
$router->get('/blog/category/{slug}', [BlogController::class, 'category']);
$router->get('/blog/tag/{slug}', [BlogController::class, 'tag']);
$router->get('/blog/{slug}', [BlogController::class, 'show']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact', [ContactController::class, 'submit'], [CsrfMiddleware::class]);
$router->get('/sitemap.xml', [HomeController::class, 'sitemap']);
$router->get('/rss.xml', [HomeController::class, 'rss']);
$router->get('/lang/{locale}', [HomeController::class, 'switchLang']);

// Admin
$router->get('/admin/login', [AdminAuthController::class, 'loginForm']);
$router->post('/admin/login', [AdminAuthController::class, 'login'], [CsrfMiddleware::class]);
$router->post('/admin/logout', [AdminAuthController::class, 'logout'], [CsrfMiddleware::class]);
$router->get('/admin/forgot', [App\Controllers\Admin\PasswordController::class, 'forgotForm']);
$router->post('/admin/forgot', [App\Controllers\Admin\PasswordController::class, 'sendLink'], [CsrfMiddleware::class]);
$router->get('/admin/reset', [App\Controllers\Admin\PasswordController::class, 'resetForm']);
$router->post('/admin/reset', [App\Controllers\Admin\PasswordController::class, 'reset'], [CsrfMiddleware::class]);
$router->get('/admin', [DashboardController::class, 'index']);
// Generic admin resources
$router->get('/admin/resource/{resource}', [App\Controllers\Admin\ResourceController::class, 'index']);
$router->get('/admin/resource/{resource}/create', [App\Controllers\Admin\ResourceController::class, 'create']);
$router->post('/admin/resource/{resource}', [App\Controllers\Admin\ResourceController::class, 'store'], [CsrfMiddleware::class]);
$router->get('/admin/resource/{resource}/{id}/edit', [App\Controllers\Admin\ResourceController::class, 'edit']);
$router->post('/admin/resource/{resource}/{id}/edit', [App\Controllers\Admin\ResourceController::class, 'update'], [CsrfMiddleware::class]);
$router->post('/admin/resource/{resource}/{id}/delete', [App\Controllers\Admin\ResourceController::class, 'destroy'], [CsrfMiddleware::class]);