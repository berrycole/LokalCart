# LokalCart POS — TFA4

A CodeIgniter 4 POS foundation for IT0049 Technical Formative Assessment 4: Sessions and Authentication. This continues TFA3's teal-and-mint design, account forms, validation, and avatar uploads, adding staff login and protected account management.

## Requirements

- PHP 8.2+ with intl, mbstring, mysqli, fileinfo, and gd
- MySQL or MariaDB and Composer
- Writable `writable/` and `public/uploads/avatars/` directories
- SQLite3 PHP extension for automated tests only

## Fresh local setup

1. Run `composer install`.
2. Import `database/lokalcart_pos_tfa3.sql` into MySQL. This provides the TFA3 base schema and sample records in `lokalcart_pos_tfa3`. **The fresh export drops tables in that database; use the upgrade instructions below for existing data.**
3. Copy `.env.example` to `.env` and configure your MySQL connection and `app.baseURL`.
4. Run `php spark migrate`. The TFA4 migration adds `users.password` and initializes each existing account with its own `password_hash()` hash. It preserves users, customers, tasks, and avatars.
5. Run `php spark serve` and open [LokalCart locally](http://localhost:8080/).
6. Sign in with `admin.ramos` and the demo password `LokalCart2026!`. All imported sample accounts initially use this password. Change it using Users → Edit → New password.

To choose a different initial password, set `TFA4_INITIAL_PASSWORD` in `.env` **before** running the migration (8–72 bytes). The migration never replaces an existing hash. Changing the environment value afterward does not change passwords; use the user edit form.

## Upgrade an existing TFA3 project

Keep your existing `.env`, database, and uploaded avatars. Install the updated project files, run `composer install`, then run `php spark migrate` against your existing database. Do not re-import the fresh SQL export. Your database can keep its original name, including `lokalcart_pos_tfa2`; keep `.env` pointed at it.

If the database is still on TFA2, first run `database/upgrade_tfa2_to_tfa3.sql` against that database, then run `php spark migrate`.

## Pages and authentication

| Route | Access and behavior |
| --- | --- |
| `/`, `/about` | Public original LokalCart pages |
| `GET /login` | Staff login form |
| `POST /login` | Verify username and password, regenerate session ID, store user identity |
| `POST /logout` | Destroy the session and redirect to login |
| `/customers`, `/customers/new`, `/customers/{id}/edit` | Login required |
| `/users`, `/users/new`, `/users/{id}/edit` | Login required |
| `POST /customers`, `POST /customers/{id}` | Login required to create or update customers |
| `POST /users`, `POST /users/{id}` | Login required to create or update users |

`AuthFilter` is registered as `auth` in `app/Config/Filters.php` and applied to all customer and user routes. Automatic routing is disabled. Protected responses are not cached. Existing `/tasks` and `/profile` demo pages remain available.

Login uses `password_verify()`. The session stores `isLoggedIn`, `user_id`, `username`, and `full_name`; it never stores passwords or password hashes. The navigation displays the signed-in username and a POST sign-out form. CSRF protection applies to login, logout, and account forms.

Creating a user requires a password. Editing a user accepts an optional replacement password; leaving it blank preserves the existing hash. Password fields are never repopulated. Every signed-in staff member can manage both account types, matching the activity; role-based permissions are outside this milestone.

Existing customer validation and JPG/PNG avatar upload behavior are retained (maximum 2 MB, cropped to 256 × 256 pixels).

## Verification

Run `php vendor/bin/phpunit`. Tests use an in-memory SQLite database and do not modify your MySQL data. Coverage includes guest redirects for all ten protected routes, successful and unsuccessful login, signed-in page access, logout, hashed password creation and replacement, blank password edits, migration preservation, and existing forms/pages.

Manual check:

1. While signed out, open Customers, Users, and their new/edit URLs; each should redirect to login.
2. Submit incorrect credentials; confirm a generic error and an empty password field.
3. Sign in with the sample account and open customer/user forms. Create and edit records.
4. Change a user's password, sign out, and verify the new password works while the old one fails.
5. Sign out and revisit a protected URL; it must redirect to login again.

## Submission

The repository includes the raw project, TFA3 base SQL export, and TFA4 upgrade migration. `.env`, dependencies, generated avatars, and session files are excluded from Git.

Hosting is deferred as requested. The assignment's hosted-link submission item remains outstanding until a later deployment.

[GitHub repository](https://github.com/berrycole/LokalCart)
