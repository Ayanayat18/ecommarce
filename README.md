# Plain PHP MVC Real Estate CMS

A production-ready, plain PHP MVC web application for a real-estate/holdings company. No frameworks (no Laravel/CodeIgniter). Bootstrap 5 frontend, fully customizable admin panel, install wizard, and multilingual support (en, bn).

## Requirements
- PHP 8.2+
- Apache with mod_rewrite
- MySQL 5.7+/MariaDB 10.3+
- PHP extensions: pdo_mysql, gd, mbstring, fileinfo, openssl, json, session

## Quick Deploy (cPanel)
1. Upload the zip to `public_html` and unzip
2. Ensure directories are writable: `storage/`, `storage/cache/`, `storage/logs/`, `public/uploads/`
3. Create a MySQL database and user, assign privileges
4. Visit `/install` in your browser
   - Step 1: Requirements check
   - Step 2: DB credentials; the installer writes `.env`
   - Step 3: Run `database/schema.sql` + `database/seed.sql`
   - Step 4: Create the first admin user
5. Login to `/admin` using the admin account you created

## Tech
- Front Controller + MVC (Models, Views, Controllers)
- Router with middleware pipeline
- PDO prepared statements
- Blade-like sections/includes templating
- Bootstrap 5 + custom CSS
- CSRF tokens, server-side validation, file upload guards, password hashing
- Role-based access (Super Admin, Editor)
- Caching for settings and menus
- RSS, sitemap, SEO/meta
- Multilingual (en, bn)

## Structure
- `app/` core, controllers, models, services, middlewares, helpers
- `config/` app, database, mail, locales
- `resources/views/` frontend and admin views
- `public/` index, assets, uploads
- `storage/` logs, cache, private
- `install/` wizard controllers and views
- `database/` schema and seed SQL

## Environment
Copy `.env.example` to `.env` (installer does this for you) and adjust as needed.

## Admin Modules
- Sliders, Pages, Projects, Project Gallery, Units
- Team, Testimonials, Blog/News, CSR Posts
- Careers/Jobs, Applications, Enquiries/Leads
- Menus, Media Library, Settings
- Users & Roles, Activity Log

## Security Notes
- Keep `app/` and `storage/private` blocked by default via `.htaccess`
- CSRF on all POST forms
- Login rate limiting
- Uploaded files validated and stored with unique names

## Development
- No Composer required. Autoloader provided.
- Minimal dependencies. Uses PHP GD for image resizing.

## Tests
Basic PHPUnit tests are included under `tests/`, optional to run locally with Composer if desired.

## Troubleshooting
- White page: enable `APP_DEBUG=true` in `.env` during development
- File permissions: ensure Apache can write to `storage/*` and `public/uploads`
- SMTP: verify host/port/user/pass/from in Settings or `.env`

## License
MIT